<?php
    class Users EXTENDS Controller{
        public function __construct(){
            $this->userModel = $this->model('User');
            $this->userDAO = $this->dal('UserDAO');
            $this->tokenDAO = $this->dal('TokenDAO');
        }

        public function register(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data and determine validation regex
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $passwordValidation = "/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/";
                $nameValidation = "/^[a-zA-Z ]*$/";
                $streetValidation = "/^[a-zA-Z ]*$/";
                $phoneValidation = "/^[-0-9]*$/";
                $houseValidation = "/^[0-9]*$/";

                // Init data
                $user = new User();
                $user->setUserName(trim($_POST['name']));
                $user->setUserLastName(trim($_POST['lastName']));
                $user->setEmail(trim(($_POST['email'])));
                $user->setStreet(trim($_POST['street']));
                $user->setHouse(trim($_POST['house']));
                $user->setPhone(trim($_POST['phone']));
                $user->setGender(trim($_POST['gender']));
                $user->setPassword(trim($_POST['password']));
                $user->setPasswordConfirm(trim($_POST['passwordConfirm']));

                $data = [
                    'nameError' => '',
                    'lastNameError' => '',
                    'emailError' => '',
                    'streetError' => '',
                    'houseError' => '',
                    'zipError' => '',
                    'phoneError' => '',
                    'passwordError' => '',
                    'passwordConfirmError' => ''
                ];

                // Validate email not empty
                if(empty($user->getEmail())){
                    $data['emailError'] = 'Please enter email';
                }else {
                    // Check if email already exists
                    if($this->userDAO->findUserByEmail($user->getEmail())){
                        $data['emailError'] = 'Email is already taken';
                    }
                }

                // Validate Name not empty
                if(empty($user->getUserName())){
                    $data['nameError'] = 'Please enter name';
                } elseif(!preg_match($nameValidation, $user->getUserName())){
                    $data['nameError'] = 'Name can only contain letters and whitespace';
                }

                // Validate lastName not empty
                if(empty($user->getUserLastName())){
                    $data['lastNameError'] = 'Please enter last name';
                } elseif(!preg_match($nameValidation, $user->getUserLastName())){
                    $data['lastNameError'] = 'Name can only contain letters and whitespace';
                }

                // Validate phone not empty
                if(empty($user->getPhone())){
                    $data['phoneError'] = 'Please enter phone number';
                } elseif(!preg_match($phoneValidation, $user->getPhone())){
                    $data['phoneError'] = 'Phone can only contain numbers and -';
                }

                // Validate street not empty
                if(empty($user->getStreet())){
                    $data['streetError'] = 'Please enter street';
                } elseif(!preg_match($streetValidation, $user->getStreet())){
                    $data['streetError'] = 'Street can only contain letters and whitespace';
                }

                // Validate House Number not empty
                if(empty($user->getHouse())){
                    $data['houseError'] = 'Please enter house number';
                } elseif(!preg_match($houseValidation, $user->getHouse())){
                    $data['houseError'] = 'House number can only contain numbers';
                }

                // Validate Password not empty
                if(empty($user->getPassword())){
                    $data['passwordError'] = 'Please enter password';
                } elseif(strlen($user->getPassword()) < 6) {
                    $data['passwordError'] = 'Password must be at least 6 characters long';
                } elseif(!preg_match($passwordValidation, $user->getPassword())){
                    $data['passwordError'] = 'Password must have at least one numeric value, one uppercase character and one lowercase character';
                }

                 // Validate password confirmation
                 if(empty($user->getPasswordConfirm())){
                    $data['passwordConfirmError'] = 'Please confirm password';
                } else {
                    if($user->getPassword() != $user->getPasswordConfirm()){
                        $data['passwordConfirmError'] = 'Passwords do not match!';
                    }
                }

                // Convert gender to number
                if($user->getGender() == 'male'){
                    $user->setGender(1);
                } else {
                    $user->setGender(0);
                }

                // Make sure errors are empty
                if(empty($data['emailError']) && empty($data['nameError']) && empty($data['passwordError']) && empty($data['passwordConfirmError'])){
                    // Validated

                    // Hash password
                    $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));

                    // Register user
                    if($this->userDAO->register($user)){
                        // Send verification email
                        // Create token
                        $this->createToken($user->getEmail(), "verification");

                        // Message
                        $message = "You have registered at Haarlem Festival. \n
                        Click the link below to verificate your account! \n
                        " . URLROOT . "?token=" . $token;

                        // Use wordwrap() if lines are longer than 70 characters
                        $message = wordwrap($message,70);

                        // Subject
                        $subject = "Haarlem Festival User Verification";

                        // Send email
                        //mail($user->getEmail(), $subject, $message);  
                        redirect('users/login');
                    } else {
                        die('Something went wrong');
                    }             
                } else {
                    //Load view with data
                    $this->ui('users/register', $data);
                }

            } else {
                //Init data
                $data = [
                    'name' => '',
                    'lastName' => '',
                    'email' => '',
                    'street' => '',
                    'house' => '',
                    'phone' => '',
                    'gender' => '',
                    'password' => '',
                    'passwordConfirm' => '',
                    'nameError' => '',
                    'lastNameError' => '',
                    'emailError' => '',
                    'streetError' => '',
                    'houseError' => '',
                    'zipError' => '',
                    'phoneError' => '',
                    'passwordError' => '',
                    'passwordConfirmError' => ''
                ];

                //Load ui
                $this->ui('users/register', $data);
            }
        }

        public function login(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init data
                $user = new User();
                $user->setEmail(trim($_POST['email']));
                $user->setPassword(trim($_POST['password']));

                // Validate email not empty
                if(empty($user->getEmail())){
                    $data['emailError'] = 'Please enter email';
                }

                // Validate Password not empty
                if(empty($user->getPassword())){
                    $data['passwordError'] = 'Please enter password';
                }

                // Check user by email
                if(!empty($user->getEmail())){
                    if($this->userDAO->findUserByEmail($user->getEmail())){
                        //User found
                    } else{
                        //User not found
                        $data['emailError'] = 'No user found!';
                        $data['passwordError'] = '';
                    }
                }

                // Make sure errors are empty
                if(empty($data['emailError']) && empty($data['passwordError'])){
                    // Validated
                    // Check and login
                    $loggedInUser = $this->userDAO->login($user);

                    if($loggedInUser){
                        // Create Session

                        $this->createUserSession($loggedInUser);

                        if($_SESSION['userType'] > 1){
                            redirect('cms/dashboard');
                        } else {
                        redirect('index');
                        }
                    } else {
                        $data['passwordError'] = 'Password incorrect';
                        $data['emailError'] = '';
                        $this->ui('users/login', $data);
                    }

                } else {
                    // Load view with data
                    $this->ui('users/login', $data);
                }

            } else {
                // Init data
                $data = [
                    'email' => '',
                    'password' => '',
                    'emailError' => '',
                    'passwordError' => ''
                ];

                // Load ui
                $this->ui('users/login', $data);
            }
        }

        public function forgot(){
            // Init data
            $data = [
                'title' => 'Forgot password?',
                'emailError' => ''
            ];

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $email = trim($_POST['email']);

                // Validate email not empty
                if(empty($email)){
                    $data['emailError'] = 'Please enter email';
                }else{
                    // Check user by email
                    if($this->userDAO->findUserByEmail($email)){
                        // User found

                        // Create token
                        $this->createToken($email, "forgot");

                        // Message
                        $message = "You have requested a password recovery for your account at Haarlem Festival. \n
                        Click the link below to set up a new password \n
                        [link]";

                        // Use wordwrap() if lines are longer than 70 characters
                        $message = wordwrap($message,70);

                        // Subject
                        $subject = "Haarlem Festival password recovery";

                        // Send email
                        //mail($email, $subject, $message);                                                

                        redirect("users/pwemailsend");

                    } else{
                        // User not found
                        $data['emailError'] = 'No user found!';
                    }
                }
            }

            // Load UI
            $this->ui('users/forgot', $data);
        }

        public function pwEmailSend(){
            // Init data
            $data = [
                'title' => 'Password recovery email has been send'
            ];            

            // Load UI
            $this->ui('users/pwemailsend', $data);
        }        

        public function newPassword(){   
            // Sanitize the token if provided
            if(isset($_GET['token'])){
                $token = trim(filter_var($_GET['token'], FILTER_SANITIZE_STRING));
            } else {
                $token = "";
            }
            
            
            // Sanitize user input and declare password validation regex
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $passwordValidation = "/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/"; 
            
            // Init data
            $data = [
                'title' => 'Enter new password',
                'token' => $token,
                'error' => ""
            ];

            // Check for post
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Init POST data
                $password = trim($_POST['password']);
                $passwordConfirm = trim($_POST['passwordConfirmation']);

                // Validate Password not empty
                if(!empty($password) && !empty($passwordConfirm)){
                    
                    // Validate if password is 6 characters or longer
                    if(strlen($password < 6)) {

                        // Validate if password matches contains the required characters
                        if(preg_match($passwordValidation, $password)) {

                            // Validate if password matches confirmation password
                            if($password == $passwordConfirm) {
                                // Hash password
                                $password = password_hash($password, PASSWORD_DEFAULT);
                                
                                // Update password in datebase
                                $this->userDAO->newPassword($token, $password);
                                $this->tokenDAO->deleteToken($token);

                                // Redirect to login page
                                redirect("users/login");
                            } else {
                                $data['error'] = "Passwords don't match!";

                                //Load UI
                                $this->ui('users/newpassword', $data);
                            }
                        } else {
                            $data['error'] = "Invalid password";

                            //Load UI
                            $this->ui('users/newpassword', $data);
                        }
                    } else {
                        $data['error'] = "Password needs to be at leat 6 characters long";

                        //Load UI
                        $this->ui('users/newpassword', $data);
                    }
                } else {
                    $data['error'] = "Please enter a new password";

                    //Load UI
                    $this->ui('users/newpassword', $data);
                }                           
            } else {
                if($this->tokenHandler($token) == "forgot"){
                } else {
                    $data['title'] = "Invalid request!";

                    //Load UI
                    $this->ui('users/newpassword', $data);
                }
                
            }

            //Load UI
            $this->ui('users/newpassword', $data);
        }

        public function pwDone(){            
            //sanitize user input and declare password validation regex
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $passwordValidation = "/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/"; 
            //Init data
            $data = [
                'title' => "You can now use  your new password",
                'token' => $token,
            ];           

            //Load UI
            $this->ui('users/pwdone', $data);
        }

        public function userVerification(){
            // Sanitize the token
            $token = trim(filter_var($_GET['token'], FILTER_SANITIZE_STRING));

             // Init data
             $data = [
                'title' => '',                
            ];

            // Give token to token handler for processing
            if($this->tokenHandler($token) == "verification"){
                $this->userDAO->verificateUser($token);
                $this->tokenDAO->deleteToken($token);
                $data['title'] = "You are now verified";
            } else {
                $data['title'] = "Invalid request!";
            }

            //Load UI
            $this->ui('users/userverification', $data);
        }

        public function createUserSession($loggedInUser){
            try {
                $_SESSION['userId'] = $loggedInUser->userId;
                $_SESSION['userEmail'] = $loggedInUser->userMail;
                $_SESSION['userType'] = $loggedInUser->userType;
                $_SESSION['userName'] = $loggedInUser->userName;
                $_SESSION['userLastName'] = $loggedInUser->userLastName;
                $_SESSION['userStreet'] = $loggedInUser->userStreet;
                $_SESSION['userHouse'] = $loggedInUser->userHouse;
                $_SESSION['userPhone'] = $loggedInUser->userPhone;
                $_SESSION['userGender'] = $loggedInUser->userGender;
                $_SESSION['userVerified'] = $loggedInUser->verified;

            }
            catch(Exception $e) {
                die('f');
                $_SESSION['userId'] = $loggedInUser->userId;
                $_SESSION['userEmail'] = $loggedInUser->getUserEmail;
                $_SESSION['userType'] = $loggedInUser->userType;
                $_SESSION['userName'] = $loggedInUser->userName;
                $_SESSION['userLastName'] = $loggedInUser->userLastName;
                $_SESSION['userStreet'] = $loggedInUser->userStreet;
                $_SESSION['userHouse'] = $loggedInUser->userHouse;
                $_SESSION['userPhone'] = $loggedInUser->userPhoneStreet;
                $_SESSION['userGender'] = $loggedInUser->userGender;



                if($_SESSION['userType'] == 1 OR $_SESSION['userType'] == 2){
                    redirect('cms/dashboard');
                } else {
                redirect('pages/index');
                }
            }
        }

        public function logout(){
            unset($_SESSION['userId']);
            unset($_SESSION['userEmail']);
            unset($_SESSION['userType']);
            unset($_SESSION['userName']);
            unset($_SESSION['userLastName']);
            unset($_SESSION['userStreet']);
            unset($_SESSION['userHosue']);
            unset($_SESSION['userPhone']);
            unset($_SESSION['userGender']);
            unset($_SESSION['userVerified']);
            session_destroy();
            redirect('users/login');
        }

        public function isLoggedIn(){
            if(isset($_SESSION['userId'])){
                return true;
            } else {
                return false;
            }
        }

        public function createToken($email, $type){
            $token = bin2hex(openssl_random_pseudo_bytes(50));
            $this->tokenDAO->insertToken($email, $token, $type);
        }

        // Handles tokens
        public function tokenHandler($token){
            // Check if checkTokenType in the UserDAO returns a result
            if($row = $this->tokenDAO->checkTokenType($token)){
                // Return the tokenType
                return $row->tokenType;
            } 
            // If the token doesn't return a result
            else {
                return false;
            }            
        }

        public function newPasswordFormFactory($data, $token){
            echo '
                <form id="forgotForm" action="newpassword?token='.$token.'" method="POST">
                    <span>Password:</span>
                    <input type="password" name="password" placeholder="New password">
                    <span>Confirm password:</span>
                    <input type="password" name="passwordConfirmation" placeholder="Confirm password">
                    <input id="send" type="submit" value="submit">
                </form>
                <br/>
                <span class="invalidFeedback">'.$data['error'].'</span>';
        }
    }
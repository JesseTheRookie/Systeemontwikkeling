<?php
    class Users EXTENDS Controller{
        public function __construct(){
            $this->userModel = $this->model('User');
            $this->userDAO = $this->dal('UserDAO');
        }

        public function register(){
            //Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Process form

                //Sanitize POST data and determine validation regex
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $passwordValidation = "/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/";
                $nameValidation = "/^[a-zA-Z ]*$/";
                $streetValidation = "/^[a-zA-Z ]*$/";
                $phoneValidation = "/^[-0-9]*$/";
                $houseValidation = "/^[0-9]*$/";

                //Init data
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

                //Validate email not empty
                if(empty($user->getEmail())){
                    $data['emailError'] = 'Please enter email';
                }else {
                    //Check if email already exists
                    if($this->userDAO->findUserByEmail($user->getEmail())){
                        $data['emailError'] = 'Email is already taken';
                    }
                }

                //Validate Name not empty
                if(empty($user->getUserName())){
                    $data['nameError'] = 'Please enter name';
                } elseif(!preg_match($nameValidation, $user->getUserName())){
                    $data['nameError'] = 'Name can only contain letters and whitespace';
                }

                //Validate lastName not empty
                if(empty($user->getUserLastName())){
                    $data['lastNameError'] = 'Please enter last name';
                } elseif(!preg_match($nameValidation, $user->getUserLastName())){
                    $data['lastNameError'] = 'Name can only contain letters and whitespace';
                }

                //Validate phone not empty
                if(empty($user->getPhone())){
                    $data['phoneError'] = 'Please enter phone number';
                } elseif(!preg_match($phoneValidation, $user->getPhone())){
                    $data['phoneError'] = 'Phone can only contain numbers and -';
                }

                //Validate street not empty
                if(empty($user->getStreet())){
                    $data['streetError'] = 'Please enter street';
                } elseif(!preg_match($streetValidation, $user->getStreet())){
                    $data['streetError'] = 'Street can only contain letters and whitespace';
                }

                //Validate House Number not empty
                if(empty($user->getHouse())){
                    $data['houseError'] = 'Please enter house number';
                } elseif(!preg_match($houseValidation, $user->getHouse())){
                    $data['houseError'] = 'House number can only contain numbers';
                }

                //Validate Password not empty
                if(empty($user->getPassword())){
                    $data['passwordError'] = 'Please enter password';
                } elseif(strlen($user->getPassword()) < 6) {
                    $data['passwordError'] = 'Password must be at least 6 characters long';
                } elseif(!preg_match($passwordValidation, $user->getPassword())){
                    $data['passwordError'] = 'Password must have at least one numeric value, one uppercase character and one lowercase character';
                }

                 //Validate password confirmation
                 if(empty($user->getPasswordConfirm())){
                    $data['passwordConfirmError'] = 'Please confirm password';
                } else {
                    if($user->getPassword() != $user->getPasswordConfirm()){
                        $data['passwordConfirmError'] = 'Passwords do not match!';
                    }
                }

                //Convert gender to number
                if($user->getGender() == 'male'){
                    $user->setGender(1);
                } else {
                    $user->setGender(0);
                }

                //Make sure errors are empty
                if(empty($data['emailError']) && empty($data['nameError']) && empty($data['passwordError']) && empty($data['passwordConfirmError'])){
                    //Validated

                    //Hash password
                    $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));

                    //Register user
                    if($this->userDAO->register($user)){
                        flash('registerSuccess', 'You are now registered');
                        redirect('users/login');
                    } else {
                        //aanpassen naar iets fancies
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
            //Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Process form

                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Init data
                $user = new User();
                $user->setEmail(trim($_POST['email']));
                $user->setPassword(trim($_POST['password']));

                //Validate email not empty
                if(empty($user->getEmail())){
                    $data['emailError'] = 'Please enter email';
                }

                //Validate Password not empty
                if(empty($user->getPassword())){
                    $data['passwordError'] = 'Please enter password';
                }

                //Check user by email
                if(!empty($user->getEmail())){
                    if($this->userDAO->findUserByEmail($user->getEmail())){
                        //User found
                    } else{
                        //User not found
                        $data['emailError'] = 'No user found!';
                    }
                }

                //Make sure errors are empty
                if(empty($data['emailError']) && empty($data['passwordError'])){
                    //Validated
                    //Check and login
                    $loggedInUser = $this->userDAO->login($user);

                    if($loggedInUser){
                        //Create Session
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['passwordError'] = 'Password incorrect';
                        $data['emailError'] = '';
                        $this->ui('users/login', $data);
                    }

                } else {
                    //Load view with data
                    $this->ui('users/login', $data);
                }

            } else {
                //Init data
                $data = [
                    'email' => '',
                    'password' => '',
                    'emailError' => '',
                    'passwordError' => ''
                ];

                //Load ui
                $this->ui('users/login', $data);
            }
        }

        public function forgot(){
            //Init data
            $data = [
                'title' => 'Forgot password?'
            ];

            //Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $email = trim($_POST['email']);

                //Validate email not empty
                if(empty($email)){
                    $data['emailError'] = 'Please enter email';
                }else{
                    //Check user by email
                    if($this->userDAO->findUserByEmail($email)){
                        //User found

                        //Message
                        $msg = "You have requested a password recovery for your account at Haarlem Festival. \n
                        Click the link below to set up a new password \n
                        [link]";

                        // use wordwrap() if lines are longer than 70 characters
                        $msg = wordwrap($msg,70);

                        //Subject
                        $sub = "Haarlem Festival password recovery";

                        //Send email
                        //mail($email, $sub, $msg);

                        redirect("users/pwemailsend");

                    } else{
                        //User not found
                        $data['emailError'] = 'No user found!';
                    }
                }
            }

            //Load UI
            $this->ui('users/forgot', $data);
        }

        public function passwordEmailSend(){
            //Init data
            $data = [
                'title' => 'Password recovery email has been send'
            ];

            //Load UI
            $this->ui('users/pwemailsend', $data);
        }

        public function newPassword(){
            //Init data
            $data = [
                'title' => 'Enter new password'
            ];

            //Load UI
            $this->ui('users/newpw', $data);
        }

        public function createUserSession($loggedInUser){
            $_SESSION['userId'] = $loggedInUser->userId;
            $_SESSION['userEmail'] = $loggedInUser->getUserEmail;
            $_SESSION['userType'] = $loggedInUser->userType;
            $_SESSION['userName'] = $loggedInUser->userName;
            $_SESSION['userLastName'] = $loggedInUser->userLastName;
            $_SESSION['userStreet'] = $loggedInUser->userStreet;
            $_SESSION['userHouse'] = $loggedInUser->userHouse;
            $_SESSION['userPhone'] = $loggedInUser->userPhoneStreet;
            $_SESSION['userGender'] = $loggedInUser->userGender;


            if($_SESSION['userType'] == 1){
                redirect('cms/dashboard');
            } else {
            redirect('pages/index');
            }
        }

        public function logout(){
            unset($_SESSION['userId']);
            unset($_SESSION['userEmail']);
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
    }

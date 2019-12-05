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
                $data = [
                    'name' => trim($_POST['name']),
                    'lastName' => trim($_POST['lastName']),
                    'email' => trim($_POST['email']),
                    'street' => trim($_POST['street']),
                    'house' => trim($_POST['house']),
                    'phone' => trim($_POST['phone']),
                    'gender' => trim($_POST['gender']),
                    'password' => trim($_POST['password']),
                    'passwordConfirm' => trim($_POST['passwordConfirm']),
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
                if(empty($data['email'])){
                    $data['emailError'] = 'Please enter email';
                }else {
                    //Check if email already exists
                    if($this->userDAO->findUserByEmail($data)){
                        $data['emailError'] = 'Email is already taken';
                    }
                }

                //Validate Name not empty
                if(empty($data['name'])){
                    $data['nameError'] = 'Please enter name';
                } elseif(!preg_match($nameValidation, $data['name'])){
                    $data['nameError'] = 'Name can only contain letters and whitespace';
                }

                //Validate lastName not empty
                if(empty($data['lastName'])){
                    $data['lastNameError'] = 'Please enter last name';
                } elseif(!preg_match($nameValidation, $data['lastName'])){
                    $data['lastNameError'] = 'Name can only contain letters and whitespace';
                }

                //Validate phone not empty
                if(empty($data['phone'])){
                    $data['phoneError'] = 'Please enter phone number';
                } elseif(!preg_match($phoneValidation, $data['phone'])){
                    $data['phoneError'] = 'Phone can only contain numbers and -';
                }

                //Validate street not empty
                if(empty($data['street'])){
                    $data['streetError'] = 'Please enter street';
                } elseif(!preg_match($streetValidation, $data['street'])){
                    $data['streetError'] = 'Street can only contain letters and whitespace';
                }

                //Validate House Number not empty
                if(empty($data['house'])){
                    $data['houseError'] = 'Please enter house number';
                } elseif(!preg_match($houseValidation, $data['house'])){
                    $data['houseError'] = 'House number can only contain numbers';
                }

                //Validate Password not empty
                if(empty($data['password'])){
                    $data['passwordError'] = 'Please enter password';
                } elseif(strlen($data['password']) < 6) {
                    $data['passwordError'] = 'Password must be at least 6 characters long';
                } elseif(!preg_match($passwordValidation, $data['password'])){
                    $data['passwordError'] = 'Password must have at least one numeric value, one uppercase character and one lowercase character';
                }

                 //Validate password confirmation
                 if(empty($data['passwordConfirm'])){
                    $data['passwordConfirmError'] = 'Please confirm password';
                } else {
                    if($data['password'] != $data['passwordConfirm']){
                        $data['passwordConfirmError'] = 'Passwords do not match!';
                    }
                }

                //Convert gender to number
                if($data['gender'] == 'male'){
                    $data['gender'] = 1;
                } else {
                    $data['gender'] = 0;
                }

                //Make sure errors are empty
                if(empty($data['emailError']) && empty($data['nameError']) && empty($data['passwordError']) && empty($data['passwordConfirmError'])){
                    //Validated

                    //Hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                
                    //Register user
                    if($this->userDAO->register($data)){
                        flash('registerSuccess', 'You are now registered');
                        redirect('users/login');
                    } else {
                        die('Something went wrong'); 
                    }

                } else {
                    //Load view with errors
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
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),                    
                ];

                //Validate email not empty
                if(empty($data['email'])){
                    $data['emailError'] = 'Please enter email';
                }

                //Validate Password not empty
                if(empty($data['password'])){
                    $data['passwordError'] = 'Please enter password';
                }

                //Check user by email
                if(!empty($data['email'])){
                    if($this->userDAO->findUserByEmail($data)){
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
                    $loggedInUser = $this->userDAO->login($data['email'], $data['password']);

                    if($loggedInUser){
                        //Create Session
                        $this->createUserSession($loggedInUser); 
                    } else {
                        $data['passwordError'] = 'Password incorrect';
                        $data['emailError'] = '';
                        $this->ui('users/login', $data);
                    }

                } else {
                    //Load view with errors
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

        public function createUserSession($user){
            $_SESSION['userId'] = $user->userInlogId;
            $_SESSION['useremail'] = $user->userEmail;
            $_SESSION['userType'] = $user->userType;

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

   
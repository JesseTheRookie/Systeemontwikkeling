<?php   
    class Users EXTENDS Controller{
        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function register(){
            //Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Process form

                //Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Init data
                $data = [
                    'name' => trim($_POST['name']),
                    'lastName' => trim($_POST['lastName']),
                    'email' => trim($_POST['email']),
                    'address' => trim($_POST['address']),
                    'house' => trim($_POST['house']),
                    'phone' => trim($_POST['phone']),
                    'gender' => trim($_POST['gender']),
                    'password' => trim($_POST['password']),
                    'passwordConfirm' => trim($_POST['passwordConfirm']),
                    'nameError' => '',
                    'lastNameError' => '',
                    'emailError' => '',
                    'addressError' => '',
                    'houseError' => '',
                    'zipError' => '',
                    'phoneError' => '',
                    'passwordError' => '',
                    'passwordConfirmError' => ''
                ];

                //Validate email not empty
                if(empty($data['email'])){
                    $data['emailError'] = 'Please enter email';
                } else {
                    //Check if email already exists
                    if($this->userModel->findUserByEmail($data)){
                        $data['emailError'] = 'Email is already taken';
                    }
                }

                //Validate Name not empty
                if(empty($data['name'])){
                    $data['nameError'] = 'Please enter name';
                }

                //Validate lastName not empty
                if(empty($data['lastName'])){
                    $data['lastNameError'] = 'Please enter last name';
                }
                //Validate phone not empty
                if(empty($data['phone'])){
                    $data['phoneError'] = 'Please enter phone number';
                }

                //Validate Address not empty
                if(empty($data['address'])){
                    $data['addressError'] = 'Please enter address';
                }

                //Validate House Number not empty
                if(empty($data['house'])){
                    $data['houseError'] = 'Please enter house number';
                }

                //Validate Password not empty
                if(empty($data['password'])){
                    $data['passwordError'] = 'Please enter password';
                } elseif(strlen($data['password']) < 6) {
                    $data['passwordError'] = 'Password must be at least 6 characters long';
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
                    if($this->userModel->register($data)){
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
                    'address' => '',
                    'house' => '',
                    'phone' => '',
                    'gender' => '',
                    'password' => '',
                    'passwordConfirm' => '',
                    'nameError' => '',
                    'lastNameError' => '',
                    'emailError' => '',
                    'addressError' => '',
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
                    if($this->userModel->findUserByEmail($data)){
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
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);

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
            $_SESSION['useremail'] = $user->userInlogId;
            redirect('pages/index');
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

   
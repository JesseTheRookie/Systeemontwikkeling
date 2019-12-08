<?php   
    class User {
        public $userName;
        protected $userLastName;
        protected $email;
        protected $street;
        protected $house;
        protected $phone;
        protected $gender;
        protected $password;
        protected $passwordConfirm;

        //Get and Set for userName
        public function setUserName($userName){
            $this->userName = $userName;
        }
        public function getUserName(){
            return $this->userName;
        }

        //Get and Set for userLastName
        public function setUserLastName($userLastName){
            $this->userLastName = $userLastName;
        }
        public function getUserLastName(){
            return $this->userLastName;
        }

        //Get and Set for email
        public function setEmail($email){
            $this->email = $email;
        }
        public function getEmail(){
            return $this->email;
        }

        //Get and Set for street
        public function setStreet($street){
            $this->street = $street;
        }
        public function getStreet(){
            return $this->street;
        }

        //Get and Set for house
        public function setHouse($house){
            $this->house = $house;
        }
        public function getHouse(){
            return $this->house;
        }

        //Get and Set for phone
        public function setPhone($phone){
            $this->phone = $phone;
        }
        public function getPhone(){
            return $this->phone;
        }

        //Get and Set for gender
        public function setGender($gender){
            $this->gender = $gender;
        }
        public function getGender(){
            return $this->gender;
        }

        //Get and Set for password
        public function setPassword($password){
            $this->password = $password;
        }
        public function getPassword(){
            return $this->password;
        }

        //Get and Set for passwordConfirm
        public function setPasswordConfirm($passwordConfirm){
            $this->passwordConfirm = $passwordConfirm;
        }
        public function getPasswordConfirm(){
            return $this->passwordConfirm;
        }
    }
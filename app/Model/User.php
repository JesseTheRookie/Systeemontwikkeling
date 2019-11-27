<?php   
    class User {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        // Login user
        public function login($email, $password){
            $this->db->query('SELECT * FROM userinlog WHERE userEmail = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashedPassword = $row->userPassword;
            if(password_verify($password, $hashedPassword)){
                return $row;
            } else {
                return false;
            }
        }

        //Register user
        public function register($data){
            //Insert into table user
            $this->db->query('INSERT INTO user (userName, userLastName, userMail, userAddress, userHouseNum, userPhone, userGender) VALUES (:name, :lastName, :email, :address, :house, :phone, :gender)');
            //Bind values
            $this->db->bind(':name', $data['name']);      
            $this->db->bind(':lastName', $data['lastName']);        
            $this->db->bind(':email', $data['email']); 
            $this->db->bind(':address', $data['address']); 
            $this->db->bind(':house', $data['house']); 
            $this->db->bind(':phone', $data['phone']); 
            $this->db->bind(':gender', $data['gender']);
            
            //Execute
            if($this->db->execute()){
                $userReg = true;
            } else {
                $userReg = false;
            }            

            //Insert into table userInlog

            $this->db->query('INSERT INTO userinlog (userEmail, userPassword) VALUES (:email, :password)');
            //Bind values        
            $this->db->bind(':email', $data['email']); 
            $this->db->bind(':password', $data['password']); 
            
            //Execute
            if($this->db->execute()){
                $userInlogReg = true;
            } else {
                $userInlogReg = false;
            }

            if(($userReg == TRUE) && ($userInlogReg == TRUE)){
                return true;
            } else {
                return false;
            }
        }

        //Find user by email
        public function findUserByEmail($data){
            $this->db->query('SELECT * FROM userInlog WHERE userEmail = :email');
            //Bind values
            $this->db->bind(':email', $data['email']);  

            $row = $this->db->single();

            //Check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }

        }
    }
<?php
class UserDAO{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function register($user){
        //Insert into table user
        $this->db->query('INSERT INTO user (userName, userLastName, userMail, userAddress, userHouseNum, userPhone, userGender) VALUES (:name, :lastName, :email, :street, :house, :phone, :gender)');
        //Bind values
        $this->db->bind(':name', $user->getUserName());      
        $this->db->bind(':lastName', $user->getUserLastname());        
        $this->db->bind(':email', $user->getEmail()); 
        $this->db->bind(':street', $user->getStreet()); 
        $this->db->bind(':house', $user->getHouse()); 
        $this->db->bind(':phone', $user->getPhone()); 
        $this->db->bind(':gender', $user->getGender());
        
        //Execute
        if($this->db->execute()){
            $userReg = true;
        } else {
            $userReg = false;
        }            

        //Insert into table userInlog
        $this->db->query('INSERT INTO userinlog (userEmail, userPassword) VALUES (:email, :password)');
        //Bind values        
        $this->db->bind(':email', $user->getEmail()); 
        $this->db->bind(':password', $user->getPassword()); 
        
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

    // Login user
    public function login($user){
        $this->db->query('SELECT userinlog.*, user.* FROM userinlog INNER JOIN user ON userinlog.userInlogId = user.userId WHERE userEmail = :email');
        $this->db->bind(':email', $user->getEmail());

        $row = $this->db->single();

        $hashedPassword = $row->userPassword;
        if(password_verify($user->getPassword(), $hashedPassword)){
            return $row;
        } else {
            return false;
        }
    }

    //Find user by email
    public function findUserByEmail($user){
        $this->db->query('SELECT * FROM userInlog WHERE userEmail = :email');
        //Bind values
        $this->db->bind(':email', $user->getEmail());  

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }

    }
}
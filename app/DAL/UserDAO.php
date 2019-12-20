<?php
class UserDAO{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function register($user){
        //Insert into table user
        $this->db->query('INSERT INTO User (userName, userLastName, userMail, userPassword, userPhone, userGender) VALUES (:name, :lastName, :email, :password, :phone, :gender)');
        //Bind values
        $this->db->bind(':name', $user->getUserName());      
        $this->db->bind(':lastName', $user->getUserLastname());        
        $this->db->bind(':email', $user->getEmail());
        $this->db->bind(':password', $user->getPassword()); 
        $this->db->bind(':phone', $user->getPhone()); 
        $this->db->bind(':gender', $user->getGender());
        
        //Execute
        if($this->db->execute()){
            return true;
        } else {
            die('rip');
        }       
    }

    // Login user
    public function login($user){
        $this->db->query('SELECT * FROM User WHERE userMail = :email');
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
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM User WHERE userMail = :email');
        //Bind values
        $this->db->bind(':email', $email);  

        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    //
}
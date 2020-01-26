<?php
class UserDAO{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function register($user){
        // Insert into table user
        $this->db->query('INSERT INTO User (userName, userLastName, userMail, userPassword, userPhone, userGender, userStreet, userHouse)
                          VALUES (:name, :lastName, :email, :password, :phone, :gender, :street, :house)');
        // Bind values
        $this->db->bind(':name', $user->getUserName());
        $this->db->bind(':lastName', $user->getUserLastname());
        $this->db->bind(':email', $user->getEmail());
        $this->db->bind(':password', $user->getPassword());
        $this->db->bind(':phone', $user->getPhone());
        $this->db->bind(':gender', $user->getGender());
        $this->db->bind(':street', $user->getStreet());
        $this->db->bind(':house', $user->getHouse());

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            die('Query failed to execute!');
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
        // Prepare query
        $this->db->query('SELECT * FROM User WHERE userMail = :email');

        //Bind values
        $this->db->bind(':email', $email);

        // Execute
        $row = $this->db->single();

        //Check row
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function newPassword($token, $password){
        // Prepare query
        $this->db->query('  UPDATE User
                            INNER JOIN Tokens
                                ON User.userMail = Tokens.email
                            SET User.userPassword = :password
                            WHERE Tokens.token = :token');

        // Bind values
        $this->db->bind(':password', $password);
        $this->db->bind(':token', $token);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            die('Query failed to execute!');
        }
    }

    public function verificateUser($token){
        // Prepare query
        $this->db->query('  UPDATE User
                            INNER JOIN Tokens
                                ON User.userMail = Tokens.email
                            SET User.verified = "1"
                            WHERE Tokens.token = :token');

        // Bind values
        $this->db->bind(':token', $token);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            die('Query failed to execute!');
        }
    }
}

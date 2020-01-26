<?php
    class TokenDAO{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }


        // Insert token into the DB
        public function insertToken($email, $token, $type){
            // Prepare query
            $this->db->query('  INSERT INTO Tokens (token, email, tokenType)
                                VALUES (:token, :email, :tokenType)');
            
            // Bind values
            $this->db->bind(':token', $token);
            $this->db->bind(':email', $email);
            $this->db->bind(':tokenType', $type);
    
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                die('Query failed to execute!');
            }
        }

        // Check the tokenType of token
        public function checkTokenType($token){
            // Prepare query0
            $this->db->query('  SELECT (tokenType) FROM Tokens
                                WHERE token = :token');
            
            // Bind values
            $this->db->bind(':token', $token);
    
            // Execute
            if($row = $this->db->single()){   
                return $row;
            } else {
                return false;
            }
        }

        // Delete token
        public function deleteToken($token){
            // Prepare query
            $this->db->query('  DELETE FROM Tokens
                                WHERE token = :token');
            
            // Bind values
            $this->db->bind(':token', $token);
    
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                die('Query failed to execute!');
            }
        }

        // Get all tokens from the db which are older than specified hours
        public function getOldTokens(){

        }

    }
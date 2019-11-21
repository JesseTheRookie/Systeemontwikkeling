<?php
class JazzTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getAllJazzTickets(){
        $this->db->query("SELECT * FROM jazzticket");
        return $this->db->resultSet(); 
    }
}
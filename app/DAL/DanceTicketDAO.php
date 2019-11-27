<?php
class DanceTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getAllDanceTickets(){
        $this->db->query("SELECT * FROM danceticket");
        return $this->db->resultSet();
    }
}

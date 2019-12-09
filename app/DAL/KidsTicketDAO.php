<?php

class KidsTicket {

	    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getAllKidsTickets(){
        $this->db->query("SELECT * FROM kidsticket");

     // $this->db->bind(':artistName', $artistName);
 //    $row = $this->db->single();
$result = $this->db->resultSet();
return $result;
      // return $row;
    }

    public function getArtistInfo() {
      $this->db->query("SELECT * FROM artist WHERE eventtype = 'kids'");

      $result = $this->db->resultSet();

      return $result;
    }
}

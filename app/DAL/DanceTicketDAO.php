<?php
class DanceTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
      $this->danceT
    }

    public function getAllDanceTickets(){
        $this->db->query("SELECT * FROM danceticket");

     // $this->db->bind(':artistName', $artistName);
 //    $row = $this->db->single();
$result = $this->db->resultSet();
return $result;
      // return $row;
    }

    public function getArtistInfo() {
      $this->db->query("SELECT * FROM artist WHERE eventtype = 'dance'");

      $result = $this->db->resultSet();

      return $result;
    }
}

//2020-07-27 00:00:00

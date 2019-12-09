<?php
class DanceTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getAllDanceTickets(){
        $danceTicketArray = array();
        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.status, t.ticketQuantity, t.price, d.danceTicketLocation
                FROM tickets AS t
                INNER JOIN danceticket AS d
                ON t.ticketId = d.ticketId
                ");

        $danceTickets = $this->db->resultSet();


    }

    public function getArtistInfo() {
      $this->db->query("SELECT * FROM artist WHERE eventtype = 'dance'");

      $result = $this->db->resultSet();

      return $result;
    }
}

//2020-07-27 00:00:00

<?php
class DanceTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    //Get all dance tickets with artist names
    public function getAllDanceTickets(){
        $danceTicketArray = array();

        $sth = $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.ticketQuantity, t.price, d.danceTicketSession
                FROM tickets AS t
                INNER JOIN danceticket AS d
                ON t.ticketId = d.ticketId
                INNER JOIN locations AS l
                ON d.locationId = l.locationId
                ORDER BY t.startDateTime ASC
                ");

        $danceTickets = $this->db->resultSet();

        foreach ($danceTickets as $danceTicket) {
          $danceTicketModel = new DanceTicketModel();

          $danceTicketModel->setStartDateTime($danceTicket->startDateTime);
          $danceTicketModel->setEndDateTime($danceTicket->endDateTime);
          $danceTicketModel->setTicketQuantity($danceTicket->ticketQuantity);
          $danceTicketModel->setPrice($danceTicket->price);
          $danceTicketModel->setDanceTicketSession($danceTicket->danceTicketSession);

          //Add objects into array
          array_push($danceTicketArray, $danceTicketModel);
        }
        return $danceTicketArray;
    }

    //Get all artist names for section "Performers"
    public function getArtists() {
      $danceArtistArray = array();

      $this->db->query("SELECT p.DanceTicketId, a.artistName, a.artistBio, a.artistId
                FROM performancedance AS p
                INNER JOIN artist AS a
                ON p.DanceArtistId = a.artistId
                ");

      $danceArtists = $this->db->resultSet();

      foreach ($danceArtists as $danceArtist) {
            $danceArtistModel = new ArtistModel();

            $danceArtistModel->setArtistId($danceArtist->artistId);
            $danceArtistModel->setArtistName($danceArtist->artistName);
            $danceArtistModel->setArtistBio($danceArtist->artistBio);
            $danceArtistModel->setTicketId($danceArtist->DanceTicketId);

          array_push($danceArtistArray, $danceArtistModel);
        }
        return $danceArtistArray;
    }

    //Get different days based on the datetime function
    public function getDifferentDays() {
        $this->db->query("SELECT DISTINCT(DATE(startDateTime)) as startDateTime FROM tickets");

        $results = $this->db->resultSet();

        return $results;
    }
}
?>

<?php
class KidsTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    //Get all kids tickets with artist names
    public function getAllKidsTickets(){
        $kidsTicketArray = array();

        $sth = $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.ticketQuantity, t.price, d.kidsTicketSession
                FROM tickets AS t
                INNER JOIN kidsticket AS d
                ON t.ticketId = d.ticketId
                INNER JOIN locations AS l
                ON d.locationId = l.locationId
                ORDER BY t.startDateTime ASC
                ");

        $kidsTickets = $this->db->resultSet();

        foreach ($kidsTickets as $kidsTicket) {
          $kidsTicketModel = new KidsTicketModel();

          $kidsTicketModel->setStartDateTime($kidsTicket->startDateTime);
          $kidsTicketModel->setEndDateTime($kidsTicket->endDateTime);
          $kidsTicketModel->setTicketQuantity($kidsTicket->ticketQuantity);
          $kidsTicketModel->setPrice($kidsTicket->price);
          $kidsTicketModel->setKidsTicketSession($kidsTicket->kidsTicketSession);

          //Add objects into array
          array_push($kidsTicketArray, $kidsTicketModel);
        }
        return $kidsTicketArray;
    }

    //Get all artist names for section "Performers"
    public function getArtists() {
      $kidsArtistArray = array();

      $this->db->query("SELECT p.KidsTicketId, a.artistName, a.artistBio, a.artistId
                FROM performancekids AS p
                INNER JOIN artist AS a
                ON p.KidsArtistId = a.artistId
                ");

      $kidsArtists = $this->db->resultSet();

      foreach ($kidsArtists as $kidsArtist) {
            $kidsArtistModel = new ArtistModel();

            $kidsArtistModel->setArtistId($kidsArtist->artistId);
            $kidsArtistModel->setArtistName($kidsArtist->artistName);
            $kidsArtistModel->setArtistBio($kidsArtist->artistBio);
            $kidsArtistModel->setTicketId($kidsArtist->KidsTicketId);

          array_push($kidsArtistArray, $kidsArtistModel);
        }
        return $kidsArtistArray;
    }

    //Get different days based on the datetime function
    public function getDifferentDays() {
        $this->db->query("SELECT DISTINCT(DATE(startDateTime)) as startDateTime FROM tickets");

        $results = $this->db->resultSet();

        return $results;
    }
}
?>

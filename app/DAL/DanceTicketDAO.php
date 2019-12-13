<?php
class DanceTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    //Get all dance tickets with artist names
    public function getAllDanceTickets($ticketDate = 'Jopenkerk'){
        $danceTicketArray = array();

        $sth = $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.status, t.ticketQuantity, t.price, d.danceTicketLocation, d.danceTicketSession, a.artistName
                FROM tickets AS t
                INNER JOIN danceticket AS d
                ON t.ticketId = d.ticketId
                INNER JOIN performancedance AS p
                ON d.ticketId = p.danceTicketId
                INNER JOIN artist AS a
                ON p.danceArtistId = a.artistId
                WHERE d.danceTicketLocation = :ticketDate
                ORDER BY t.startDateTime ASC
                ");

      $this->db->bind(':ticketDate', $ticketDate);
      $danceTickets = $this->db->resultSet();

        foreach ($danceTickets as $danceTicket) {
          $danceTicketModel = new DanceTicketModel();

          $danceTicketModel->setTicketId($danceTicket->danceTicketLocation);
          $danceTicketModel->setStartDateTime($danceTicket->startDateTime);
          $danceTicketModel->setEndDateTime($danceTicket->endDateTime);
          $danceTicketModel->setTicketQuantity($danceTicket->ticketQuantity);
          $danceTicketModel->setPrice($danceTicket->price);
          $danceTicketModel->setDanceTicketLocation($danceTicket->danceTicketLocation);
          $danceTicketModel->setDanceTicketArtist($danceTicket->artistName);

          //Add objects into array
          array_push($danceTicketArray, $danceTicketModel);
        }
        return $danceTicketArray;
    }

    //Get all artist names for section "Performers"
    public function getArtists() {
      $danceArtistArray = array();

      $this->db->query("SELECT p.DanceTicketId, a.artistName, a.artistBio, a.eventType, a.artistId, a.imgUrl
                FROM performancedance AS p
                INNER JOIN artist AS a
                ON p.DanceArtistId = a.artistId"
                );

      $danceArtists = $this->db->resultSet();

      foreach ($danceArtists as $danceArtist) {
            $danceArtistModel = new ArtistModel();

            $danceArtistModel->setTicketId($danceArtist->DanceTicketId);
            $danceArtistModel->setArtistBio($danceArtist->artistBio);
            $danceArtistModel->setArtistId($danceArtist->artistId);
            $danceArtistModel->setArtistName($danceArtist->artistName);
            $danceArtistModel->setEventType($danceArtist->eventType);
            $danceArtistModel->setImgUrl($danceArtist->imgUrl);

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


       //Get all dance tickets with artist names
    public function dance(){
        $danceTicketArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.status, t.ticketQuantity, t.price, d.danceTicketLocation, d.danceTicketSession, a.artistName
                FROM tickets AS t
                INNER JOIN danceticket AS d
                ON t.ticketId = d.ticketId
                INNER JOIN performancedance AS p
                ON d.ticketId = p.danceTicketId
                INNER JOIN artist AS a
                ON p.danceArtistId = a.artistId
                WHERE d.danceTicketLocation = 'Jopenkerk'
                ORDER BY t.startDateTime ASC

                ");

        $danceTickets = $this->db->resultSet();

        foreach ($danceTickets as $danceTicket) {
          $danceTicketModel = new DanceTicketModel();

          $danceTicketModel->setTicketId($danceTicket->danceTicketLocation);
          $danceTicketModel->setStartDateTime($danceTicket->startDateTime);
          $danceTicketModel->setEndDateTime($danceTicket->endDateTime);
          $danceTicketModel->setTicketQuantity($danceTicket->ticketQuantity);
          $danceTicketModel->setPrice($danceTicket->price);
          $danceTicketModel->setDanceTicketLocation($danceTicket->danceTicketLocation);
          $danceTicketModel->setDanceTicketArtist($danceTicket->artistName);

          //Add objects into array
          array_push($danceTicketArray, $danceTicketModel);
        }
        return $danceTicketArray;
    }
}

//2020-07-27 00:00:00

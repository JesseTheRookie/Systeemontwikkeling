<?php

class KidsTicketDAO {

	    private $db;

    public function __construct(){
      $this->db = new Database;
    }

 //Get all artist names for section "Performers"
    public function getArtists() {
      $kidsArtistArray = array();

      $this->db->query("SELECT p.KidsTicketId, a.artistName, a.artistBio, a.eventType, a.artistId, a.imgUrl
                FROM performancekids AS p
                INNER JOIN artist AS a
                ON p.KidsArtistId = a.artistId"
                );

      $kidsArtists = $this->db->resultSet();

      foreach ($kidsArtists as $kidsArtist) {
            $kidsArtistModel = new ArtistModel();

            $kidsArtistModel->setTicketId($kidsArtist->KidsTicketId);
            $kidsArtistModel->setArtistBio($kidsArtist->artistBio);
            $kidsArtistModel->setArtistId($kidsArtist->artistId);
            $kidsArtistModel->setArtistName($kidsArtist->artistName);
            $kidsArtistModel->setEventType($kidsArtist->eventType);
            $kidsArtistModel->setImgUrl($kidsArtist->imgUrl);

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


       //Get all kids tickets with artist names
    public function kids(){
        $kidsTicketArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.status, t.ticketQuantity, t.price, d.kidsTicketLocation, d.kidsTicketSession, a.artistName
                FROM tickets AS t
                INNER JOIN kidsticket AS d
                ON t.ticketId = d.ticketId
                INNER JOIN performancedance AS p
                ON d.ticketId = p.kidsTicketId
                INNER JOIN artist AS a
                ON p.kidsArtistId = a.artistId
                WHERE d.kidsTicketLocation = 'Jopenkerk'
                ORDER BY t.startDateTime ASC

                ");

        $kidsTickets = $this->db->resultSet();

        foreach ($kidsTickets as $kidsTicket) {
          $kidsTicketModel = new KidsTicketModel();

          $kidsTicketModel->setTicketId($kidsTicket->kidsTicketLocation);
          $kidsTicketModel->setStartDateTime($kidsTicket->startDateTime);
          $kidsTicketModel->setEndDateTime($kidsTicket->endDateTime);
          $kidsTicketModel->setTicketQuantity($kidsTicket->ticketQuantity);
          $kidsTicketModel->setPrice($kidsTicket->price);
          $kidsTicketModel->setDanceTicketLocation($kidsTicket->kidsTicketLocation);
          $kidsTicketModel->setDanceTicketArtist($kidsTicket->artistName);

          //Add objects into array
          array_push($kidsTicketArray, $kidsTicketModel);
        }
        return $kidsTicketArray;
    }
}

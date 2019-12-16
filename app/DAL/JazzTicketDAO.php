<?php


class JazzTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getJazzTickets(){
        $jazzTicketArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.status, t.ticketQuantity, t.price, j.jazzTicketLocation, j.jazzTicketHall, a.artistName
                FROM tickets AS t
                INNER JOIN jazzticket AS j 
                ON t.ticketId = j.ticketId
                INNER JOIN performancejazz AS p
                ON j.ticketId = p.JazzTicketId
                INNER JOIN artist AS a 
                ON p.JazzArtist = a.artistId");

        $jazzTickets = $this->db->resultSet();

        foreach ($jazzTickets as $jazzTicket) {
            $jazzTicketModel = new JazzTicketModel();

            $jazzTicketModel->setTicketId($jazzTicket->ticketId);
            $jazzTicketModel->setStatus($jazzTicket->status);
            $jazzTicketModel->setTicketQuantity($jazzTicket->ticketQuantity);
            $jazzTicketModel->setStartDateTime($jazzTicket->startDateTime);
            $jazzTicketModel->setEndDateTime($jazzTicket->endDateTime);
            $jazzTicketModel->setJazzTicketLocation($jazzTicket->jazzTicketLocation);
            $jazzTicketModel->setJazzTicketHall($jazzTicket->jazzTicketHall);
            $jazzTicketModel->setPrice($jazzTicket->price);

            array_push($jazzTicketArray, $jazzTicketModel);
        }
        return $jazzTicketArray;
    }

    public function getArtists(){

        $artistArray = array();

        $this->db->query("SELECT p.JazzTicketId, a.artistName, a.artistBio, a.eventType, a.artistId
                FROM performancejazz AS p
                INNER JOIN artist AS a 
                ON p.JazzArtist = a.artistId");

        $artists =  $this->db->resultSet();

        foreach ($artists as $artist) {
            $artistModel = new ArtistModel();

            $artistModel->setTicketId($artist->JazzTicketId);
            $artistModel->setArtistBio($artist->artistBio);
            $artistModel->setArtistId($artist->artistId);
            $artistModel->setArtistName($artist->artistName);
            $artistModel->setEventType($artist->eventType);

            array_push($artistArray, $artistModel);
        }
        return $artistArray;
    }
}

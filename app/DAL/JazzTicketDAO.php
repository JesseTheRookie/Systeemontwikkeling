<?php


class JazzTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getJazzTickets(){
        $jazzTicketArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.ticketQuantity, t.price, jl.hall, l.stad
            FROM tickets AS t
            INNER JOIN jazzticket AS j
            ON t.ticketId = j.ticketId
            INNER JOIN jazzLocation AS jl
            ON j.ticketId = jl.ticketId
            INNER JOIN location AS l 
            ON jl.locationId = l.locationId");

        $jazzTickets = $this->db->resultSet();

        foreach ($jazzTickets as $jazzTicket) {
            $jazzTicketModel = new JazzTicketModel();

            $jazzTicketModel->setTicketId($jazzTicket->ticketId);
            $jazzTicketModel->setTicketQuantity($jazzTicket->ticketQuantity);
            $jazzTicketModel->setStartDateTime($jazzTicket->startDateTime);
            $jazzTicketModel->setEndDateTime($jazzTicket->endDateTime);
            $jazzTicketModel->setJazzTicketLocation($jazzTicket->stad);
            $jazzTicketModel->setJazzTicketHall($jazzTicket->hall);
            $jazzTicketModel->setPrice($jazzTicket->price);

            array_push($jazzTicketArray, $jazzTicketModel);
        }
        return $jazzTicketArray;
    }

    public function getArtists(){

        $artistArray = array();

        $this->db->query("SELECT p.JazzTicketId, a.artistName, a.artistBio, a.artistId
                FROM PerformanceJazz AS p
                INNER JOIN artist AS a
                ON p.JazzArtist = a.artistId");

        $artists =  $this->db->resultSet();

        foreach ($artists as $artist) {
            $artistModel = new ArtistModel();

            $artistModel->setTicketId($artist->JazzTicketId);
            $artistModel->setArtistBio($artist->artistBio);
            $artistModel->setArtistId($artist->artistId);
            $artistModel->setArtistName($artist->artistName);

            array_push($artistArray, $artistModel);
        }
        return $artistArray;
    }

    public function getDifferentDays() {
        $this->db->query("SELECT DISTINCT(DATE(t.startDateTime)) as startDateTime
                          FROM tickets as t
                          INNER JOIN jazzTicket as j
                          ON j.ticketId = t.ticketId");

        $results = $this->db->resultSet();

        return $results;
    }
}

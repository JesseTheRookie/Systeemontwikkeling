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

    public function getJazzTicketLocationsFromTicket($ticketId){
        $jazzTicketLocations = 0;

        $this->db->query("SELECT j.hall, l.stad
                                FROM JazzLocation AS j 
                                JOIN Location AS l 
                                ON j.locationId = l.locationId
                                WHERE j.ticketId = :id");

        $this->db->bind(':id', $ticketId);

        $result = $this->db->resultSet();

        foreach ($result as $location){
            $jazzTicketLocations = array(
                'city' => $location->stad,
                'hall' => $location->hall,
                'ticketId' => $ticketId
            );
            //array_push($jazzTicketLocations, $jazzTicketLocation);
        }
        return $jazzTicketLocations;
    }

    public function getArtistsFromTicket($ticketId){
        $jazzTicketArtists = array();

        $this->db->query("SELECT a.artistName,a.artistBio, a.artistId
                                FROM PerformanceJazz as p 
                                JOIN Artist as a 
                                ON p.jazzArtist = a.artistId
                                WHERE p.jazzTicketId = :id");

        $this->db->bind(':id', $ticketId);

        $artists =  $this->db->resultSet();

        foreach ($artists as $artist) {
            $artistModel = new ArtistModel();

            $artistModel->setTicketId($artist->JazzTicketId);
            $artistModel->setArtistName($artist->artistName);
            $artistModel->setArtistBio($artist->artistBio);
            $artistModel->setTicketId($ticketId);

            array_push($jazzTicketArtists, $artistModel);
        }
        return $jazzTicketArtists;
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

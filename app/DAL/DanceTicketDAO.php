<?php
class DanceTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    //Get all dance tickets based on button click that's passing ticket information
    public function getDanceTickets($ticketDate){
        $danceTicketArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.ticketQuantity, t.price, d.danceTicketSession
                FROM Tickets AS t
                INNER JOIN DanceTicket AS d
                ON t.ticketId = d.ticketId
                INNER JOIN Location AS l
                ON d.locationId = l.locationId
                WHERE DATE(t.startDateTime) = :ticketDate
                ORDER BY t.startDateTime ASC
                ");

        //Bind param with value from DB
        $this->db->bind(':ticketDate', $ticketDate);

        //Fetching results
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

      $this->db->query("SELECT p.DanceTicketId, a.artistName, a.artistBio, a.artistId, c.content
                FROM PerformanceDance AS p
                INNER JOIN Artist AS a
                ON p.danceArtistId = a.artistId
                INNER JOIN Content as c
                ON a.artistName = c.elementName
                      ");

      $danceArtists = $this->db->resultSet();

      foreach ($danceArtists as $danceArtist) {
            $danceArtistModel = new ArtistModel();

            $danceArtistModel->setArtistId($danceArtist->artistId);
            $danceArtistModel->setArtistName($danceArtist->artistName);
            $danceArtistModel->setArtistBio($danceArtist->artistBio);
            $danceArtistModel->setContent($danceArtist->content);

            array_push($danceArtistArray, $danceArtistModel);
        }
        return $danceArtistArray;
    }

    //Get different days based on the date function, preventign redudancy because there are multiple tickets with the same date
    public function getDifferentDays() {
        $this->db->query("SELECT DISTINCT(DATE(t.startDateTime)) as startDateTime
                          FROM Tickets as t
                          INNER JOIN DanceTicket as d
                          ON d.ticketId = t.ticketId
                        ");

        $results = $this->db->resultSet();

        return $results;
    }
}


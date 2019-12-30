<?php
class KidsTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    //Get all kids tickets based on button click that's passing ticket information
    public function getKidsTickets($ticketDate){
        $kidsTicketArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.ticketQuantity, t.price, k.kidsTicketSession
                FROM Tickets AS t
                INNER JOIN KidsTicket AS k
                ON t.ticketId = k.ticketId
                INNER JOIN Location AS l
                ON k.locationId = l.locationId
                WHERE DATE(t.startDateTime) = :ticketDate
                ORDER BY t.startDateTime ASC
                ");

        //Bind param with value from DB
        $this->db->bind(':ticketDate', $ticketDate);

        //Fetching results
        $kidsTickets = $this->db->resultSet();

        foreach ($kidsTickets as $kidsTicket) {
            $kidsTicketModel = new KidsTicketModel();

            $kidsTicketModel ->setStartDateTime($kidsTicket->startDateTime);
            $kidsTicketModel ->setEndDateTime($kidsTicket->endDateTime);
            $kidsTicketModel ->setTicketQuantity($kidsTicket->ticketQuantity);
            $kidsTicketModel ->setPrice($kidsTicket->price);
            $kidsTicketModel->setKidsTicketSession($kidsTicket->kidsTicketSession);

            //Add objects into array
            array_push($kidsTicketArray, $kidsTicketModel);
        }
        return $kidsTicketArray;
    }

    //Get all artist names for section "Performers"
    public function getArtists() {
      $kidsArtistArray = array();

      $this->db->query("SELECT a.artistId, a.artistName, a.artistBio, c.content
                        FROM Artist as a
                        INNER JOIN Content as c
                        ON a.artistName = c.elementName
                        WHERE c.eventType = 4
                      ");

      $kidsArtists = $this->db->resultSet();

      foreach ($kidsArtists as $kidsArtist) {
            $kidsArtistModel = new ArtistModel();

            $kidsArtistModel->setArtistId($kidsArtist->artistId);
            $kidsArtistModel->setArtistName($kidsArtist->artistName);
            $kidsArtistModel->setArtistBio($kidsArtist->artistBio);
            $kidsArtistModel->setContent($kidsArtist->content);

            array_push($kidsArtistArray, $kidsArtistModel);
        }
        return $kidsArtistArray;
    }

    //Get different days based on the date function, preventign redudancy because there are multiple tickets with the same date
    public function getDifferentDays() {
        $this->db->query("SELECT DISTINCT(DATE(t.startDateTime)) as startDateTime
                          FROM Tickets as t
                          INNER JOIN KidsTicket as d
                          ON d.ticketId = t.ticketId
                        ");

        $results = $this->db->resultSet();

        return $results;
    }
}


<?php
class DanceTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    //Get all dance tickets based on button click
    public function getAllDanceTickets($ticketDate){
        $danceTicketArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.ticketQuantity, t.price, d.danceTicketSession
                FROM tickets AS t
                INNER JOIN danceticket AS d
                ON t.ticketId = d.ticketId
                INNER JOIN locations AS l
                ON d.locationId = l.locationId
                WHERE DATE(t.startDateTime) = :ticketDate
                ORDER BY t.startDateTime ASC
                ");

        //Bind param with value from DB
        $this->db->bind(':ticketDate', $ticketDate);

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

      $this->db->query("SELECT a.artistId, a.artistName, a.artistBio, c.content
                        FROM artist as a
                        INNER JOIN content as c
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

    //Get different days based on the datetime function
    public function getDifferentDays() {
        $this->db->query("SELECT DISTINCT(DATE(t.startDateTime)) as startDateTime
                          FROM tickets as t
                          INNER JOIN danceticket as d
                          ON d.ticketId = t.ticketId
                        ");

        $results = $this->db->resultSet();

        return $results;
    }
}
?>

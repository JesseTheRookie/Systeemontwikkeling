<?php

class DanceTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getDanceContent() {
        $danceContentArray = array();

        $this->db->query("SELECT name, description, content
                          FROM Content as c
                          WHERE contentType = :contentType
                         ");

        $this->db->bind(':contentType', 2);

        $danceContent = $this->db->resultSet();

        foreach ($danceContent as $content) {
              $danceContentModel = new HomeModel();

              $danceContentModel->setName($content->name);
              $danceContentModel->setDescription($content->description);
              $danceContentModel->setContent($content->content);

              array_push($danceContentArray, $danceContentModel);
          }
          return $danceContentArray;
      }

      public function getDifferentDays() {
        $this->db->query("SELECT DISTINCT(DATE(t.startDateTime)) as startDateTime
                          FROM Tickets as t
                          INNER JOIN DanceTicket as d
                          ON d.ticketId = t.ticketId
                        ");

        $results = $this->db->resultSet();

        return $results;
    }

    public function getPerformers(){
        $dancePerformersArray = array();

        $this->db->query("SELECT description, content, name
                          FROM Content
                          WHERE EventType = :eventType AND Content IS NOT NULL AND contentType = :contentType
                        ");

        $this->db->bind(':eventType', 1);
        $this->db->bind(':contentType', 1);
        //Fetching results
        return $this->db->resultSet();
    }

    public function getArtists() {
      $this->db->query("SELECT a.artistName, dt.ticketId
                        FROM PerformanceDance AS d
                        INNER JOIN Artist AS a
                        ON d.danceArtistId = a.artistId
                        INNER JOIN Content as c
                        ON a.artistName = c.name
                        INNER JOIN DanceTicket as dt
                        ON d.danceTicketId = dt.ticketId
                       ");

      return $this->db->resultSet();
    }

    public function getDanceTickets($ticketDate){
        $danceTicketArray = array();

        $this->db->query("SELECT Tickets.ticketId, startDateTime, endDateTime, ticketQuantity, price, danceTicketSession
	         FROM Tickets
	         INNER JOIN DanceTicket
	         ON Tickets.ticketId = DanceTicket.ticketId
	         Left JOIN DanceLocation ON Tickets.ticketId = DanceLocation.ticketId
	         INNER JOIN Location ON DanceLocation.locationId = Location.locationId
	         WHERE DATE(startDateTime) = :ticketDate
	         ORDER BY price DESC");

        $this->db->bind(':ticketDate', $ticketDate);

        //Fetching results
        $danceTickets = $this->db->resultSet();

        foreach ($danceTickets as $danceTicket) {
            $danceTicketModel = new DanceTicketModel();

            $danceTicketModel->setTicketId($danceTicket->ticketId);
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
}
?>

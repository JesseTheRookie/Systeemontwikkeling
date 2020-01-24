<?php
class KidsTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    //Get the image, event name and buttons of top section Kids Page.
    public function getKidsContent() {
      $kidsContentArray = array();

      $this->db->query("SELECT name, description, content
                        FROM Content as c
                        WHERE contentType = :contentType
                       ");

      $this->db->bind(':contentType', 6);
      $kidsContent = $this->db->resultSet();

      foreach ($kidsContent as $content) {
            $kidsContentModel = new HomeModel();

            $kidsContentModel->setElementName($content->name);
            $kidsContentModel->setDescription($content->description);
            $kidsContentModel->setContent($content->content);

            array_push($kidsContentArray, $kidsContentModel);
        }
        return $kidsContentArray;
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

    //Get all artist names for section "Performers"
    public function getArtists() {
      $this->db->query("SELECT a.artistName, dt.ticketId
                        FROM PerformanceKids AS d
                        INNER JOIN Artist AS a
                        ON d.kidsTicketArtist = a.artistId
                        INNER JOIN Content as c
                        ON a.artistName = c.name
                        INNER JOIN KidsTicket as dt
                        ON d.kidsTicketId = dt.ticketId
                       ");

      return $this->db->resultSet();
    }

    //Get all kids performers
    public function getPerformers(){
        $kidsPerformersArray = array();

        $this->db->query("SELECT description, content, name
                          FROM Content
                          WHERE EventType = :eventType AND contentType != :contentType
                        ");

      $this->db->bind(':eventType', 4);
      $this->db->bind(':contentType', 6);

        //Fetching results
        return $this->db->resultSet();
    }

    //Get all kids tickets based on button click that's passing ticket information
    public function getKidsTickets($ticketDate){
        $kidsTicketArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.ticketQuantity, t.price, k.kidsTicketSession
                          FROM Tickets AS t
                          INNER JOIN KidsTicket AS k
                          ON t.ticketId = k.ticketId
                          INNER JOIN kidsLocation AS kl
                          ON k.ticketId = kl.ticketId
                          INNER JOIN Location AS l
                          ON k.locationId = l.locationId
                          WHERE t.startDateTime LIKE '%$ticketDate%'
                          ORDER BY t.price DESC
                        ");

        $this->db->bind(':ticketDate', $ticketDate);

        //Fetching results
        $kidsTickets = $this->db->resultSet();

        foreach ($kidsTickets as $kidsTicket) {
            $kidsTicketModel = new KidsTicketModel();

            $kidsTicketModel->setTicketId($kidsTicket->ticketId);
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
}


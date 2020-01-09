<?php
class DanceTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }


    //Get the image, event name and buttons of top section Dance Page.
    public function getDanceContent() {
      $danceContentArray = array();

      $this->db->query("SELECT elementName, description, content
                        FROM Content as c
                        WHERE contentType = 2
                      ");

      $danceContent = $this->db->resultSet();

      foreach ($danceContent as $content) {
            $danceContentModel = new HomeModel();

            $danceContentModel->setElementName($content->elementName);
            $danceContentModel->setDescription($content->description);
            $danceContentModel->setContent($content->content);

            array_push($danceContentArray, $danceContentModel);
        }
        return $danceContentArray;
    }

    //Get all artist names for section "Performers"
    public function getArtists() {
      $danceArtistArray = array();

      $this->db->query("SELECT d.danceTicketId, a.artistName, a.artistBio, a.artistId, c.content
                        FROM PerformanceDance AS d
                        INNER JOIN Artist AS a
                        ON d.danceArtistId = a.artistId
                        INNER JOIN Content as c
                        ON a.artistName = c.elementName
                        GROUP BY a.artistName
                      ");

      $danceArtists = $this->db->resultSet();

      foreach ($danceArtists as $danceArtist) {
            $danceArtistModel = new ArtistModel();

            $danceArtistModel->setTicketId($danceArtist->danceTicketId);
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

    //Get all dance tickets based on button click that's passing ticket information
    public function getDanceTickets($ticketDate){
        $danceTicketArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.ticketQuantity, t.price, d.danceTicketSession
                          FROM Tickets AS t
                          INNER JOIN DanceTicket AS d
                          ON t.ticketId = d.ticketId
                          INNER JOIN danceLocation AS dl
                          ON d.ticketId = dl.ticketId
                          INNER JOIN Location AS l
                          ON d.locationId = l.locationId
                          WHERE Date(t.startDateTime) = :ticketDate");

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


<?php
class TimeTableDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getEventNames() {
        $eventNamesArray = array();

        $this->db->query("SELECT eventTypeId, eventType AS event
                          FROM eventType
                          WHERE eventType != 'home'
                         ");

        //Fetching results
        $eventNames = $this->db->resultSet();

        foreach ($eventNames as $eventName) {
            $timeTableModel = new timeTableModel();

            $timeTableModel->setEventTypeId($eventName->eventTypeId);
            $timeTableModel->setEventType($eventName->event);

            //Add objects into array
            array_push($eventNamesArray, $timeTableModel);
        }
        return $eventNamesArray;
    }

    public function getDanceTickets() {
        $danceTicketArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.price, d.danceTicketSession
                          FROM Tickets AS t
                          INNER JOIN DanceTicket AS d
                          ON t.ticketId = d.ticketId
                          INNER JOIN danceLocation AS dl
                          ON d.ticketId = dl.ticketId
                          INNER JOIN Location AS l
                          ON d.locationId = l.locationId
                        ");

        //Fetching results
        $danceTickets = $this->db->resultSet();

        foreach ($danceTickets as $danceTicket) {
            $danceTicketModel = new DanceTicketModel();

            $danceTicketModel->setTicketId($danceTicket->ticketId);
            $danceTicketModel->setStartDateTime($danceTicket->startDateTime);
            $danceTicketModel->setEndDateTime($danceTicket->endDateTime);
            $danceTicketModel->setPrice($danceTicket->price);
            $danceTicketModel->setDanceTicketSession($danceTicket->danceTicketSession);

            //Add objects into array
            array_push($danceTicketArray, $danceTicketModel);
        }
        return $danceTicketArray;
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
}

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

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.ticketQuantity, t.price, d.danceTicketSession
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
            $danceTicketModel->setTicketQuantity($danceTicket->ticketQuantity);
            $danceTicketModel->setPrice($danceTicket->price);
            $danceTicketModel->setDanceTicketSession($danceTicket->danceTicketSession);

            //Add objects into array
            array_push($danceTicketArray, $danceTicketModel);
        }
        return $danceTicketArray;
    }
}

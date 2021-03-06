<?php
class PersonalTimeTableDAO {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getTicketsBoughtByUser(){

        $ticketsBoughtByUser = array();

        $this->db->query("SELECT t.ticketId, s.gereserveerd, t.startDateTime, t.endDateTime
                                FROM User as u
                                JOIN SoldTickets AS s
                                ON u.userId = s.userId
                                JOIN Tickets AS t 
                                ON s.ticketId = t.ticketId
                                WHERE u.userId = :id
                        ");

        $this->db->bind(':id', $_SESSION['userId']);

        $result = $this->db->resultSet();

        foreach ($result as $ticket) {

            $boughtTicket = array(
                'ticketId' => $ticket->ticketId,
                'reserved' => $ticket->gereserveerd,
                'start' => $ticket->startDateTime,
                'end' => $ticket->endDateTime
            );

            //Add objects into array
            array_push($ticketsBoughtByUser, $boughtTicket);
        }

        return $ticketsBoughtByUser;
    }

    /*
    //Get different days based on the date function, preventign redudancy because there are multiple tickets with the same date
    public function getDifferentDays() {
        $this->db->query("SELECT DISTINCT(DATE(t.startDateTime)) as startDateTime
                          FROM Tickets as t
                          ORDER BY startDateTime ASC
                        ");

        $results = $this->db->resultSet();

        return $results;
    }

    public function getUserTickets($id) {
        $userTicketsArray = array();

        $this->db->query("SELECT userId, userId, ticketId, date, quantity, gereserveerd
                          FROM SoldTickets
                          WHERE userId = :id
                        ");

        $this->db->bind(':id', $id);

        //Fetching results
        $userTickets = $this->db->resultSet();

        foreach ($userTickets as $userTicket) {
            $personalTimeTableModel = new PersonalTimeTableModel();

            $personalTimeTableModel->setUserId($userTicket->userId);
            $personalTimeTableModel->setTicketId($userTicket->ticketId);
            $personalTimeTableModel->setDate($userTicket->date);
            $personalTimeTableModel->setQuantity($userTicket->quantity);
            $personalTimeTableModel->setGereserveerd($userTicket->gereserveerd);

            //Add objects into array
            array_push($userTicketsArray, $personalTimeTableModel);
        }
        return $userTicketsArray;
    }
    */
}

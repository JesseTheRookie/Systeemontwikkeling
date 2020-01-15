<?php
class ShoppingCartDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }


    public function findDanceTicket($ticketId) {
        $this->db->query("SELECT t.ticketId AS ticketId, t.startDateTime AS startDateTime, t.price AS price, d.danceTicketSession AS name
                          FROM Tickets AS t
                          INNER JOIN DanceTicket AS d
                          ON t.ticketId = d.ticketId
                          WHERE t.ticketId = :ticketId
                        ");

        $this->db->bind(':ticketId', $ticketId);

        $result = $this->db->resultSet();
        $ticket = array();

        foreach ($result as $r) {
          $ticket = array(
          'ticketId' => $r->ticketId,
          'startDateTime' => $r->startDateTime,
          'price'=> $r->price,
          'name' => $r->name
          );
        }

        return $ticket;
    }
}

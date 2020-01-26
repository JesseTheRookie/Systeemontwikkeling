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

    public function findJazzTickets($ticketId) {
        $this->db->query("SELECT t.ticketId AS ticketId, t.startDateTime As startDateTime, t.price AS price, jl.hall AS name
                          FROM tickets AS t
                          INNER JOIN jazzticket AS j
                          ON t.ticketId = j.ticketId
                          INNER JOIN jazzLocation AS jl
                          ON j.ticketId = jl.ticketId
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

    public function findKidsTicket($ticketId) {
        $this->db->query("SELECT t.ticketId AS ticketId, t.startDateTime AS startDateTime, t.price AS price, k.kidsTicketSession AS name
                          FROM Tickets AS t
                          INNER JOIN KidsTicket AS k
                          ON t.ticketId = k.ticketId
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

    public function findFoodTicket($ticketId) {
        $this->db->query("SELECT t.ticketId AS ticketId, t.startDateTime AS startDateTime, t.price AS price, r.restaurantName AS name
                          FROM Tickets AS t
                          INNER JOIN FoodTicket AS f
                          ON f.ticketId = t.ticketId
                          INNER JOIN Restaurant as r
                          ON f.restaurantId = r.restaurantId
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

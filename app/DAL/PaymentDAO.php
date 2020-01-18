<?php
class PaymentDAO {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

        public function soldTickets() {
        $this->db->query("INSERT INTO SoldTickets (userId, ticketId, date, quantity, gereserveerd)
                          VALUES (:userId, :ticketId, :date , :quantity, :gereserveerd)
                        ");

        $result = $this->db->resultSet();
        return $ticket;
    }
}



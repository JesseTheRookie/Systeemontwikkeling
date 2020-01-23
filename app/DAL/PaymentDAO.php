<?php
class PaymentDAO {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

        public function soldTickets($data) {
        $this->db->query("INSERT INTO SoldTickets (userId, ticketId, date, quantity, gereserveerd)
                          VALUES (:userId, :ticketId, :date, :quantity, :gereserveerd)
                        ");

        $this->db->bind(':userId', $data['userId']);
        $this->db->bind(':ticketId', $data['ticketId']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':gereserveerd', 0);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}



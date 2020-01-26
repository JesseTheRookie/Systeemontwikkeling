<?php
class PaymentDAO {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

        public function soldTickets($data) {
        $this->db->query("INSERT INTO SoldTickets (userId, ticketId, date, quantity, gereserveerd, comments)
                          VALUES (:userId, :ticketId, :date, :quantity, :gereserveerd, :comments)
                        ");

        $this->db->bind(':userId', $data['userId']);
        $this->db->bind(':ticketId', $data['ticketId']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':gereserveerd', $data['status']);
        $this->db->bind(':comments', $data['comments']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}



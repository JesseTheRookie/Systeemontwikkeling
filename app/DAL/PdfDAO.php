
<?php
class PdfDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getOrderInformation() {
        $orderArray = array();

        $this->db->query("SELECT u.userId, u.userName, u.userLastName, u.userMail, u.userPhone, s.date, s.quantity, t.price
                          FROM User as u
                          INNER JOIN SoldTickets as s
                          ON u.userId = s.userId
                          INNER JOIN Tickets as t
                          ON s.ticketId = t.ticketId
                          WHERE u.userId = s.userId
                        ");

        $soldTickets = $this->db->resultSet();

        foreach ($soldTickets as $soldTicket) {
          $pdfModel = new PdfModel();

          $pdfModel->setUserId($soldTicket->userId);
          $pdfModel->setUserName($soldTicket->userName);
          $pdfModel->setuserLastName($soldTicket->userLastName);
          $pdfModel->setEmail($soldTicket->userMail);
          $pdfModel->setPhone($soldTicket->userPhone);
          $pdfModel->setDate($soldTicket->date);
          $pdfModel->setQuantity($soldTicket->quantity);
          $pdfModel->setPrice($soldTicket->price);

          //Add objects into array
          array_push($orderArray, $pdfModel);
        }
        return $orderArray;
    }
}

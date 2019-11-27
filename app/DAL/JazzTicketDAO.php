<?php
include '../Model/JazzTicketModel.php';
include '../libraries/Database.php';

class JazzTicketDAO{
    private $db;
    protected $jazzTicketList;

    public function __construct(){
      $this->db = new Database;
    }

    public function getAllJazzTickets(){
        $conn = new mysqli('localhost', 'root', '', 'haarlem_festival' );

        $sql = "SELECT * FROM jazzticket";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {

            $jazzTicket = new JazzTicket();
            $jazzTicket->setJazzTicketId($row["ticketId"]);  " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
          }
      } else {
          echo "0 results";
      }
      $conn->close();
    }
}
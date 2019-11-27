<?php
include '../Model/JazzTicketModel.php';
include '../libraries/Database.php';

class JazzTicketDAO{
    private $db;
    protected $jazzTicketList = array();

    public function __construct(){
      $this->db = new Database;
    }

    public function getAllJazzTickets(){
        $conn = new mysqli('localhost', 'root', '', 'haarlem_festival' );

        $sql = "SELECT t.ticketId, t.startDateTime, t.endDateTime, t.status, t.ticketQuantity, t.price, j.jazzTicketLocation, j.jazzTicketHall, a.artistName, a.artistBio, a.eventType, a.artistId
                FROM tickets AS t
                INNER JOIN jazzticket AS j 
                ON t.ticketId = j.ticketId
                INNER JOIN performancejazz AS p
                ON j.ticketId = p.JazzTicketId
                INNER JOIN artist AS a 
                ON p.JazzArtist = a.artistId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {

            $jazzTicket = new JazzTicket();
            $artist = new ArtistModel();
            $artists = array();

            $jazzTicket->setJazzTicketId($row["j.ticketId"]);
            $jazzTicket->setJazzTicketLocation($row["j.jazzTicketLocation"]);
            $jazzTicket->setJazzTicketHall($row["j.jazzTicketHall"]);
            $jazzTicket->setEndDateTime($row["t.endDateTime"]);
            $jazzTicket->setStartDateTime($row["t.startDateTime"]);
            $jazzTicket->setTicketQuantity($row["t.ticketQuantity"]);
            $jazzTicket->setPrice($row["t.price"]);
            $jazzTicket->setStatus($row["t.status"]);
            $artist->setArtistId($row["a.artistId"]);
            $artist->setArtistName($row["a.artistName"]);
            $artist->setArtistBio($row["a.artistBio"]);
            $artist->setEventType($row["a.eventType"]);
            array_push($artists, $artist);
            $jazzTicket->setArtists($artists);

            array_push($this->jazzTicketList, $jazzTicket);
          }
      } else {
          echo "0 results";
      }
      $conn->close();
    }
}

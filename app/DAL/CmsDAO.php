<?php

  class CmsDAO
  {
    public function __construct()
    {
      $this->DB = new Database;
    }

    public function GetTotalRev()
    {
      $this->DB->query("SELECT SUM(price) AS totalrev
        FROM Tickets
        INNER JOIN SoldTickets
        ON Tickets.ticketId = SoldTickets.ticketId");

      return $this->DB->single();
    }

    public function GetTotalTicketsSold()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets");

      return $this->DB->single();
    }

    public function GetTotalUniqueUsers()
    {
      $this->DB->query("SELECT COUNT(*) AS totalusers
        FROM User");

      return $this->DB->single();
    }

    public function GetTotalTicketsReserved()
    {
      $this->DB->query("SELECT SUM(gereserveerd)
        FROM soldTickets");

      return $this->DB->single();
    }

    public function GetActivityInfo($date, $event)
    {
      $result = array();

      switch ($event)
      {
        case "dance":
          $result = $this->GetDanceActivityInfo($date);
          break;
        case "jazz":
          $result = $this->GetJazzActivityInfo($date);
          break;
        case "food":
          $result = $this->GetHistoricActivityInfo($date);
          break;
        case "historic":
          $result = $this->GetFoodActivityInfo($date);
          break;
        case "kids":
          $result = $this->GetFoodActivityInfo($date);
          break;
        default:
          $result = $this->GetDanceActivityInfo($date);
      }

      return $result;
    }

    public function GetDanceActivityInfo($date)
    {
      $this->DB->query("SELECT ticketId, venue AS locationorlanguage, SUM(quantity) AS , ticketQuantity AS ticketsleft
        FROM DanceTicket
        INNER JOIN Tickets
        ON DanceTicket.ticketId = Tickets.ticketId
        INNER JOIN SoldTickets
        ON DanceTicket.ticketId = SoldTickets.ticketId
        INNER JOIN DanceLocation
        ON DanceTicket.ticketId = DanceLocation.ticketId
        WHERE DATE(startDateTime) = :date");

      
      //$dateFormatted = $date . "%";
      $this->DB->bind(':date', $date);

      return $this->DB->resultSet();
    }

    public function GetJazzActivityInfo($date)
    {
      $this->DB->query("SELECT jazzTicketLocation AS locationorlanguage, SUM(quantity) AS ticketssold, ticketQuantity AS ticketsleft
        FROM jazzticket
        INNER JOIN tickets
        ON jazzticket.ticketId = tickets.ticketId
        INNER JOIN soldtickets
        ON jazzticket.ticketId = soldtickets.ticketId
        WHERE date = :date");

      $this->DB->bind(':date', $date);

      return $this->DB->resultSet();
    }

    public function GetHistoricActivityInfo($date)
    {
      $this->DB->query("SELECT danceTicketLocation, COUNT(ticketId), ticketQuantity
        FROM danceticket
        INNER JOIN tickets
        ON tickets.ticketId = danceticket.ticketId
        INNER JOIN soldtickets
        ON tickets.ticketId = soldtickets.ticketId
        WHERE date = :date");

      $this->DB->bind(':date', $date);

      return $this->DB->resultSet();
    }

    public function GetFoodActivityInfo($date)
    {
      $this->DB->query("SELECT danceTicketLocation, COUNT(ticketId), ticketQuantity
        FROM danceticket
        INNER JOIN tickets
        ON tickets.ticketId = danceticket.ticketId
        INNER JOIN soldtickets
        ON tickets.ticketId = soldtickets.ticketId
        WHERE date = :date");

      $this->DB->bind(':date', $date);

      return $this->DB->resultSet();
    }

  }

?>

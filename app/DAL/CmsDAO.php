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
        FROM tickets
        INNER JOIN soldtickets
        ON tickets.ticketId = soldtickets.ticketId");

      return $this->DB->single();
    }

    public function GetTotalTicketsSold()
    {
      $this->DB->query("SELECT COUNT(*) AS totaltickets
        FROM soldtickets");

      return $this->DB->single();
    }

    public function GetTotalUniqueUsers()
    {
      $this->DB->query("SELECT COUNT(*) AS totalusers
        FROM user");

      return $this->DB->single();
    }

    public function GetTotalTicketsReserved()
    {
      $this->DB->query("SELECT SUM(ticketQuantity)
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
        case "historic":
          $result = $this->GetHistoricActivityInfo($date);
          break;
        case "historic":
          $result = $this->GetFoodActivityInfo($date);
          break;
        default:
          $result = $this->GetDanceActivityInfo($date);
      }

      return $result;
    }

    public function GetDanceActivityInfo($date)
    {
      $this->DB->query("SELECT danceTicketLocation AS locationorlanguage, COUNT(*) AS ticketssold, ticketQuantity AS ticketsleft
        FROM danceticket
        INNER JOIN tickets
        ON danceticket.ticketId = tickets.ticketId
        INNER JOIN soldtickets
        ON danceticket.ticketId = soldtickets.ticketId
        WHERE date = :date");

      $dateFormatted = $date . "%";
      $this->DB->bind(':date', $dateFormatted);

      return $this->DB->resultSet();
    }

    public function GetJazzActivityInfo($date)
    {
      $this->DB->query("SELECT jazzTicketLocation, COUNT(ticketId), ticketQuantity
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

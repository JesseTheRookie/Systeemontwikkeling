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
      $this->DB->query("SELECT SUM(quantity) AS totalreserved
        FROM SoldTickets
        WHERE gereserveerd = 1");

      return $this->DB->single();
    }

    public function GetDates()
    {
      $this->DB->query("SELECT DISTINCT(DATE(startDateTime)) AS date 
        From Tickets
        ORDER BY startDateTime DESC");

      return $this->DB->resultSet();
    }

    public function GetTimes()
    {
      $this->DB->query("SELECT DISTINCT(TIME(startDateTime)) AS time 
        From Tickets
        ORDER BY startDateTime DESC");

      return $this->DB->resultSet();
    }

    public function GetEvents()
    {
      $this->DB->query("SELECT eventType AS event 
        From EventType
        WHERE eventType != 'home'");

      return $this->DB->resultSet();
    }

    public function GetDanceActivityInfo($date)
    {
      $this->DB->query("SELECT Tickets.ticketId, venue AS identifier, danceTicketSession AS identifier2, SUM(quantity) AS soldtickets, COUNT(gereserveerd) AS reservedtickets, ticketQuantity AS ticketsleft
        FROM Tickets
        LEFT JOIN DanceTicket
        ON Tickets.ticketId = DanceTicket.ticketId
        LEFT JOIN DanceLocation
        ON Tickets.ticketId = DanceLocation.ticketId
        LEFT JOIN Location
        ON DanceLocation.locationId = Location.locationId
        LEFT JOIN SoldTickets
        ON Tickets.ticketId = SoldTickets.ticketId
        WHERE DATE(startDateTime) = :date
        GROUP BY venue");

      $this->DB->bind(':date', $date);
      
      return $this->DB->resultSet();
    }

    public function GetJazzActivityInfo($date)
    {
      $this->DB->query("SELECT naam AS identifier, hall AS identifier2, SUM(quantity) AS soldtickets, COUNT(gereserveerd) AS reservedtickets, ticketQuantity AS ticketsleft
        FROM Tickets
        INNER JOIN JazzTicket
        ON Tickets.ticketId = JazzTicket.ticketId
        LEFT JOIN JazzLocation
        ON Tickets.ticketId = JazzLocation.ticketId
        LEFT JOIN location
        ON JazzLocation.locationId = Location.locationId
        LEFT JOIN SoldTickets
        ON Tickets.ticketId = SoldTickets.ticketId
        WHERE DATE(startDateTime) = :date
        GROUP BY naam");

      $this->DB->bind(':date', $date);

      return $this->DB->resultSet();
    }

    public function GetHistoricActivityInfo($date)
    {
      $this->DB->query("SELECT language AS identifier, TIME(startDateTime) AS identifier2, SUM(quantity) AS soldtickets, SUM(gereserveerd) AS reservedtickets, ticketQuantity AS ticketsleft
        FROM Tickets
        INNER JOIN HistoricTicket
        ON Tickets.ticketId = HistoricTicket.ticketId
        LEFT JOIN HistoricLanguage
        ON tickets.ticketId = HistoricLanguage.historicTicketId
        LEFT JOIN Language
        ON HistoricLanguage.languageId = Language.languageId
        LEFT JOIN SoldTickets
        ON Tickets.ticketId = SoldTickets.ticketId
        WHERE date = :date
        GROUP BY language");

      $this->DB->bind(':date', $date);

      return $this->DB->resultSet();
    }

    public function GetFoodActivityInfo($date)
    {
      $this->DB->query("SELECT restaurantName AS identifier, TIME(startDateTime) AS identifier2, SUM(quantity) AS soldtickets, COUNT(gereserveerd) AS reservedtickets, ticketQuantity AS ticketsleft
        FROM Tickets
        INNER JOIN FoodTicket
        ON Tickets.ticketId = FoodTicket.ticketId
        LEFT JOIN Restaurant
        ON FoodTicket.restaurantId = Restaurant.restaurantId
        LEFT JOIN SoldTickets
        ON Tickets.ticketId = SoldTickets.ticketId
        WHERE date = :date
        GROUP BY restaurantName");

      $this->DB->bind(':date', $date);

      return $this->DB->resultSet();
    }

    public function GetKidsActivityInfo($date)
    {
      $this->DB->query("SELECT naam AS identifier, kidsTicketSession AS identifier2, SUM(quantity) AS soldtickets, COUNT(gereserveerd) AS reservedtickets, ticketQuantity AS ticketsleft
        FROM Tickets
        INNER JOIN KidsTicket
        ON Tickets.ticketId = KidsTicket.ticketId
        LEFT JOIN KidsLocation
        ON Tickets.ticketId = KidsLocation.ticketId
        LEFT JOIN Location
        ON KidsTicket.locationId = Location.locationId
        LEFT JOIN Soldtickets
        ON Tickets.ticketId = KidsTicket.ticketId
        WHERE date = :date
        GROUP BY naam");

      $this->DB->bind(':date', $date);

      return $this->DB->resultSet();
    }

    public function GetDanceProgramInfo($date)
    {
      $this->DB->query("SELECT Tickets.ticketId as id, TIME(startDateTime) AS Time, venue AS Venue, danceTicketSession AS Session, artistName AS Performer
        FROM Tickets
        INNER JOIN DanceTicket
        ON Tickets.ticketId = DanceTicket.ticketId
        LEFT JOIN DanceLocation
        ON Tickets.ticketId = DanceLocation.ticketId
        LEFT JOIN Location
        ON DanceLocation.locationId = Location.locationId
        LEFT JOIN PerformanceDance
        ON DanceTicket.ticketId = PerformanceDance.danceTicketId
        LEFT JOIN Artist
        ON PerformanceDance.danceArtistId = Artist.artistId
        WHERE DATE(startDateTime) = :date
        ORDER BY startDateTime ASC");

      $this->DB->bind(':date', $date);
      
      return $this->DB->resultSet();
    }

    public function GetJazzProgramInfo($date)
    {
      $this->DB->query("SELECT Tickets.ticketId as id TIME(startDateTime) AS Time, naam AS Venue, hall AS Hall, artistName AS Band
        FROM Tickets
        INNER JOIN DanceTicket
        ON Tickets.ticketId = JazzTicket.ticketId
        LEFT JOIN DanceLocation
        ON Tickets.ticketId = JazzLocation.ticketId
        LEFT JOIN Location
        ON JazzLocation.locationId = Location.locationId
        LEFT JOIN PerformanceDance
        ON JazzTicket.ticketId = PerformanceJazz.jazzTicketId
        LEFT JOIN Artist
        ON PerformanceJazz.jazzArtist = Artist.artistId
        WHERE DATE(startDateTime) = :date
        ORDER BY startDateTime ASC");

      $this->DB->bind(':date', $date);
      
      return $this->DB->resultSet();
    }

    public function GetKidsProgramInfo($date)
    {
      $this->DB->query("SELECT Tickets.ticketId as id, TIME(startDateTime) AS Time, naam AS Venue, kidsTicketSession AS Session, artistName AS Performer
        FROM Tickets
        INNER JOIN KidsTicket
        ON Tickets.ticketId = KidsTicket.ticketId
        LEFT JOIN KidsLocation
        ON Tickets.ticketId = KidsLocation.ticketId
        LEFT JOIN Location
        ON KidsLocation.locationId = Location.locationId
        LEFT JOIN PerformanceKids
        ON KidsTicket.ticketId = PerformanceKids.kidsTicketId
        LEFT JOIN Artist
        ON PerformanceKids.kidsTicketArtist = Artist.artistId
        WHERE DATE(startDateTime) = :date
        ORDER BY startDateTime ASC");

      $this->DB->bind(':date', $date);
      
      return $this->DB->resultSet();
    }

    public function GetFoodProgramInfo($date)
    {
      $this->DB->query("SELECT Tickets.ticketId as id, TIME(startDateTime) AS Time, restaurantName AS Restaurant, foodType AS Served, restaurantStars AS Stars
        FROM Tickets
        INNER JOIN FoodTicket
        ON Tickets.ticketId = FoodTicket.ticketId
        LEFT JOIN Restaurant
        ON FoodTicket.restaurantId = Restaurant.restaurantId
        LEFT JOIN Location
        ON Restaurant.locationId = Location.locationId
        LEFT JOIN RestaurantFoodType
        ON Restaurant.restaurantId = RestaurantFoodType.restaurantId
        LEFT JOIN FoodType
        ON RestaurantFoodType.foodtypeId = FoodType.foodTypeId
        WHERE DATE(startDateTime) = :date
        ORDER BY startDateTime ASC");

      $this->DB->bind(':date', $date);
      
      return $this->DB->resultSet();
    }

    public function GetHistoricProgramInfo($date)
    {
      $this->DB->query("SELECT SELECT Tickets.ticketId as id, TIME(startDateTime) AS starttime, naam AS identifier, kidsTicketSession AS identifier2, artistName AS performer
        FROM Tickets
        INNER JOIN DanceTicket
        ON Tickets.ticketId = KidsTicket.ticketId
        LEFT JOIN DanceLocation
        ON Tickets.ticketId = KidsLocation.ticketId
        LEFT JOIN Location
        ON KidsLocation.locationId = Location.locationId
        LEFT JOIN PerformanceDance
        ON KidsTicket.ticketId = PerformanceKids.kidsTicketId
        LEFT JOIN Artist
        ON PerformanceKids.kidsArtistId = Artist.artistId
        WHERE DATE(startDateTime) = :date
        ORDER BY startDateTime ASC");

      $this->DB->bind(':date', $date);
      
      return $this->DB->resultSet();
    }
    
    public function UpdateDanceProgram($event, $id, $columns)
    {
      $this->DB->query("UPDATE Tickets
        INNER JOIN DanceTicket
        ON Tickets.ticketId = DanceTicket.ticketId
        LEFT JOIN DanceLocation
        ON Tickets.ticketId = DanceLocation.ticketId
        LEFT JOIN Location
        ON DanceLocation.locationId = Location.locationId
        LEFT JOIN PerformanceDance
        ON DanceTicket.ticketId = PerformanceDance.danceTicketId
        LEFT JOIN Artist
        ON PerformanceDance.danceArtistId = Artist.artistId
        SET startDateTime = :starttime, venue = :identifier, danceTicketSession = :identifier2, artistName = :performer 
        WHERE Tickets.ticketId = :id");

      $this->DB->bind(':id', $id);
      $this->DB->bind(':starttime', $columns[0]);
      $this->DB->bind(':identifier', $columns[1]);
      $this->DB->bind(':identifier2', $columns[2]);
      $this->DB->bind(':performer', $columns[3]);
      
      $this->DB->execute();
    }   

    public function UpdateJazzProgram($event, $id, $columns)
    {
      $this->DB->query("UPDATE Tickets
        INNER JOIN DanceTicket
        ON Tickets.ticketId = JazzTicket.ticketId
        LEFT JOIN DanceLocation
        ON Tickets.ticketId = JazzLocation.ticketId
        LEFT JOIN Location
        ON JazzLocation.locationId = Location.locationId
        LEFT JOIN PerformanceDance
        ON JazzTicket.ticketId = PerformanceJazz.jazzTicketId
        LEFT JOIN Artist
        ON PerformanceJazz.jazzArtistId = Artist.artistId
        SET startDateTime = :starttime, naam = :identifier, hall = :identifier2, artistName = :performer 
        WHERE Tickets.ticketId = :id");

      $this->DB->bind(':id', $id);
      $this->DB->bind(':starttime', $columns[0]);
      $this->DB->bind(':identifier', $columns[1]);
      $this->DB->bind(':identifier2', $columns[2]);
      $this->DB->bind(':performer', $columns[3]);
      
      $this->DB->execute();
    }
    
    public function UpdateKidsProgram($event, $id, $columns)
    {
      $this->DB->query("UPDATE Tickets
        INNER JOIN KidsTicket
        ON Tickets.ticketId = KidsTicket.ticketId
        LEFT JOIN KidsLocation
        ON Tickets.ticketId = KidsLocation.ticketId
        LEFT JOIN Location
        ON KidsLocation.locationId = Location.locationId
        LEFT JOIN PerformanceKids
        ON KidsTicket.ticketId = PerformanceKids.kidsTicketId
        LEFT JOIN Artist
        ON PerformanceKids.kidsTicketArtist = Artist.artistId
        SET startDateTime = :starttime, naam = :identifier, kidsTicketSession = :identifier2, artistName = :performer 
        WHERE Tickets.ticketId = :id");

      $this->DB->bind(':id', $id);
      $this->DB->bind(':starttime', $columns[0]);
      $this->DB->bind(':identifier', $columns[1]);
      $this->DB->bind(':identifier2', $columns[2]);
      $this->DB->bind(':performer', $columns[3]);
      
      $this->DB->execute();
    }

    public function UpdateFoodProgram($event, $id, $columns)
    {
      $this->DB->query("UPDATE Tickets
        INNER JOIN FoodTicket
        ON Tickets.ticketId = FoodTicket.ticketId
        LEFT JOIN Restaurant
        ON FoodTicket.restaurantId = Restaurant.restaurantId
        LEFT JOIN Location
        ON Restaurant.locationId = Location.locationId
        LEFT JOIN RestaurantFoodType
        ON Restaurant.restaurantId = RestaurantFoodType.restaurantId
        LEFT JOIN FoodType
        ON RestaurantFoodType.foodtypeId = FoodType.foodTypeId
        SET startDateTime = :starttime, restaurantName = :identifier, foodType = :identifier2, restaurantStars = :stars 
        WHERE Tickets.ticketId = :id");

      $this->DB->bind(':id', $id);
      $this->DB->bind(':starttime', $columns[0]);
      $this->DB->bind(':identifier', $columns[1]);
      $this->DB->bind(':identifier2', $columns[2]);
      $this->DB->bind(':stars', $columns[3]);
      
      $this->DB->execute();
    }
  }

?>

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

    public function GetTotalTicketsSoldDance()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN DanceTicket
        ON SoldTickets.ticketId = DanceTicket.ticketId");

      return $this->DB->single();
    }

    public function GetDanceChartData30()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN DanceTicket
        ON SoldTickets.ticketId = DanceTicket.ticketId
        WHERE DATE(date) >= date(now()-interval 30 day)");

      return $this->DB->single();
    }

    public function GetDanceChartData60()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN DanceTicket
        ON SoldTickets.ticketId = DanceTicket.ticketId
        WHERE DATE(date) between DATE(now()-interval 30 day) AND DATE(now()-interval 60 day)");

      return $this->DB->single();
    }

    public function GetDanceChartData90()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN DanceTicket
        ON SoldTickets.ticketId = DanceTicket.ticketId
        WHERE DATE(date) between DATE(now()-interval 60 day) AND DATE(now()-interval 90 day)");

      return $this->DB->single();
    }

    public function GetDanceChartData()
    {
      return [$this->GetDanceChartData30(), $this->GetDanceChartData60(), $this->GetDanceChartData90()];
    }
    
    public function GetJazzChartData30()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN JazzTicket
        ON SoldTickets.ticketId = JazzTicket.ticketId
        WHERE DATE(date) >= date(now()-interval 30 day)");
        
      return $this->DB->single();
    }

    public function GetJazzChartData60()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN JazzTicket
        ON SoldTickets.ticketId = JazzTicket.ticketId
        WHERE DATE(date) between DATE(now()-interval 30 day) AND DATE(now()-interval 60 day)");

      return $this->DB->single();
    }

    public function GetJazzChartData90()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN JazzTicket
        ON SoldTickets.ticketId = JazzTicket.ticketId
        WHERE DATE(date) between DATE(now()-interval 60 day) AND DATE(now()-interval 90 day)");

      return $this->DB->single();
    }

    public function GetJazzChartData()
    {
      return [$this->GetJazzChartData30(), $this->GetJazzChartData60(), $this->GetJazzChartData90()];
    }

    public function GetKidsChartData30()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN KidsTicket
        ON SoldTickets.ticketId = KidsTicket.ticketId
        WHERE DATE(date) >= date(now()-interval 30 day)");

      return $this->DB->single();
    }

    public function GetKidsChartData60()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN KidsTicket
        ON SoldTickets.ticketId = KidsTicket.ticketId
        WHERE DATE(date) between DATE(now()-interval 30 day) AND DATE(now()-interval 60 day)");

      return $this->DB->single();
    }

    public function GetKidsChartData90()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN KidsTicket
        ON SoldTickets.ticketId = KidsTicket.ticketId
        WHERE DATE(date) between DATE(now()-interval 60 day) AND DATE(now()-interval 90 day)");

      return $this->DB->single();
    }

    public function GetKidsChartData()
    {
      return [$this->GetKidsChartData30(), $this->GetKidsChartData60(), $this->GetKidsChartData90()];
    }

    public function GetHistoricChartData30()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN HistoricTicket
        ON SoldTickets.ticketId = HistoricTicket.ticketId
        WHERE DATE(date) >= date(now()-interval 30 day)");

      return $this->DB->single();
    }

    public function GetHistoricChartData60()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN HistoricTicket
        ON SoldTickets.ticketId = HistoricTicket.ticketId
        WHERE DATE(date) between DATE(now()-interval 30 day) AND DATE(now()-interval 60 day)");

      return $this->DB->single();
    }

    public function GetHistoricChartData90()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN HistoricTicket
        ON SoldTickets.ticketId = HistoricTicket.ticketId
        WHERE DATE(date) between DATE(now()-interval 60 day) AND DATE(now()-interval 90 day)");

      return $this->DB->single();
    }

    public function GetHistoricChartData()
    {
      return [$this->GetHistoricChartData30(), $this->GetHistoricChartData60(), $this->GetHistoricChartData90()];
    }

    public function GetFoodChartData30()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN FoodTicket
        ON SoldTickets.ticketId = FoodTicket.ticketId
        WHERE DATE(date) >= date(now()-interval 30 day)");

      return $this->DB->single();
    }

    public function GetFoodChartData60()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN FoodTicket
        ON SoldTickets.ticketId = FoodTicket.ticketId
        WHERE DATE(date) between DATE(now()-interval 30 day) AND DATE(now()-interval 60 day)");

      return $this->DB->single();
    }

    public function GetFoodChartData90()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN FoodTicket
        ON SoldTickets.ticketId = FoodTicket.ticketId
        WHERE DATE(date) between DATE(now()-interval 60 day) AND DATE(now()-interval 90 day)");

      return $this->DB->single();
    }

    public function GetFoodChartData()
    {
      return [$this->GetFoodChartData30(), $this->GetFoodChartData60(), $this->GetFoodChartData90()];
    }

    public function GetTotalTicketsSoldJazz()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN JazzTicket
        ON SoldTickets.ticketId = JazzTicket.ticketId");

      return $this->DB->single();
    }

    public function GetTotalTicketsSoldKids()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN KidsTicket
        ON SoldTickets.ticketId = KidsTicket.ticketId");

      return $this->DB->single();
    }

    public function GetTotalTicketsSoldHistoric()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN HistoricTicket
        ON SoldTickets.ticketId = HistoricTicket.ticketId");

      return $this->DB->single();
    }

    public function GetTotalTicketsSoldFood()
    {
      $this->DB->query("SELECT SUM(quantity) AS totaltickets
        FROM SoldTickets
        INNER JOIN FoodTicket
        ON SoldTickets.ticketId = FoodTicket.ticketId");

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
        WHERE eventType != 'home' AND eventType != 'venues'");

      return $this->DB->resultSet();
    }

    public function GetTicketsSold30days()
    {
      $this->DB->query("SELECT SUM(quantity) AS ticketsSold
        FROM SoldTickets
        WHERE DATE(date) >= date(now()-interval 30 day)");

      return $this->DB->single();
    }

    public function GetTicketsSold7days()
    {
      $this->DB->query("SELECT SUM(quantity) AS ticketsSold
        FROM SoldTickets
        WHERE DATE(date) >= date(now()-interval 7 day)");

      return $this->DB->single();
    }

    public function GetTicketsSoldTrend()
    {
      $this->DB->query("SELECT SUM(quantity) AS ticketsSold
        FROM SoldTickets
        WHERE DATE(date) between DATE(now()-interval 30 day) AND DATE(now()-interval 60 day)");
      
      $twoMonths = $this->DB->single();
      $oneMonth = $this->GetTicketsSold30days();
      
      if($oneMonth > $twoMonths)
      {
        return '>';
      } 
      else if($oneMonth < $twoMonths)
      {
        return '<';
      }
      else 
      {
        return '=';
      }
    }

    public function GetTicketsSoldPerEvent()
    {
      $ticketsPerEvent = 
      $ticketsPerEvent = [$this->GetTotalTicketsSoldDance(), $this->GetTotalTicketsSoldJazz(), $this->GetTotalTicketsSoldKids(), $this->GetTotalTicketsSoldHistoric(), $this->GetTotalTicketsSoldFood()] ;
      
      return $ticketsPerEvent;
      
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
      $this->DB->query("SELECT artistName AS identifier, hall AS identifier2, SUM(quantity) AS soldtickets, COUNT(gereserveerd) AS reservedtickets, ticketQuantity AS ticketsleft
        FROM Tickets
        INNER JOIN JazzTicket
        ON Tickets.ticketId = JazzTicket.ticketId
        LEFT JOIN JazzLocation
        ON Tickets.ticketId = JazzLocation.ticketId
        LEFT JOIN Location
        ON JazzLocation.locationId = Location.locationId
        LEFT JOIN PerformanceJazz
        ON JazzTicket.ticketId = PerformanceJazz.jazzTicketId
        LEFT JOIN Artist
        ON PerformanceJazz.jazzArtist = Artist.artistId
        LEFT JOIN SoldTickets
        ON Tickets.ticketId = SoldTickets.ticketId
        WHERE DATE(startDateTime) = :date
        GROUP BY artistName");

      $this->DB->bind(':date', $date);

      return $this->DB->resultSet();
    }

    public function GetKidsActivityInfo($date)
    {
      $this->DB->query("SELECT artistName AS identifier, kidsTicketSession AS identifier2, SUM(quantity) AS soldtickets, COUNT(gereserveerd) AS reservedtickets, ticketQuantity AS ticketsleft
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
        LEFT JOIN SoldTickets
        ON Tickets.ticketId = SoldTickets.ticketId
        WHERE DATE(startDateTime) = :date
        GROUP BY artistName");

      $this->DB->bind(':date', $date);

      return $this->DB->resultSet();
    }

    public function GetHistoricActivityInfo($date)
    {
      $this->DB->query("SELECT TIME(startDateTime) AS identifier, SUM(quantity) AS soldtickets, SUM(gereserveerd) AS reservedtickets, SUM(ticketQuantity) AS ticketsleft
        FROM Tickets
        INNER JOIN HistoricTicket
        ON Tickets.ticketId = HistoricTicket.ticketId
        LEFT JOIN HistoricLanguage
        ON HistoricTicket.ticketId = HistoricLanguage.historicTicketId
        LEFT JOIN Language
        ON HistoricLanguage.languageId = Language.languageId
        LEFT JOIN SoldTickets
        ON Tickets.ticketId = SoldTickets.ticketId
        WHERE DATE(startDateTime) = :date
        GROUP BY TIME(startDateTime)");

      $this->DB->bind(':date', $date);

      $result = $this->DB->resultSet();

      for($i = 0; $i < count($result); $i++)
      {
        $languages = $this->getLanguagesHistoric($date, $result[$i]->identifier);
        $identifier2='';

        foreach($languages AS $language)
        {
          $identifier2 = $identifier2 . ' ' . $language->language;
        }     
        $result[$i]->{'identifier2'} = $identifier2;  
      }
      return $result;
    }

    public function getLanguagesHistoric($date, $time)
    {
      $this->DB->query("SELECT DISTINCT(language)
        FROM Tickets
        INNER JOIN HistoricTicket
        ON Tickets.ticketId = HistoricTicket.ticketId
        LEFT JOIN HistoricLanguage
        ON HistoricTicket.ticketId = HistoricLanguage.historicTicketId
        LEFT JOIN Language
        ON HistoricLanguage.languageId = Language.languageId
        LEFT JOIN SoldTickets
        ON Tickets.ticketId = SoldTickets.ticketId
        WHERE DATE(startDateTime) = :date AND TIME(startDateTime) = :time");
      
      $this->DB->bind(':date', $date);
      $this->DB->bind(':time', $time);

      return $this->DB->resultSet();

    }

    public function GetFoodActivityInfo($date)
    {
      $this->DB->query("SELECT restaurantName AS identifier, foodType AS identifier2, SUM(quantity) AS soldtickets, COUNT(gereserveerd) AS reservedtickets, SUM(ticketQuantity) AS ticketsleft
        FROM Tickets
        INNER JOIN FoodTicket
        ON Tickets.ticketId = FoodTicket.ticketId
        LEFT JOIN Restaurant
        ON FoodTicket.restaurantId = Restaurant.restaurantId
        LEFT JOIN SoldTickets
        ON Tickets.ticketId = SoldTickets.ticketId
        LEFT JOIN RestaurantFoodType
        ON Restaurant.restaurantId = RestaurantFoodType.foodTypeId
        LEFT JOIN FoodType
        ON RestaurantFoodType.foodTypeId = FoodType.foodTypeId
        WHERE DATE(startDateTime) = :date
        GROUP BY restaurantName");

      $this->DB->bind(':date', $date);

      return $this->DB->resultSet();
    }

    public function GetDanceProgramInfo($date)
    {
      $this->DB->query("SELECT Tickets.ticketId as id, danceArtistId AS idArtist, TIME(startDateTime) AS Time, venue AS Venue, danceTicketSession AS Session, artistName AS Performer
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

    public function GetKidsProgramInfo($date)
    {
      $this->DB->query("SELECT Tickets.ticketId as id, TIME(startDateTime) AS Time, kidsTicketSession AS Session, artistName AS Performer
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

    public function GetJazzProgramInfo($date)
    {
      $this->DB->query("SELECT Tickets.ticketId as id, TIME(startDateTime) AS Time, Location.naam AS Venue, hall AS Hall, artistName AS Band
        FROM Tickets
        INNER JOIN JazzTicket
        ON Tickets.ticketId = JazzTicket.ticketId
        LEFT JOIN JazzLocation
        ON Tickets.ticketId = JazzLocation.ticketId
        LEFT JOIN Location
        ON JazzLocation.locationId = Location.locationId
        LEFT JOIN PerformanceJazz
        ON JazzTicket.ticketId = PerformanceJazz.jazzTicketId
        LEFT JOIN Artist
        ON PerformanceJazz.jazzArtist = Artist.artistId
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
      $this->DB->query("SELECT Tickets.ticketId as id, TIME(startDateTime) AS Time, language AS Language
        FROM Tickets
        INNER JOIN HistoricTicket
        ON Tickets.ticketId = HistoricTicket.ticketId
        LEFT JOIN HistoricLanguage
        ON HistoricTicket.ticketId = HistoricLanguage.historicTicketId
        LEFT JOIN Language
        ON HistoricLanguage.languageId = Language.languageId
        WHERE DATE(startDateTime) = :date
        ORDER BY startDateTime ASC");

      $this->DB->bind(':date', $date);
      
      return $this->DB->resultSet();
    }
    
    public function UpdateDanceProgram($event, $id, $id2, $columns)
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
        WHERE Tickets.ticketId = :id AND danceArtistId = :id2");

      $this->DB->bind(':id', $id);
      $this->DB->bind(':id2', $id2);
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
        INNER JOIN JazzTicket
        ON Tickets.ticketId = JazzTicket.ticketId
        LEFT JOIN JazzLocation
        ON Tickets.ticketId = JazzLocation.ticketId
        LEFT JOIN Location
        ON JazzLocation.locationId = Location.locationId
        LEFT JOIN PerformanceJazz
        ON JazzTicket.ticketId = PerformanceJazz.jazzTicketId
        LEFT JOIN Artist
        ON PerformanceJazz.jazzArtist = Artist.artistId
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
        SET startDateTime = :starttime, kidsTicketSession = :session, artistName = :performer 
        WHERE Tickets.ticketId = :id");

      $this->DB->bind(':id', $id);
      $this->DB->bind(':starttime', $columns[0]);
      $this->DB->bind(':session', $columns[1]);
      $this->DB->bind(':performer', $columns[2]);
      
      $this->DB->execute();
    }

    public function UpdateHistoricProgram($event, $id, $columns)
    {
      $this->DB->query("UPDATE Tickets
        INNER JOIN HistoricTicket
        ON Tickets.ticketId = HistoricTicket.ticketId
        LEFT JOIN HistoricLanguage
        ON HistoricTicket.ticketId = HistoricLanguage.historicTicketId
        LEFT JOIN Language
        ON HistoricLanguage.languageId = Language.languageId
        SET startDateTime = :starttime, language = :language
        WHERE Tickets.ticketId = :id");

      $this->DB->bind(':id', $id);
      $this->DB->bind(':starttime', $columns[1]);
      $this->DB->bind(':language', $columns[2]);
      
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

    public function GetContent($eventType, $elementName)
    {
      $this->DB->query("SELECT contentId AS id, elementName AS element, name, description, content, ContentType.contentType, EventType.eventType
      FROM Content
      INNER JOIN ContentType
      ON Content.contentType = ContentType.contentTypeId
      INNER JOIN EventType
      ON Content.eventType = EventType.eventTypeId
      WHERE EventType.eventType = :eventType AND Content.elementName = :elementName");

      $this->DB->bind(':eventType', $eventType);
      $this->DB->bind(':elementName', $elementName);

      return $this->DB->resultSet();
    }

    public function GetContentSingle($eventType, $elementName)
    {
      $this->DB->query("SELECT contentId AS id, elementName AS element, name, description, content, ContentType.contentType, EventType.eventType
      FROM Content
      INNER JOIN ContentType
      ON Content.contentType = ContentType.contentTypeId
      INNER JOIN EventType
      ON Content.eventType = EventType.eventTypeId
      WHERE EventType.eventType = :eventType AND Content.elementName = :elementName");

      $this->DB->bind(':eventType', $eventType);
      $this->DB->bind(':elementName', $elementName);

      return $this->DB->single();
    }

    public function GetContentSinglePerId($contentId)
    {
      $this->DB->query("SELECT contentId AS id, elementName AS element, name, description, content, ContentType.contentType AS contentType, EventType.eventType AS eventType
      FROM Content
      INNER JOIN ContentType
      ON Content.contentType = ContentType.contentTypeId
      INNER JOIN EventType
      ON Content.eventType = EventType.eventTypeId
      WHERE Content.contentId = :contentId");

      $this->DB->bind(':contentId', $contentId);

      return $this->DB->single();
    }

    public function UpdateContentPerId($id, $name, $description, $content)
    {
      $this->DB->query("UPDATE content
      SET name = :name, description = :description, content = :content
      WHERE contentId = :id");
    

      $this->DB->bind(':name', $name);
      $this->DB->bind(':description', $description);
      $this->DB->bind(':content', $content);
      $this->DB->bind(':id', $id);

      $this->DB->execute();
    }

    public function getHistoricImages()
    {
      $this->DB->query("SELECT contentId AS id, name, description, content
                              FROM Content
                              WHERE eventType = 5 AND contentType = 1
                            ");

      return $this->DB->resultSet();
    }

    public function getHistoricTexts()
    {
      $this->DB->query("SELECT contentId AS id, name, description, content
                              FROM Content
                              WHERE eventType = 5 AND contentType = 4
                            ");

      return $this->DB->resultSet();
    }

    public function registerAsAdmin($gender, $firstname, $lastname, $email, $phonenumber, $street, $housenumber, $type, $password)
    {
      // Insert into table user
      $this->DB->query('INSERT INTO User (userName, userLastName, userMail, userPassword, userPhone, userGender, userStreet, userHouse, userType) 
                        VALUES (:name, :lastName, :email, :password, :phone, :gender, :street, :house, :type)');
      // Bind values
      $this->DB->bind(':name', $firstname);
      $this->DB->bind(':lastName', $lastname);
      $this->DB->bind(':email', $email);
      $this->DB->bind(':password', $password);
      $this->DB->bind(':phone', $phonenumber);
      $this->DB->bind(':gender', $gender);
      $this->DB->bind(':street', $street);
      $this->DB->bind(':house', $housenumber);
      $this->DB->bind(':type', $type);

      $this->DB->execute();
    }
  }

?>

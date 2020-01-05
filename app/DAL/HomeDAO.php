<?php
class HomeDAO {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    //Need to show information but there is no similarity between tables
    public function eventInformation() {
        $homeArray = array();

        $this->db->query("SELECT
	                        (SELECT COUNT(*) FROM Artist) as totalArtists,
                            (SELECT SUM(ticketQuantity) FROM tickets) as totalTickets,
                            (SELECT COUNT(*) FROM EventType) AS totalEvents,
                            (SELECT COUNT(*) FROM Location) AS totalLocations
                        ");

        $eventInformation = $this->db->resultSet();

        foreach ($eventInformation as $information) {
            $homeModel = new HomeModel();

            $homeModel->setTotalArtists($information->totalArtists);
            $homeModel->setTotalTickets($information->totalTickets);
            $homeModel->setTotalEvents($information->totalEvents);
            $homeModel->setTotalLocations($information->totalLocations);

            array_push($homeArray, $homeModel);
        }
        return $homeArray;
    }

    //Need start and end date of event, not sure if old tickets will be deleted, using now() function to get tickets later than NOW
    public function eventDates() {
        $homeDatesArray = array();

        $this->db->query("SELECT
                            MIN(startDateTime) as startDate,
                            MAX(endDateTime) as endDate
                            FROM Tickets
                            WHERE startDateTime >= now()"
                        );

        $eventDates = $this->db->resultSet();

        foreach($eventDates as $eventDate) {
            $homeModel = new HomeModel();

            $homeModel->setEventStartDate($eventDate->startDate);
            $homeModel->setEventEndDate($eventDate->endDate);

            array_push($homeDatesArray, $homeModel);
        }
        return $homeDatesArray;
    }

    //eventType = 2 are all the events
    public function allEvents() {
        $eventsArray = array();

        $this->db->query("SELECT elementName, description, content
                            FROM Content
                            WHERE eventType = 2
                        ");

        $events = $this->db->resultSet();

        foreach($events as $event) {
            $homeModel = new HomeModel();

            $homeModel->setElementName($event->elementName);
            $homeModel->setDescription($event->description);
            $homeModel->setContent($event->content);

            array_push($eventsArray, $homeModel);
        }
        return $eventsArray;
    }
}
?>

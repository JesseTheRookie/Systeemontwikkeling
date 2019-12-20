<?php
class HomeDAO {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function eventInformation() {
        $homeArray = array();

        $this->db->query("SELECT
	                        (SELECT COUNT(*) FROM artist) as totalArtists,
                            (SELECT SUM(ticketQuantity) FROM tickets) as totalTickets,
                            (SELECT COUNT(*) FROM eventType) AS totalEvents,
                            (SELECT COUNT(*) FROM location) AS totalLocations
                        ");

        $generalInformation = $this->db->resultSet();

        foreach ($generalInformation as $information) {
            $homeModel = new HomeModel();

            $homeModel->setTotalArtists($information->totalArtists);
            $homeModel->setTotalTickets($information->totalTickets);
            $homeModel->setTotalEvents($information->totalEvents);
            $homeModel->setTotalLocations($information->totalLocations);

            array_push($homeArray, $homeModel);
        }
        return $homeArray;
    }

    public function eventDates() {
        $homeDatesArray = array();

        $this->db->query("SELECT
                            MIN(startDateTime) as startDate,
                            MAX(endDateTime) as endDate
                            FROM Tickets
                            WHERE endDateTime >= now()"
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

    public function allEvents() {
        $eventsArray = array();

        $this->db->query("SELECT elementName, description, content
                            FROM Content WHERE eventType = 2"
                        );

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

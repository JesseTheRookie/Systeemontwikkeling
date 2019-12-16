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
                            (SELECT COUNT(*) FROM eventtype) AS totalEvents"
                        );

        $eventInformations = $this->db->resultSet();

        foreach ($eventInformations as $eventInformation) {
            $homeModel = new HomeModel();

            $homeModel->setTotalArtists($eventInformation->totalArtists);
            //$homeModel->setTotalLocations($eventInformation->artistBio);
            $homeModel->setTotalTickets($eventInformation->totalTickets);
            $homeModel->setTotalEvents($eventInformation->totalEvents);

            array_push($homeArray, $homeModel);
        }
        return $homeArray;
    }

    public function eventDates() {
        $homeDatesArray = array();

        $this->db->query("SELECT
                            MIN(startDateTime) as startDate,
                            MAX(endDateTime) as endDate
                            FROM tickets
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
}
?>

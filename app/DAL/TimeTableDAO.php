<?php
class TimeTableDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }


    public function getEventNames() {
        $eventNamesArray = array();

        $this->db->query("SELECT eventTypeId, eventType AS event
                          FROM eventType
                          WHERE eventType != 'home'
                         ");

        //Fetching results
        $eventNames = $this->db->resultSet();

        foreach ($eventNames as $eventName) {
            $timeTableModel = new timeTableModel();

            $timeTableModel->setEventTypeId($eventName->eventTypeId);
            $timeTableModel->setEventType($eventName->event);

            //Add objects into array
            array_push($eventNamesArray, $timeTableModel);
        }
        return $eventNamesArray;
    }
}

<?php
class Timetable Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->timeTableDal = $this->dal('TimeTableDAO');
        $this->homeDal = $this->dal('HomeDAO');

        $this->timeTableModel = $this->model('TimeTableModel');
        $this->danceTicketModel = $this->model('DanceTicketModel');
    }

    public function index () {

        $eventType = $this->timeTableDal->getEventNames();

        $data = [
            'events' => $eventType,
        ];

      $this->ui('pages/timetable', $data);
    }

    public function dance () {
        $eventType = $this->timeTableDal->getEventNames();
        $dance = $this->timeTableDal->getDanceTickets();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize GET data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($_POST['dance'])) {
                $eventTimes = $this->timeTableDal->getDanceTickets();
            }

        $data = [
            'events' => $eventType,
            'eventTimes' => $eventTimes
        ];
    }
      $this->ui('pages/timetable', $data);
}

    public function jazz () {
        $eventType = $this->timeTableDal->getEventNames();
        $jazz = $this->timeTableDal->getJazzTickets();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize GET data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($_POST['jazz'])) {
                $eventTimes = $this->timeTableDal->getJazzTickets();
            }

        $data = [
            'events' => $eventType,
            'eventTimes' => $eventTimes
        ];
    }
      $this->ui('pages/timetable', $data);
}
}

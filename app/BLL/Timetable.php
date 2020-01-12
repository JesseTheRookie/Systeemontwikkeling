<?php
class Timetable Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->timeTableDal = $this->dal('TimeTableDAO');
        $this->homeDal = $this->dal('HomeDAO');
        $this->timeTableModel = $this->model('TimeTableModel');
        $this->danceTicketModel = $this->model('DanceTicketModel');
    }

    public function index(){

        $eventType = $this->timeTableDal->getEventNames();
        $tickets = $this->timeTableDal->getDanceTickets();

        $data = [
            'events' => $eventType,
            'tickets' => $tickets
        ];

      $this->ui('pages/timetable', $data);
    }

    public function dance() {
        $eventType = $this->timeTableDal->getEventNames();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $tickets = $this->timeTableDal->getDanceTickets();

            $data = [
                'events' => $eventType,
                'tickets' => $tickets
            ];

        }
      $this->ui('pages/timetable', $data);
    }
}

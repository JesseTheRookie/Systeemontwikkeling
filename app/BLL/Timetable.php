<?php
class Timetable Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->timeTableDal = $this->dal('TimeTableDAO');
        $this->homeDal = $this->dal('HomeDAO');
        $this->timeTableModel = $this->model('TimeTableModel');
    }

    public function index(){

        $eventTimeTable = '';
        $eventType = $this->timeTableDal->getEventNames();

        $data = [
            'events' => $eventType
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $eventTimeTable = trim($_POST['ticketDate']);


        }

      $this->ui('pages/timetable', $data);

    }
}

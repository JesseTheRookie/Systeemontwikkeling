<?php
class PersonalTimeTable Extends Controller {

    //Create object for DAO and Model layer
    public function __construct() {
        //Sees is the session user id is there to check if you are logged in (in able to only acces the page)
       if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->personalTimeTableDal = $this->dal('PersonalTimeTableDAO');
        $this->personalTimeTableModel = $this->model('PersonalTimeTableModel');
    }

    public function index () {
        $days = $this->personalTimeTableDal->getDifferentDays();
        $tickets = $this->personalTimeTableDal->getUserTickets($id = '1');

        if () {

        }

        $data = [
            'days' => $days,
            'tickets' => $tickets
        ];

      $this->ui('pages/personaltimetable', $data);
    }

}

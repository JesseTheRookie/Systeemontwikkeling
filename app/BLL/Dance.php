<?php
class Dance Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->danceDal = $this->dal('DanceTicketDAO');
        $this->danceTicketModel = $this->model('DanceTicketModel');
        // Creating objects for getDanceContent (to prevent creating getters and setters that already exists)
        $this->homeModel = $this->model('HomeModel');
    }

    public function getAllArtists(){
        return $this->danceDal->getArtists();
    }

    public function  getDifferentDays(){
        return $this->danceDal->getDifferentDays();
    }

    public function getAllDanceTickets($date){
        $tickets = $this->danceDal->getDanceTickets($date);
        return $tickets;
    }

    //Need ticket/artist and days information. Passing it in an array that will be passed around on the website.
    public function index(){
        $content = $this->danceDal->getDanceContent();
        $days = $this->getDifferentDays();
        $performers = $this->danceDal->getPerformers();

        if($_SERVER['REQUEST_METHOD'] == 'GET') {

            // Sanitize GET data
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

            if(isset($_GET['ticketDate'])) {
                $ticketDate = $_GET['ticketDate'];
                } else {
                    $ticketDate = $days[0]->startDateTime;
                }

            $data = [
                'title' => 'Dance Page',
                'content' => $content,
                'days' => $this->getDifferentDays(),
                'tickets' => $this->getAllDanceTickets($ticketDate),
                'artists' => $this->getAllArtists(),
                'performers' => $performers
            ];
        } else {
            //Init Data
            $data = [
                'title' => 'Dance Page',
                'content' => '',
                'days' => '',
                'tickets' => '',
                'artists' => '',
                'performers' => ''
            ];
    }

    //Load View
    $this->ui('events/dance', $data);
    }
}

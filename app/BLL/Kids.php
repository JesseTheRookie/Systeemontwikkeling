<?php
class Kids Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->kidsDal = $this->dal('KidsTicketDAO');
        $this->kidsTicketModel = $this->model('KidsTicketModel');
        // Creating objects for getKidsContent (to prevent creating getters and setters that already exists)
        $this->homeModel = $this->model('HomeModel');
    }

    public function getAllArtists(){
        return $this->kidsDal->getArtists();
    }

    public function  getDifferentDays(){
        return $this->kidsDal->getDifferentDays();
    }

    public function getAllKidsTickets($date){
        $tickets = $this->kidsDal->getKidsTickets($date);
        return $tickets;
    }

    //Need ticket/artist and days information. Passing it in an array that will be passed around on the website.
    public function index(){
        $content = $this->kidsDal->getKidsContent();
        $days = $this->getDifferentDays();
        $performers = $this->kidsDal->getPerformers();

        if($_SERVER['REQUEST_METHOD'] == 'GET') {

            // Sanitize GET data
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

            if(isset($_GET['ticketDate'])) {
                $ticketDate = $_GET['ticketDate'];
                } else {
                    $ticketDate = $days[0]->startDateTime;
                }

            $data = [
                'title' => 'Kids Page',
                'content' => $content,
                'days' => $this->getDifferentDays(),
                'tickets' => $this->getAllKidsTickets($ticketDate),
                'artists' => $this->getAllArtists(),
                'performers' => $performers
            ];
        } else {
            //Init Data
            $data = [
                'title' => 'Kids Page',
                'content' => '',
                'days' => '',
                'tickets' => '',
                'artists' => '',
                'performers' => ''
            ];
    }

    //Load View
    $this->ui('events/kids', $data);
    }
}

<?php

class Jazz extends Controller {
    public function __construct(){
        $this->jazzTicketModel = $this->model('JazzTicketModel');
        $this->jazzTicketDAO = $this->dal('JazzTicketDAO');
    }

    public function getAllJazzTickets(){
        $artists = $this->getAllArtists();
        $tickets = $this->jazzTicketDAO->getJazzTickets();

        $this->mergeArtistAndTickets($tickets, $artists);

        return $tickets;
    }

    public function mergeArtistAndTickets($tickets, $artists){
        foreach($tickets as $ticket) {
            foreach($artists as $artist) {
                if($ticket->getTicketId() == $artist->getTicketId())
                    $ticket->addArtist($artist);
            }
        }
        return $tickets;
    }

    public function getJazzLocationsFromTicket($ticketId){
        return $this->jazzTicketDAO->getJazzTicketLocationsFromTicket($ticketId);
    }

    public function getJazzArtistsFromTicket($ticketId){
        return $this->jazzTicketDAO->getArtistsFromTicket($ticketId);
    }

    public function getJazzTicketFromTicket($ticketId, $reserved, $start, $end){
        $locations = $this->getJazzLocationsFromTicket($ticketId);
        $artists = $this->getJazzArtistsFromTicket($ticketId);
        if(!empty($locations)){

            $jazzTicket = new JazzTicketModel();

            $jazzTicket->setTicketId($ticketId);
            $jazzTicket->setReserved($reserved);
            $jazzTicket->setStartDateTime($start);
            $jazzTicket->setEndDateTime($end);
            $jazzTicket->setArtists($artists);
            $jazzTicket->setJazzTicketHall($locations['hall']);
            $jazzTicket->setJazzTicketLocation($locations['city']);

            return $jazzTicket;
         }
        else{
            return null;
        }
    }

    public function getJazzTicketsFromDate($date){
        return $this->jazzTicketDAO->getJazzTicketsFromDate($date);
    }

    public function getAllArtists(){
        return $this->jazzTicketDAO->getArtists();
    }

    public function  getDifferentDays(){
        return $this->jazzTicketDAO->getDifferentDays();
    }

    public function index(){
        $ticketDate = '';
        $data = [
            'title' => 'Jazz Page',
            'days' =>  $this->getDifferentDays(),
            'tickets' => $this->getAllJazzTickets(),
            'artists' => $this->getAllArtists()
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'days' =>  $this->getDifferentDays(),
                'tickets' => $this->getAllJazzTickets(),
                'artists' => $this->getAllArtists()
            ];
        }

        $this->ui('events/jazz', $data);
    }

    //'ADD' button will execute this
    public function orderJazzTickets() {

        $data = [
            'title' => 'Jazz Page',
            'days' =>  $this->getDifferentDays(),
            'tickets' => $this->getAllJazzTickets(),
            'artists' => $this->getAllArtists()
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Sanitize GET data
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

             $data = [
                'title' => 'Jazz Page',
                'days' =>  $this->getDifferentDays(),
                'tickets' => $this->getAllJazzTickets(),
                'artists' => $this->getAllArtists()
            ];

            //Quantity select has three values; bought tickets, ticketId and event type
            //Exploding it because we need them seperate.
            $info = explode("|", $_GET['quantity']);
            $eventType = $info[0];
            $quantity = $info[1];
            $ticketId = $info[2];

            //Creating an array and passing the quantity
            $items = array(
                'Quantity' => $quantity,
                'Event' => $eventType,
                'ticketId' => $ticketId,
                'comments' => ''

            );

            //If shoppingcart is not created (so empty), create one.
            if (!isset($_SESSION['shoppingCart'])) {
                $_SESSION['shoppingCart'] = array();
            }

            //Get quantity from session
            //If ticketId already exists in shopping cart, add it and do not create a new one
            if (!array_key_exists($ticketId, $_SESSION['shoppingCart'])) {
                $_SESSION['shoppingCart'][$ticketId] = $items;
            }

        //Load View
        $this->ui('events/jazz', $data);
        }
    }
}

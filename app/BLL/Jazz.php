<?php

class Jazz extends Controller {
    public function __construct(){
        $this->jazzTicketModel = $this->model('JazzTicketModel');
        $this->jazzTicketDAO = $this->dal('JazzTicketDAO');
    }

    public function getAllJazzTickets(){
        $artists = $this->getAllArtists();
        $tickets = $this->jazzTicketDAO->getJazzTickets();

        foreach($tickets as $ticket) {
            foreach($artists as $artist) {
                if($ticket->getTicketId() == $artist->getTicketId())
                    $ticket->addArtist($artist);
            }
        }

        return $tickets;
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
        include APPROOT . '/BLL/ShoppingCart.php';

        $content = $this->danceDal->getDanceContent();
        $days = $this->getDifferentDays();
        $performers = $this->danceDal->getPerformers();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Sanitize GET data
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

            $data = [
                    'title' => 'Dance Page',
                    'content' => $content,
                    'days' => $this->getDifferentDays(),
                    'tickets' => $this->getAllDanceTickets($_SESSION['ticketDate']),
                    'artists' => $this->getAllArtists(),
                    'performers' => $performers
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
                'ticketId' => $ticketId
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
        $this->ui('events/dance', $data);
        }
    }
}

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

    public function getDanceLocationsFromTicket($ticketId){
        return $this->danceDal->getDanceTicketLocationsFromTicket($ticketId);
    }

    public function getDanceArtistsFromTicket($ticketId){
        return $this->danceDal->getArtistsFromTicket($ticketId);
    }

    public function getDanceTicketFromTicket($ticketId, $reserved, $start, $end){
        $locations = $this->getDanceLocationsFromTicket($ticketId);
        $artists = $this->getDanceArtistsFromTicket($ticketId);

        $danceTicket = new DanceTicketModel();

        $danceTicket->setTicketId($ticketId);
        $danceTicket->setReserved($reserved);
        $danceTicket->setStartDateTime($start);
        $danceTicket->setEndDateTime($end);
        $danceTicket->setArtists($artists);
        $danceTicket->setDanceTicketLocation($locations['city']);

        return $danceTicket;
    }

    //Need ticket/artist and days information. Passing it in an array that will be passed around on the website.
    public function index(){
        $content = $this->danceDal->getDanceContent();
        $days = $this->getDifferentDays();
        $performers = $this->danceDal->getPerformers();

        if($_SERVER['REQUEST_METHOD'] == 'GET') {

            // Sanitize GET data
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

            //If GET request, the Date button that is clicked will be saved in a session
            if(isset($_GET['ticketDate'])) {
                $ticketDate = $_GET['ticketDate'];
                $_SESSION['ticketDate'] = $_GET['ticketDate'];
                } else {
                    $ticketDate = $days[0]->startDateTime;
                    $_SESSION['ticketDate'] = $days[0]->startDateTime;
                }


            $data = [
                'title' => 'Dance Page',
                'content' => $content,
                'days' => $this->getDifferentDays(),
                'tickets' => $this->getAllDanceTickets($ticketDate),
                'artists' => $this->getAllArtists(),
                'performers' => $performers,
                'message' => ''
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

    //'ADD' button will execute this
    public function order() {
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
                    'performers' => $performers,
                    'message' => ''
                ];

            //Print out success message when ticket added to shopping cart.
            $data['message'] = 'Ticket added in shopping cart!';

            //Quantity select has three values; bought tickets, ticketId and event type
            //Exploding it because we need them seperate.
            $info = explode("|", $_GET['quantity']);
            $eventType = $info[0];
            $quantity = $info[1];
            $ticketId = $info[2];

            $oldQuantity = 0;

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

            //If ticketId already exists in shopping cart, add it and do not create a new one
            if (!array_key_exists($ticketId, $_SESSION['shoppingCart'])) {
                $_SESSION['shoppingCart'][$ticketId] = $items;
                $_SESSION['oldQuantity'] = $quantity;
            } else {
                $oldQuantity = $quantity + $oldQuantity;
                $_SESSION['shoppingCart'][$ticketId] = $items;
            }

        //Load View
        $this->ui('events/dance', $data);
        }
    }
}

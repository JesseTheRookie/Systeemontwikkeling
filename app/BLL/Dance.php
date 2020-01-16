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

            if(isset($_GET['ticketDate'])) {
                $ticketDate = $_GET['ticketDate'];

                $_SESSION['ticketDate'] = $_GET['ticketDate'];
                var_dump($_SESSION);
                } else {
                    $ticketDate = $days[0]->startDateTime;
                    $_SESSION['ticketDate'] = $days[0]->startDateTime;
                    var_dump($_SESSION);
                }


            $data = [
                'title' => 'Dance Page',
                'content' => $content,
                'days' => $this->getDifferentDays(),
                'tickets' => $this->getAllDanceTickets($ticketDate),
                'artists' => $this->getAllArtists(),
                'performers' => $performers
            ];

        }
    //Load View
    $this->ui('events/dance', $data);
    }

    public function order() {
     include APPROOT . '/BLL/ShoppingCart.php';

        $content = $this->danceDal->getDanceContent();
        $days = $this->getDifferentDays();
        $performers = $this->danceDal->getPerformers();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $data = [
                    'title' => 'Dance Page',
                    'content' => $content,
                    'days' => $this->getDifferentDays(),
                    'tickets' => $this->getAllDanceTickets($_SESSION['ticketDate']),
                    'artists' => $this->getAllArtists(),
                    'performers' => $performers
                ];

                // Sanitize GET data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $quantity = explode("|", $_POST['quantity']);
                $ticketId = $quantity[1];
                $quantity = $quantity[0];

                $items = array(
                    'Quantity' => $quantity
                );
                var_dump($items);
                if (!isset($_SESSION['shoppingCart'])) {
                    $_SESSION['shoppingCart'] = array();
                }
                if (!array_key_exists($ticketId, $_SESSION['shoppingCart'])) {
                    $_SESSION['shoppingCart'][$ticketId]=$items;
                }
    //Load View
    $this->ui('events/dance', $data);
     }
}

}

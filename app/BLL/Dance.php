<?php
class Dance Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->danceDal = $this->dal('DanceTicketDAO');
        $this->danceTicketModel = $this->model('DanceTicketModel');
    }

     //Need ticket/artist and days information. Passing it in an array that will be passed around on the website.
    public function index(){
        $ticketDate = '';
        $days = $this->danceDal->getDifferentDays();
        $tickets = $this->danceDal->getAllDanceTickets($ticketDate);
        $artistInfo = $this->danceDal->getArtists();

        $data = [
                'title' => 'Dance Page',
                'days' => $days,
                'tickets' => $tickets,
                'artists' => $artistInfo
            ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ticketDate = trim($_POST['ticketDate']);

            $data = [
                'days' => $days,
                'tickets' => $tickets = $this->danceDal->getAllDanceTickets($ticketDate),
                'artists' => $artistInfo
            ];
        }

      $this->ui('events/dance', $data);
    }


    //Loop through artists and tickets
    public function getAllDanceTickets(){
            $data = [
                'title' => 'Dance Page',
                'ticketDate' => trim($_POST['ticketDate'])
            ];

            if ($this->danceDal->getAllDanceTickets($data['ticketDate'])) {
                $tickets = $this->danceDal->getAllDanceTickets($data['ticketDate']);
            }

            $artists = $this->getAllArtists();
            $tickets = $this->danceDal->getAllDanceTickets();

            foreach($tickets as $ticket) :
                foreach($artists as $artist) :
                    if($ticket->getTicketId == $artist->getTicketId)
                    $ticket->addArtist($artist);
                endforeach;
            endforeach;

        return $tickets;
    }

    public function tickets(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $tickets = $this->danceDal->getAllDanceTickets($data['ticketDate']);

            $data = [
                'title' => 'Dance Page',
                'days' => '',
                'tickets' => '',
                'artists' => '',
                'ticketDate' => trim($_POST['ticketDate'])
            ];

            if ($this->danceDal->getAllDanceTickets($data['ticketDate'])) {
                                    $tickets = $this->danceDal->getAllDanceTickets($data['ticketDate']);

            }

            $tickets = $this->danceDal->getAllDanceTickets();
        }

      $this->ui('events/dance', $data);
    }

    //Get all artists from DAO layer in order to print them under "performers"
    public function getAllArtists(){
        return $this->danceDal->getArtists();
    }
}


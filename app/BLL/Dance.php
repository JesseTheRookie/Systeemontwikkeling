<?php
class Dance Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->danceDal = $this->dal('DanceTicketDAO');
        $this->danceTicketModel = $this->model('DanceTicketModel');
        $this->danceTicketModel = $this->model('DanceTicketModel');
        $this->homeModel = $this->model('HomeModel');
    }

    public function getAllArtists(){
        return $this->danceDal->getArtists();
    }

    public function  getDifferentDays(){
        return $this->danceDal->getDifferentDays();
    }

    public function getAllDanceTickets(){
        $artists = $this->getAllArtists();
        $tickets = $this->danceDal->getDanceTickets();

        foreach($tickets as $ticket) {
            foreach($artists as $artist) {
                if($ticket->getTicketId() == $artist->getTicketId())
                    $ticket->addArtist($artist);
            }
        }
        return $tickets;
    }

    //Need ticket/artist and days information. Passing it in an array that will be passed around on the website.
    public function index(){
        $ticketDate = '';
        $content = $this->danceDal->getDanceContent();

        $days = $this->danceDal->getDifferentDays();
        $tickets = $this->getAllDanceTickets();
        $artists = $this->danceDal->getArtists();

        $data = [
                'title' => 'Dance Page',
                'content' => $content,
                'days' => $days,
                'tickets' => $tickets,
                'artists' => $artists,
                'quantityError' => ''
            ];

        /*if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ticketDate = trim($_POST['ticketDate']);
            $tickets = $this->danceDal->getDanceTickets($ticketDate);

            $data = [
                'days' => $days,
                'tickets' => $tickets,
                'artists' => $artists
            ];
        }*/
      $this->ui('events/dance', $data);
    }
}

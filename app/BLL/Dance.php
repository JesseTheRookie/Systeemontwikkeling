<?php
class Dance Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->danceDal = $this->dal('DanceTicketDAO');
        $this->danceTicketModel = $this->model('DanceTicketModel');
        $this->contentTicketModel = $this->model('ContentModel');
    }

    public function getAllDanceTickets(){
        $ticketDate = '';
        $artists = $this->getAllArtists();
        $tickets = $this->danceDal->getDanceTickets($ticketDate);

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
        $artists = $this->getAllArtists();
        $days = $this->danceDal->getDifferentDays();
        $tickets = $this->getAllDanceTickets();

        $data = [
                'title' => 'Dance Page',
                'content' => $content,
                'artists' => $artists,
                'days' => $days,
                'tickets' => $tickets,
                'ticketDate' => $ticketDate
            ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ticketDate = trim($_POST['ticketDate']);
            $tickets = $this->danceDal->getDanceTickets($ticketDate);

            $data = [
                'content' => $content,
                'artists' => $artists,
                'days' => $days,
                'tickets' => $tickets,
                'ticketDate' => $ticketDate
            ];
        }
      $this->ui('events/dance', $data);
    }

    //Get all artists from DAO layer in order to print them under "performers"
    public function getAllArtists(){
        return $this->danceDal->getArtists();
    }
}


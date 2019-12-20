<?php
class Kids Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->kidsDal = $this->dal('KidsTicketDAO');
        $this->kidsTicketModel = $this->model('KidsTicketModel');
    }

     //Need ticket/artist and days information. Passing it in an array that will be passed around on the website.
    public function index(){

        $data = [
        'title' => 'Kids Page',
        'days' => $days = $this->kidsDal->getDifferentDays(),
        'tickets' => $tickets = $this->kidsDal->getAllKidsTickets(),
        'artists' => $artistInfo = $this->kidsDal->getArtists($tickets),
      ];

      $this->ui('events/kids', $data);
    }

    //Loop through artists and tickets
    public function getAllKidsTickets(){
        $artists = $this->getAllArtists();
        $tickets = $this->kidsDal->getAllKidsTickets();

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
                    $tickets = $this->kidsDal->getAllKidsTickets($data['ticketDate']);

            $data = [
                'title' => 'Kids Page',
                'days' => '',
                'tickets' => '',
                'artists' => '',
                'ticketDate' => trim($_POST['ticketDate'])
            ];

            if ($this->kidsDal->getAllKidsTickets($data['ticketDate'])) {
                                    $tickets = $this->kidsDal->getAllKidsTickets($data['ticketDate']);

            }

            $tickets = $this->kidsDal->getAllKidsTickets();
        }

      $this->ui('events/kids', $data);
    }

    //Get all artists from DAO layer in order to print them under "performers"
    public function getAllArtists(){
        return $this->kidsDal->getArtists();
    }
}
<?php
class Kids Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->kidsDal = $this->dal('KidsTicketDAO');
        $this->kidsTicketModel = $this->model('KidsTicketModel');
    }

    //Need ticket/artist and days information. Passing it in an array that will be passed around on the website.
    public function index(){
        $ticketDate = '';
        $days = $this->kidsDal->getDifferentDays();
        $tickets = $this->kidsDal->getKidsTickets($ticketDate);
        $artists = $this->kidsDal->getArtists();

        $data = [
                'title' => 'Kids Page',
                'days' => $days,
                'tickets' => $tickets,
                'artists' => $artists
            ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ticketDate = trim($_POST['ticketDate']);
            $tickets = $this->kidsDal->getKidsTickets($ticketDate);

            $data = [
                'days' => $days,
                'tickets' => $tickets,
                'artists' => $artists
            ];
        }
      $this->ui('events/kids', $data);
    }

    //Get all artists from DAO layer in order to print them under "performers"
    public function getAllArtists(){
        return $this->kidsDal->getArtists();
    }
}


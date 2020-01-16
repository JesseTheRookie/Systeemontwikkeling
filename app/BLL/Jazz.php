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
            $ticketDate = trim($_POST['ticketDate']);

            $data = [
                'days' =>  $this->getDifferentDays(),
                'tickets' => $this->getAllJazzTickets(),
                'artists' => $this->getAllArtists()
            ];
        }

        $this->ui('events/jazz', $data);
    }
}

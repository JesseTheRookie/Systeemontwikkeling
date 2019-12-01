<?php


class JazzTicketService extends Controller {
    public function __construct(){
        $this->jazzTicketModel = $this->model('JazzTicketModel');
        $this->jazzTicketDAO = $this->dal('JazzTicketDAO');
    }

    public function getAllJazzTickets(){
       // return $this->jazzTicketDAO->getAllJazzTickets();
    }

    public function index(){
        $data = [
            'title' => 'Jazz Page',
            'tickets' => $this->jazzTicketDAO->getJazzTickets(),
            'artists' => $this->jazzTicketDAO->getArtists()
        ];
        $this->ui('events/jazz', $data);
    }
}

<?php


class JazzTicketService extends Controller {
    public function __construct(){
        $this->jazzTicketModel = $this->model('JazzTicketModel');
        $this->jazzTicketDAO = $this->dal('JazzTicketDAO');
    }

    public function getAllJazzTickets(){
        $artists = $this->getAllArtists();
        $tickets = $this->jazzTicketDAO->getJazzTickets();

        foreach($tickets as $ticket) :
            foreach($artists as $artist) :
                if($ticket->getTicketId() == $artist->getTicketId())
                    $ticket->addArtist($artist);
            }
        }

        return $tickets;
    }

    public function getAllArtists(){
        return $this->jazzTicketDAO->getArtists();
    }
    public function index(){
        $data = [
            'title' => 'Jazz Page',
            'tickets' => $this->getAllJazzTickets(),
            'artists' => $this->getAllArtists()
        ];
        $this->ui('events/jazz', $data);
    }
}

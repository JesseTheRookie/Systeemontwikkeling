<?php

class Jazz extends Controller {
    public function __construct(){
        $this->jazzTicketModel = $this->model('JazzTicketModel');
        $this->jazzTicketDAO = $this->dal('JazzTicketDAO');
    }

    public function getAllJazzTickets(){
        $artists = $this->getAllArtists();
        $tickets = $this->jazzTicketDAO->getJazzTickets();

        foreach($tickets as $ticket) {
            foreach($artists as $artist) {
                if($ticket->getTicketId() == $artist->getTicketId())
                    $ticket->addArtist($artist);
            }
        }

        return $tickets;
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

            $data = [
                'days' =>  $this->getDifferentDays(),
                'tickets' => $this->getAllJazzTickets(),
                'artists' => $this->getAllArtists()
            ];
        }

<<<<<<< HEAD
        $this->ui('events/jazz', $data);
    }
}
=======
        // Bottom left item
        public function gridItem3($data){
            $images = array_slice($data['images'], 1);

            echo 
            '
            <div class="contentItem">
                <img class="img" src="'.URLROOT.'/'.$images[0]->getImageUrl().'">
            </div>
            ';
        }        

        // Bottom right item
        public function gridItem4($data){
            $content = array_slice($data['content'], 1);

            echo '
                <div class="contentItem">
                    <h2 class="gridHeaders">
                        '.$content[0]->getHeader().'
                    </h2>
                
                    <p class="contentText">
                        '.$content[0]->getDescription().'
                    </p>
                
                    <br>
                
                    <a href="'.URLROOT.'/venues" class="button">
                        '.$content[0]->getButton().'
                    </a>
                </div>
            ';
        }
    }
>>>>>>> develop

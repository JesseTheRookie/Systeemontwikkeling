
//gggg
<?php
class Dance Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->danceDal = $this->dal('DanceTicketDAO');
        $this->danceTicketModel = $this->model('DanceTicketModel');
    }

     //Need ticket/artist and days information. Passing it in an array that will be passed around on the website.
    public function index(){

        $data = [
        'title' => 'Dance Page',
        'days' => $days = $this->danceDal->getDifferentDays(),
        'tickets' => $tickets = $this->danceDal->getAllDanceTickets(),
        'artists' => $artistInfo = $this->danceDal->getArtists($tickets),
        'ticketDate' => trim($_POST['ticketDate'])
      ];

      $this->ui('events/dance', $data);
    }

    //Loop through artists and tickets
    public function getAllDanceTickets(){
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


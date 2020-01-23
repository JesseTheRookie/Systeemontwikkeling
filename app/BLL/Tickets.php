<?php

class Tickets extends Controller {

    private $currentTicketArray = array();

    public function __construct(){
        $this->jazzController = $this->bll('Jazz');
        //$this->danceController = $this->bll('Dance');
        //$this->kidsController = $this->bll('Kids');
        //$this->historicController = $this->bll('Historic');
        //$this->foodController = $this->bll('Food');
    }

    public function index(){
        $data = [
            'title' => 'Ticket page',
            'tickets' => $this->currentTicketArray
        ];
       
        $this->ui('pages/tickets', $data);
    }

    public function setCurrentEvent(){
        $_SESSION["currentEvent"] = $_POST["event"];
        $this->index();
    }

    public function setCurrentDate(){
        $_SESSION["currentDate"] = $_POST["date"];
        $this->setTickets();
        $this->index();
    }

    private function getTicketsByEventAndDate(){
        switch ($_SESSION["currentEvent"]){
            case 'jazz':
                return $this->jazzController->getJazzTicketsFromDate($_SESSION["currentDate"]);
                break;
            case 'dance':
                //return $this->danceController->getDanceTicketsFromDate($this->currentDate);
                break;
            case 'historic':
                //return $this->historicController->getHistoricTicketsFromDate($this->currentDate);
                break;
            case 'food':
                //return $this->foodController->getFoodTicketsFromDate($this->currentDate);
                break;
            case 'kids':
                //return $this->kidsController->getKidsTicketsFromDate($this->currentDate);
                break;
        }
    }

    public function setTickets(){
        $tickets = $this->getTicketsByEventAndDate();

        switch ($_SESSION["currentEvent"]){
            case 'jazz':
            case 'kids':
            case 'dance':
                foreach ($tickets as $ticket){
                    $dateAndTime = explode(" ", $ticket->getStartDateTime());
                    $ticket = array(
                        'id' => $ticket->getTicketId(),
                        'name' => $ticket->getArtists(),
                        'price' => $ticket->getPrice(),
                        'quantity' => $ticket->getTicketQuantity(),
                        'time' => $dateAndTime[1]
                    );
                    array_push($this->currentTicketArray, $ticket);
                }
                break;
            case 'historic':
                foreach ($tickets as $ticket){
                    $dateAndTime = explode(" ", $ticket->getStartDateTime());
                    $ticket = array(
                        'id' => $ticket->getTicketId(),
                        'name' => $ticket->getHistoricTicketLocation(),
                        'price' => $ticket->getPrice(),
                        'quantity' => $ticket->getTicketQuantity(),
                        'time' => $dateAndTime[1]
                    );
                    array_push($currentTicketArray, $ticket);
                }
                break;
            case 'food':
                foreach ($tickets as $ticket){
                    $dateAndTime = explode(" ", $ticket->getStartDateTime());
                    $ticket = array(
                        'id' => $ticket->getTicketId(),
                        'name' => $ticket->getRestaurantName(),
                        'price' => $ticket->getPrice(),
                        'quantity' => $ticket->getTicketQuantity(),
                        'time' => $dateAndTime[1]
                    );
                    array_push($currentTicketArray, $ticket);
                }
                break;
        }
    }
}

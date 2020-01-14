<?php

class Ticketss extends Controller {

    public function __construct(){
        $this->jazzController = $this->bll('Jazz');
        $this->danceController = $this->bll('Dance');
        $this->kidsController = $this->bll('Kids');
        $this->historicController = $this->bll('Historic');
        $this->foodController = $this->bll('Food');
    }

    public function index(){
        $data = [
            'title' => 'Ticket page',
            'jazzTickets' =>  $this->jazzController->getAllJazzTickets(),
            'danceTickets' => $this->danceController->getAllDanceTickets()
            /*'kids tickets' => $this->kidsController->getAllKidsTickets(),
            'historic tickets' => $this->historicController->getAllHistoricTickets(),
            'food tickets' => $this->foodController->getAllFoodTickets(),*/
        ];
       
        $this->ui('pages/tickets', $data);
    }
}

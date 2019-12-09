<?php
class Dance Extends Controller{

    public function __construct() {
          $this->danceDal = $this->dal('DanceTicketDao');
    }

    public function index(){
      $tickets = $this->danceDal->getAllDanceTickets();
      $artistInfo = $this->danceDal->getArtistInfo($tickets);
      $data = [
        'title' => 'Dance Page',
        'tickets' => $tickets,
        'artists' => $artistInfo
      ];

      $this->ui('events/dance', $data);
    }

}

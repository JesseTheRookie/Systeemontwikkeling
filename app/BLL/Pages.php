<?php
  class Pages extends Controller {

    public function __construct(){
        $this->danceDal = $this->dal('DanceTicketDao');
        $this->homeDal = $this->dal('HomeDAO');
        $this->homeModel = $this->model('HomeModel');
    }

    public function index(){

      $data = [
        'title' => 'Welcome',
        'informations' => $eventInformation = $this->homeDal->eventInformation(),
        'dates' => $eventDates = $this->homeDal->eventDates()
      ];
      $this->ui('pages/index', $data);
    }

    public function historic(){
      $data = [
        'title' => 'Historic Page',
      ];

      $this->ui('events/historic', $data);
    }

    public function historicVenues(){
      $data = [
          'title' => 'Historic Venues'
      ];

      $this->ui('events/historicVenues', $data);
  }

    public function dashboard(){
      $data = "lol";
      $this->ui('pages/dashboard', $data);
    }

    public function shoppingcart(){
      $data = [
        'title' => 'Shopping Cart'
      ];

      $this->ui('pages/shoppingcart', $data);
    }
  }

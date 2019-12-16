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

    //Login, register and shopping cart pages
    /*public function register(){
      $data = [
        'title' => 'Registration Page',
      ];

      $this->ui('pages/registreren', $data);
    }

    public function login(){
      $data = [
        'title' => 'Login Page',
      ];

      $this->ui('pages/inloggen', $data);
    }*/

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

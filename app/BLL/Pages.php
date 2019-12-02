<?php
  class Pages extends Controller {

    public function __construct(){
      $this->postModel = $this->model('Post');
      $this->danceDal = $this->dal('DanceTicketDao');
    }

    public function index(){
      $posts = $this->postModel->getPerformance();

      $data = [
        'title' => 'Welcome',
        'posts' => $posts
      ];
      $this->ui('pages/index', $data);
    }

    //Event pages
    public function dance(){
      $tickets = $this->danceDal->getAllDanceTickets();
      $artistInfo = $this->danceDal->getArtistInfo($tickets);
      $data = [
        'title' => 'Dance Page',
        'tickets' => $tickets,
        'artists' => $artistInfo
      ];

      $this->ui('events/dance', $data);
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

    public function shoppingcart(){
      $data = [
        'title' => 'Shopping Cart'
      ];

      $this->ui('pages/shoppingcart', $data);
    }

    //Pages created for "Information" section
      public function rules(){
      $data = [
        'title' => 'Event Rules'
      ];

      $this->ui('information/rules', $data);
    }

    public function faq(){
      $data = [
        'title' => 'Event FAQ'
      ];

      $this->ui('information/faq', $data);
    }

      public function travel(){
      $data = [
        'title' => 'Event Travel'
      ];

      $this->ui('information/travel', $data);
    }
  }

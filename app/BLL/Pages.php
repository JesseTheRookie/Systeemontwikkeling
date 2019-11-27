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

    public function dance(){
      $tickets = $this->danceDal->getAllDanceTickets();
      $data = [
        'title' => 'Dance Page',
        'tickets' => $tickets
      ];

      $this->ui('events/dance', $data);
    }

    public function shoppingcart(){
      $data = [
        'title' => 'Shopping Cart'
      ];

      $this->ui('pages/shoppingcart', $data);
    }
  }

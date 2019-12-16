<?php
  class Pages extends Controller {
    public function __construct(){
      $this->postModel = $this->model('Post');
    }

    public function index(){
      $posts = $this->postModel->getPerformance();

      $data = [
        'title' => 'Welcome',
        'posts' => $posts
      ];

      $this->view('pages/index', $data);
    }

    public function dance(){
      $data = [
        'title' => 'Dance Page'
      ];

      $this->view('events/dance', $data);
    }

    public function shoppingcart(){
      $data = [
        'title' => 'Shopping Cart'
      ];

      $this->view('pages/shoppingcart', $data);
    }
  }

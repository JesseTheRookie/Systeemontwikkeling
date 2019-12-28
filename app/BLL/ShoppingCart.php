<?php

  class ShoppingCart extends Controller {

    public function __construct(){
        $this->shoppingCartDal = $this->dal('ShoppingCartDAO');
        $this->shoppingCartModel = $this->model('ShoppingCartModel');
    }

    public function index(){

      $data = [

      ];

      $this->ui('shoppingcart/shopping-cart', $data);
    }
  }

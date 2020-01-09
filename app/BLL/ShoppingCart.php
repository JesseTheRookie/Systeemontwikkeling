<?php
  class ShoppingCart extends Controller {

      private $total;

    public function __construct(){
        $this->shoppingCartDal = $this->dal('ShoppingCartDAO');
        $this->shoppingCartModel = $this->model('ShoppingCartModel');
    }

    public function index(){

      $data = [
          'title' => 'Shopping Cart'
      ];

      $this->ui('shoppingcart/shopping-cart', $data);
    }

    public function AddToCart($ticket){
      $_SESSION['cart'][$ticket->getTicketId()] = $ticket;
    }
    
    public function DeleteFromCart($id){
      unset($_SESSION['cart'][$id]);
    }

    public function CalculateTotalPrice(){
        foreach($_SESSION['cart'] as $ticket){
            $quantity = $ticket->getQuantity();
            $price = $ticket->getPrice();
            $this->total = $quantity * $price;
        }
    }

    public function EmptyCart(){
        unset($this->tickets);
    }
}

<?php
  class ShoppingCart extends Controller {

    private $items = array();
    public function __construct(){
       // $this->shoppingCartDal = $this->dal('ShoppingCartDAO');
        //$this->shoppingCartModel = $this->model('ShoppingCartModel');
    }

    public function index(){

      $data = [
          'title' => 'Shopping Cart'
      ];

      $this->ui('shoppingcart/shopping-cart', $data);
    }

    public function AddToCart($ticket){
      //$_SESSION['cart'][$ticket->getTicketId()] = $ticket;
        $items[$ticket->getTicketId()] = $ticket;
        foreach ($items as $t){
            echo "ey";
        }
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
        unset($_SESSION['cart']);
    }

    public function DisplayItems(){

        foreach ($this->items as $ticket){
           echo' 
                <table class="shoppingcart-items">
                    <tr>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>VAT %</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td>'.$ticket['ticket']->getArtists().'</td>
                        <td>1</td>
                        <td>21 %</td>
                        <td>150,00</td>
                        <td><img src="./img/delete.png" alt="Header food" title="Header food" class="header-food" /></td>
                    </tr>
                </table> ';
        }
    }
}


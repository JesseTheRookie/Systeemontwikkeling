<?php
  class ShoppingCart extends Controller {

    public function __construct(){
        $this->shoppingCartDal = $this->dal('ShoppingCartDAO');
        $this->shoppingCartModel = $this->model('ShoppingCartModel');
    }

    public function index(){

      $data = [
          'title' => 'Shopping Cart',
          'items' => $this->addToCart(),
      ];

      $this->ui('shoppingcart/shopping-cart', $data);
    }

    //On trashcan button click, check if the ticketId that has been sent through is available in the session, it it is, unset it and redirect to the shoppingcart without that item.
    public function deleteFromCart() {

      $data = [
          'title' => 'Shopping Cart',
          'items' => $this->addToCart()
      ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize GET data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Get ticket ID from trashcan button
            $ticketId = $_POST['delete'];

            //If ticketId is available in session, unset it and redirect to the shoppingcart.
            if (array_key_exists($ticketId, $_SESSION['shoppingCart'])) {
                unset($_SESSION['shoppingCart'][$ticketId]);
                redirect('shoppingcart/shopping-cart');
            }
          }
        }

    //If a shopping cart isn't available, create one, loop through the id's which are the keys of an array, and per event, create an item with a DB query
    public function addToCart() {
        $cartItems = [];

        //Create session shoppinCart if it does not exists.
        if (!isset($_SESSION['shoppingCart'])) {
            $_SESSION['shoppingCart'] = array();
        }
        if (count($_SESSION['shoppingCart']) > 0) {
            $ids = array_keys($_SESSION['shoppingCart']);
            foreach ($ids as $id) {
                //Create cart item for dance tickets
                if (!empty($_SESSION['shoppingCart'][$id]['Event'] == 'dance')) {
                    $cartItem = $this->shoppingCartDal->findDanceTicket($id);
                    $cartItems[] = $cartItem;
                  }
                //Create cart item for jazz tickets
                if (!empty($_SESSION['shoppingCart'][$id]['Event'] == 'jazz')) {
                    $cartItem = $this->shoppingCartDal->findJazzTickets($id);
                    $cartItems[] = $cartItem;
                  }
            }
        }
        $_SESSION['cartItems'] = $cartItems;
        //Return a array of cart items
        return $cartItems;
    }

  //Creating a function for the quantity so we can multiply it easier in a different function.
  //Passing in ID from so we can check if id is equal to the session id.
  public function getQuantity($id) {
        $data = [
          'title' => 'Shopping Cart',
          'items' => $this->addToCart()
        ];

        foreach ($_SESSION['shoppingCart'] as $quantity => $total) {
            //Converting array ($Total) to a string by the implode function.
            if ($id == $quantity) {
               return $total['Quantity'];
            }
      }
  }

    //Getting total price and putting it in a session for checkout.
    public function calculateTotalPrice() {
        $data = [
            'title' => 'Shopping Cart',
            'items' => $this->addToCart()
        ];

        $price = 0;

        foreach ($data['items'] as $item) {
             $price = $price + $this->calculateTotalPricePerProd($item['ticketId']);
        }
        //Session for total price
        $_SESSION['totalPrice'] = $price;
        return $price;
    }

    //Calculating the total price and returning so we can reuse this function.
    public function calculateTotalPricePerProd($id) {
        $data = [
            'title' => 'Shopping Cart',
            'items' => $this->addToCart()
        ];

        foreach ($data['items'] as $item) {
              if ($id == $item['ticketId']) {
                  $pricePerProd = $item['price'] * $this->getQuantity($id);
                  return $pricePerProd;
               }
        }
    }

    //Blocks access if shopping cart is empty and removes the button.
    public function buttonShoppingCart() {
        if (!empty($_SESSION['shoppingCart'])) {
          echo
            '<button type="submit" name="submit">
                Order
            </button>';
        } else {
          echo '<h4>Please add items to proceed.</h4>';
    }
  }
}

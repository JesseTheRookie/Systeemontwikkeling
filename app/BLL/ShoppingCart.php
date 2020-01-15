<?php
  class ShoppingCart extends Controller {

    public function __construct(){
        $this->shoppingCartDal = $this->dal('ShoppingCartDAO');
        $this->shoppingCartModel = $this->model('ShoppingCartModel');
    }

    public function index(){

      $data = [
          'title' => 'Shopping Cart',
          'items' => $this->addToCart()
      ];

      $this->ui('shoppingcart/shopping-cart', $data);
    }

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
      $this->ui('shoppingcart/shopping-cart', $data);
    }


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
                if (!empty($_SESSION['shoppingCart'][$id])) {
                    $cartItem = $this->shoppingCartDal->findDanceTicket($id);
                    $cartItems[] = $cartItem;
                }
            }
        }
        return $cartItems;
    }
}


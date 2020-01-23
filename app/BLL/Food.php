<?php
class Food Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->foodDal = $this->dal('FoodTicketDAO');
        $this->foodTicketModel = $this->model('FoodTicketModel');
        $this->contentTicketModel = $this->model('ContentModel');
    }

    public function index(){
        $restaurantType = '';
        $restaurants = $this->foodDal->getRestaurants($restaurantType);
        $content = $this->foodDal->getFoodContent();

        $data = [
            'title' => 'Food Page',
            'restaurants' => $restaurants,
            'content' => $content,
            'restaurantsError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $restaurantType = trim($_POST['restaurantType']);
            $restaurants = $this->foodDal->getRestaurants($restaurantType);

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Food Page',
                'content' => $content,
                'restaurants' => $restaurants,
                'restaurantType' => $restaurantType,
                'restaurantsError' => ''
            ];

            // Check to see if user only enters letters and whitespace
            $nameValidation = "/^[a-zA-Z ]*$/";

            // Validate name on only letters and whitespace
            if(empty($data['restaurantType'])){
                $data['restaurantsError'] = 'Our apology, we have not found any cuisine that you are searching for. Please search for a different type of cuisine or take a look below for our options. ';
            }
            // Check on user input
            elseif (!preg_match($nameValidation, $data['restaurantType'])) {
              $data['restaurantsError'] = 'The cuisine can only contain letters and whitespace, please try again.';
            }
            else {
                // If search result is equal to 0, no match found.
                if (count($data['restaurants']) === 0) {
                    $data['restaurantsError'] = 'Sorry, we have not found any restaurants with ' . $data['restaurantType'] . ' cuisine. Please try a different cuisine!';
                }
            }
        }
      $this->ui('events/food', $data);
    }

    //'ADD' button will execute this
    public function orderFoodTicket() {
        $restaurantType = '';
        $restaurants = $this->foodDal->getRestaurants($restaurantType);
        $content = $this->foodDal->getFoodContent();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $restaurants = $this->foodDal->getRestaurants($restaurantType);

            // Sanitize GET data
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Restaurant Page',
                'content' => $content,
                'restaurants' => $restaurants,
                'restaurantType' => $restaurantType,
                'restaurantsError' => ''
                ];


            //Quantity select has three values; bought tickets, ticketId and event type
            //Exploding it because we need them seperate.
            $info = explode("|", $_GET['time']);
            $eventType = $info[0];
            $time = $info[1];
            $ticketId = $info[2];
            $guests =  trim($_GET['guests']);

            $oldGuests = 0;

            //Creating an array and passing the quantity
            $items = array(
                'time' => $time,
                'Event' => $eventType,
                'ticketId' => $ticketId,
                'Quantity' => $guests,
                'comments' => trim($_GET['comment'])
            );

            //If shoppingcart is not created (so empty), create one.
            if (!isset($_SESSION['shoppingCart'])) {
                $_SESSION['shoppingCart'] = array();
            }

            //If ticketId already exists in shopping cart, add it and do not create a new one
            if (!array_key_exists($ticketId, $_SESSION['shoppingCart'])) {
                $_SESSION['shoppingCart'][$ticketId] = $items;
                $_SESSION['oldQuantity'] = $guests;
            } else {
                $oldQuantity = $guests + $oldGuests;
                $_SESSION['shoppingCart'][$ticketId] = $items;
            }

        //Load View
        $this->ui('events/food', $data);
        }
    }
}



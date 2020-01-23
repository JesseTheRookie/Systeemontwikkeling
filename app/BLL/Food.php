<?php
class Food Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->foodDal = $this->dal('FoodTicketDAO');
        $this->foodTicketModel = $this->model('FoodTicketModel');
        $this->contentTicketModel = $this->model('ContentModel');
    }

    public function getRestaurantNameByTicketId($ticketId){
        return $this->foodDal->getRestaurantNameByTicketId($ticketId);
    }

    public function getFoodTicketFromTicket($ticketId, $reserved, $start, $end){
        $restaurantName = $this->getRestaurantNameByTicketId($ticketId);
        if(!empty($restaurantName)){
            $foodTicket = new FoodTicketModel();

            $foodTicket->setTicketId($ticketId);
            $foodTicket->setReserved($reserved);
            $foodTicket->setStartDateTime($start);
            $foodTicket->setEndDateTime($end);
            $foodTicket->setRestaurantName($restaurantName);

            return $foodTicket;
        }
        else{
            return null;
        }
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
}


<?php
class Food Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->foodDal = $this->dal('FoodTicketDAO');
        $this->foodTicketModel = $this->model('FoodTicketModel');
        $this->contentTicketModel = $this->model('ContentModel');
    }

    public function index(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

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

            $data = [
                'title' => 'Food Page',
                'restaurants' => $restaurants,
                'restaurantType' => $restaurantType,
                'restaurantsError' => ''
            ];

            //Error check to see if restaurants are found or not.
            if (!empty($restaurants)) {
                //Restaurants found
            } else {
                $data['restaurantsError'] = 'Our apology, we have not found any cuisine that you are searching for. Please search for a different type of cuisine. ';
            }
        }
      $this->ui('events/food', $data);
    }
}
?>

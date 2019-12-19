<?php
class Food Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->foodDal = $this->dal('FoodTicketDAO');
        $this->foodTicketModel = $this->model('FoodTicketModel');
    }

    public function index(){
        $restaurants = $this->foodDal->getRestaurants();

        $data = [
            'title' => 'Food Page',
            'restaurants' => $restaurants
        ];

      $this->ui('events/food', $data);
    }
}
?>

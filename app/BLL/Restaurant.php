<?php
class Restaurant Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->foodDal = $this->dal('FoodTicketDAO');
        $this->foodTicketModel = $this->model('FoodTicketModel');
    }

    public function index($id) {
        $restaurant = $this->foodDal->getRestaurantById($id);
        $information = $this->foodDal->getRestaurantTicketsById($id);

        $data = [
            'title' => 'Food Page',
            'restaurant' => $restaurant,
            'information' => $information,
            'guests' => '',
            'comments' => '',
            'guestError' => '',
            'commentError' => ''
            ];

        $this->ui('events/restaurant', $data);
    }

}

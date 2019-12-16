<?php
class Food Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {
        $this->foodDal = $this->dal('FoodTicketDAO');
        $this->foodTicketModel = $this->model('FoodTicketModel');
    }

    public function index(){

        $data = [
        'title' => 'Food Page',
        'tickets' => ''
      ];

      $this->ui('events/food', $data);
    }
}
?>

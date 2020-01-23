<?php
require_once('TicketModel.php');

//Extending tickets but there are 6 extra columns needed.
class FoodTicketModel extends TicketModel {
    private $restaurantId;
    private $restaurantName;
    private $restaurantStars;
    private $restaurantDescription;
    private $restaurantContent;
    private $restaurantType;

    //Objects for Restaurant id (because id needs to be passed for detailed page)
    public function setRestaurantId($id){
        $this->restaurantId = $id;
    }

    public function getRestaurantId(){
        return $this->restaurantId;
    }

    //Objects for Restaurant name
    public function setRestaurantName($name){
        $this->restaurantName = $name;
    }

    public function getRestaurantName(){
        return $this->restaurantName;
    }

    //Objects for Restaurant stars
    public function setRestaurantStars($stars){
        $this->restaurantStars = $stars;
    }

    public function getRestaurantStars(){
        return $this->restaurantStars;
    }

    //Objects for Restaurant description
    public function setRestaurantDescription($description){
        $this->restaurantDescription = $description;
    }

    public function getRestaurantDescription(){
        return $this->restaurantDescription;
    }

    //Objects for Restaurant content
    public function setRestaurantContent($content){
        $this->restaurantContent = $content;
    }

    public function getRestaurantContent(){
        return $this->restaurantContent;
    }

    //Objects for Restaurant type
    public function setRestaurantType($type){
        $this->restaurantType = $type;
    }

    public function getRestaurantType(){
        return $this->restaurantType;
    }
}


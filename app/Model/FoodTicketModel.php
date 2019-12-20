<?php
require('TicketModel.php');
class FoodTicketModel extends TicketModel {
    protected $restaurantId;
    protected $restaurantName;
    protected $restaurantStars;
    protected $restaurantDescription;
    protected $restaurantContent;

    //Objects for Restaurant name (because id needs to be passed for detailed page)
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

}
?>

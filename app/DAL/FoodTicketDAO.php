<?php
class FoodTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    //Get the image, event name and buttons of top section Dance Page.
    public function getFoodContent() {
      $foodContentArray = array();

      $this->db->query("SELECT elementName, description, content
                        FROM Content as c
                        WHERE contentType = 3
                      ");

      $foodContent = $this->db->resultSet();

      foreach ($foodContent as $content) {
            $foodContentModel = new HomeModel();

            $foodContentModel->setElementName($content->elementName);
            $foodContentModel->setDescription($content->description);
            $foodContentModel->setContent($content->content);

            array_push($foodContentArray, $foodContentModel);
        }
        return $foodContentArray;
    }

    //Selecting all restaurants based on user input
    public function getRestaurants($restaurantType) {
        $restaurantArray = array();

        $query = $this->db->query("SELECT r.restaurantId, r.restaurantName, c.description, c.content, f.foodType
                                   FROM restaurant as r
                                   INNER JOIN content as c
                                   ON r.restaurantName = c.name
                                   INNER JOIN RestaurantFoodType as rf
                                   ON r.restaurantId = rf.restaurantId
                                   INNER JOIN FoodType as f
                                   ON rf.foodtypeId = f.foodTypeId
                                   WHERE f.foodType LIKE '%' :restaurantType '%'
                                  ");

        $this->db->bind(':restaurantType', $restaurantType);

        $restaurants = $this->db->resultSet();

        foreach ($restaurants as $restaurant) {
            $restaurantModel = new FoodTicketModel();

            $restaurantModel->setRestaurantId($restaurant->restaurantId);
            $restaurantModel->setRestaurantName($restaurant->restaurantName);
            $restaurantModel->setRestaurantDescription($restaurant->description);
            $restaurantModel->setRestaurantContent($restaurant->content);
            $restaurantModel->setRestaurantType($restaurant->foodType);

            array_push($restaurantArray, $restaurantModel);
        }
        return $restaurantArray;
    }

    public function getRestaurantNameByTicketId($ticketId){
        $this->db->query("SELECT r.restaurantName
                                FROM FoodTicket as f
                                JOIN Restaurant as r 
                                ON f.restaurantId = r.restaurantId
                                WHERE f.ticketId = :id");

        $this->db->bind(':id', $ticketId);

        $restaurant = $this->db->resultSet();

        return $restaurant;
    }

    //Need to pass in ID in URL when clicking on a restaurant
    public function getRestaurantById($id) {
        $restaurantArray = array();

        $this->db->query("SELECT r.restaurantId, r.restaurantName, r.restaurantStars, c.description, c.content             , f.foodType
                          FROM Restaurant as r
                          INNER JOIN Content as c
                          ON r.restaurantName = c.name
                          INNER JOIN RestaurantFoodType as rf
                          ON r.restaurantId = rf.restaurantId
                          INNER JOIN FoodType as f
                          ON rf.foodtypeId = f.foodTypeId
                          WHERE r.restaurantId = :id
                        ");

        $this->db->bind(':id', $id);

        $restaurants = $this->db->resultSet();

        foreach ($restaurants as $restaurant) {
            $restaurantModel = new FoodTicketModel();

            $restaurantModel->setRestaurantId($restaurant->restaurantId);
            $restaurantModel->setRestaurantName($restaurant->restaurantName);
            $restaurantModel->setRestaurantStars($restaurant->restaurantStars);
            $restaurantModel->setRestaurantDescription($restaurant->description);
            $restaurantModel->setRestaurantContent($restaurant->content);
            $restaurantModel->setRestaurantType($restaurant->foodType);

            array_push($restaurantArray, $restaurantModel);
        }
        return $restaurantArray;
    }

    //When clicked on a restaurant, need to output booking information
    public function getRestaurantTicketsById($id) {
        $restaurantArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.price, f.restaurantId
                          FROM tickets as t
                          INNER JOIN foodticket as f
                          ON t.ticketId = f.ticketId
                          WHERE f.restaurantId = :id AND t.startDateTime >= CURDATE()
                         ");

        $this->db->bind(':id', $id);

        $restaurants = $this->db->resultSet();

        foreach ($restaurants as $restaurant) {
            $restaurantModel = new FoodTicketModel();

            $restaurantModel->setTicketId($restaurant->ticketId);
            $restaurantModel->setStartDateTime($restaurant->startDateTime);
            $restaurantModel->getEndDateTime($restaurant->endDateTime);
            $restaurantModel->setPrice($restaurant->price);

            array_push($restaurantArray, $restaurantModel);
        }
        return $restaurantArray;
    }
}
?>

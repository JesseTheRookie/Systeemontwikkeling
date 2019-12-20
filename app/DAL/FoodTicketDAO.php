<?php
class FoodTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getRestaurants() {
        $restaurantArray = array();

        $query = $this->db->query("SELECT r.restaurantId, r.restaurantName, r.restaurantStars, c.description, c.content
                        FROM restaurant as r
                        INNER JOIN content as c
                        ON r.restaurantName = c.elementName
                        ");

        $restaurants = $this->db->resultSet();

        foreach ($restaurants as $restaurant) {
                $restaurantModel = new FoodTicketModel();

                $restaurantModel->setRestaurantId($restaurant->restaurantId);
                $restaurantModel->setRestaurantName($restaurant->restaurantName);
                $restaurantModel->setRestaurantStars($restaurant->restaurantStars);
                $restaurantModel->setRestaurantDescription($restaurant->description);
                $restaurantModel->setRestaurantContent($restaurant->content);

            array_push($restaurantArray, $restaurantModel);
        }
        return $restaurantArray;
    }

    public function getRestaurantById($id) {
                $restaurantArray = array();
        $this->db->query("SELECT r.restaurantId, r.restaurantName, r.restaurantStars, c.description, c.content
                        FROM restaurant as r
                        INNER JOIN content as c
                        ON r.restaurantName = c.elementName
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

            array_push($restaurantArray, $restaurantModel);
        }
        return $restaurantArray;
    }


    public function getRestaurantTicketsById($id) {
        $restaurantArray = array();

        $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.price
                        FROM tickets as t
                        INNER JOIN foodticket as f
                        WHERE t.ticketId = f.ticketId
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

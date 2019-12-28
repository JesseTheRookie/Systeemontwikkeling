<?php
require('User.php');
//Extending user to get user information
class PdfModel extends User{
    private $userId;
    private $ticketId;
    private $date;
    private $quantity;
    private $reserved;
    private $price;

    //Objects for user id
    public function setUserId($uId){
        $this->userId = $uId;
    }

    public function getUserId(){
        return $this->userId;
    }

    //Objects for Ticket id
    public function setTicketId($tId){
        $this->ticketId = $tId;
    }

    public function getTicketId(){
        return $this->ticketId;
    }

    //Objects for Date
    public function setDate($date){
        $this->date = $date;
    }

    public function getDate(){
        return $this->date;
    }

    //Objects for Quantity
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    //Objects for Reserver
    public function setReserved($reserved){
        $this->reserved = $reserved;
    }

    public function getReserved(){
        return $this->reserved;
    }

    //Objects for price
    public function setPrice($price){
        $this->price = $price;
    }

    public function getPrice(){
        return $this->price;
    }
}

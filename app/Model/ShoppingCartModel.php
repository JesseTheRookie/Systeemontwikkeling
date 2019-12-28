<?php

class ShoppingCartModel {
    private $userId;
    private $ticketId;
    private $date;
    private $quantity;
    private $reserved;
    protected $tickets = array();

    //Objects for user id
    public function setUserId($userId){
        $this->userId = $userId;
    }
    public function getUserId(){
        return $this->userId;
    }

    //Objects for user id
    public function setTicketId($ticketId){
        $this->ticketId = $ticketId;
    }
    public function getTicketId(){
        return $this->ticketId;
    }

    //Objects for user id
    public function setDate($date){
        $this->date = $date;
    }
    public function getDate(){
        return $this->date;
    }

    //Objects for user id
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    public function getQuantity(){
        return $this->quantity;
    }

    //Objects for user id
    public function setReserved($reserved){
        $this->reserved = $reserved;
    }
    public function getReserved(){
        return $this->reserved;
    }

}

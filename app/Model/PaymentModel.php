<?php

class PaymentModel  {
    private $userId;
    protected $tickets = array();

    public function setUserId($userId){
        $this->userId = $userId;
    }
    public function getUserId(){
        return $this->userId;
    }

    public function setDate($date){
        $this->date = $date;
    }
    public function getDate(){
        return $this->date;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    public function getQuantity(){
        return $this->quantity;
    }

    public function setReserved($reserved){
        $this->reserved = $reserved;
    }
    public function getReserved(){
        return $this->reserved;
    }

    public function setTickets($tickets){
        $this->tickets = $tickets;
    }
    public function getTickets(){
        return $this->tickets;
    }

}

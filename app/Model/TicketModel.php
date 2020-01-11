<?php
abstract class TicketModel{
    private $ticketId;
    private $startDateTime;
    private $endDateTime;
    private $ticketQuantity;
    private $price;

    public function setTicketId($id){
        $this->ticketId = $id;
    }
    public function getTicketId(){
        return $this->ticketId;
    }
    public function setStartDateTime($dateTime){
        $this->startDateTime = $dateTime;
    }
    public function getStartDateTime(){
        return $this->startDateTime;
    }
    public function setEndDateTime($datetime){
        $this->endDateTime = $datetime;
    }
    public function getEndDateTime(){
        return $this->endDateTime;
    }
    public function setTicketQuantity($quantity){
        $this->ticketQuantity = $quantity;
    }
    public function getTicketQuantity(){
        return $this->ticketQuantity;
    }
    public function setPrice($price){
        $this->price = $price;
    }
    public function getPrice(){
        return $this->price;
    }
}

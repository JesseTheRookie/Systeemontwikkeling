<?php
class PersonalTimeTableModel {
    private $userId;
    private $ticketId;
    private $date;
    private $quantity;
    private $gereserveerd;

    //Objects for user id
    public function setUserId($id){
        $this->userId = $id;
    }

    public function getUserId(){
        return $this->userId;
    }

    //Objects for ticket id
    public function setTicketId($ticketId){
        $this->ticketId = $ticketId;
    }

    public function getTicketId(){
        return $this->ticketId;
    }

    //Objects for ticket date
    public function setDate($date){
        $this->date = $date;
    }

    public function getDate(){
        return $this->date;
    }

    //Objects for ticket quantity
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    //Objects for reserverd or not
    public function setGereserveerd($gereserveerd){
        $this->gereserveerd = $gereserveerd;
    }

    public function getGereserveerd(){
        return $this->gereserveerd;
    }
}
?>

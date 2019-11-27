<?php
class JazzTicket extends TicketModel{
    protected $jazzTicketId;
    protected $jazzTicketLocation;
    protected $jazzTicketHall;

    public function setJazzTicketId($id){
        $this->jazzTicketId = $id;
    }
}
<?php
abstract class DanceTicket extends TicketModel{
    //TicketId - startDateTime - endDateTime - ticketQuantity - price <- in Ticketmodel
    protected  $danceTicketLocation;
    protected  $danceTicketArtist;
    protected  $danceTicketSession;

    //GET AND SET FOR Dance ticket location
    public function setDanceTicketLocation($danceTicketLocation){
        $this->danceTicketLocation = $danceTicketLocation;
    }
    public function getDanceTicketLocation(){
        return $this->danceTicketLocation;
    }

    //GET AND SET FOR Dance ticket artist
    public function setDanceTicketArtist($danceTicketArtist){
        $this->danceTicketArtist = $danceTicketArtist;
    }
    public function getDanceTicketArtist(){
        return $this->danceTicketArtist;
    }

    //GET AND SET FOR Dance ticket artist
    public function setDanceTicketSession($danceTicketSession){
        $this->danceTicketSession = $danceTicketSession;
    }
    public function getDanceTicketSession(){
        return $this->danceTicketSession;
    }
}


?>

<?php

require('TicketModel.php');
require('ArtistModel.php');

abstract class KidsTicket extends TicketModel{
    //TicketId - startDateTime - endDateTime - ticketQuantity - price <- in Ticketmodel
    protected  $kidsTicketLocation;
    protected  $kidsTicketArtist;
    protected  $kidsTicketSession;

    //GET AND SET FOR Dance ticket location
    public function setKidsTicketLocation($kidsTicketLocation){
        $this->kidsTicketLocation = $kidsTicketLocation;
    }
    public function getKidsTicketLocation(){
        return $this->kidsTicketLocation;
    }

    //GET AND SET FOR Dance ticket artist
    public function setKidsTicketArtist($kidsTicketArtist){
        $this->kidsTicketArtist = $kidsTicketArtist;
    }
    public function getKidsTicketArtist(){
        return $this->kidsTicketArtist;
    }

    //GET AND SET FOR Dance ticket artist
    public function setKidsTicketSession($kidsTicketSession){
        $this->kidsTicketSession = $kidsTicketSession;
    }
    public function getKidsTicketSession(){
        return $this->kidsTicketSession;
    }

        //GET and SET if you want to add artists
    public function addArtist($artist) {
        array_push($this->artists, $artist);
    }

    public function getArtists() {
        return $this->artists;
    }
}


?>

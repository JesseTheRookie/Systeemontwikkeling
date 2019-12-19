<?php
require('TicketModel.php');
require('ArtistModel.php');
class DanceTicketModel extends TicketModel {
    //TicketId - startDateTime - endDateTime - ticketQuantity - price <- in Ticketmodel
    protected  $danceTicketLocation;
    protected  $danceTicketSession;
    protected $artists = array();

    //Objects for dance ticket location
    public function setDanceTicketLocation($location){
        $this->danceTicketLocation = $location;
    }
    public function getDanceTicketLocation(){
        return $this->danceTicketLocation;
    }

    //GET AND SET FOR Dance ticket session
    public function setDanceTicketSession($danceTicketSession){
        $this->danceTicketSession = $danceTicketSession;
    }

    public function getDanceTicketSession(){
        return $this->danceTicketSession;
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

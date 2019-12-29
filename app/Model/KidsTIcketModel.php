<?php
require('TicketModel.php');
require('ArtistModel.php');
class KidsTicketModel extends TicketModel {
    private $kidsTicketLocation;
    private $kidsTicketSession;
    private $artists = array();

    //Objects for kids ticket location
    public function setKidsTicketLocation($location){
        $this->kidsTicketLocation = $location;
    }

    public function getKidsTicketLocation(){
        return $this->kidsTicketLocation;
    }

    //Object for ticket session
    public function setKidsTicketSession($kidsTicketSession){
        $this->kidsTicketSession = $kidseTicketSession;
    }

    public function getKidsTicketSession(){
        return $this->kidsTicketSession;
    }

    //Objects from artists
    public function addArtist($artist) {
        array_push($this->artists, $artist);
    }

    public function getArtists() {
        return $this->artists;
    }
}
?>

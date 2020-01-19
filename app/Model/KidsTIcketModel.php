<?php
require_once('TicketModel.php');
require_once('ArtistModel.php');

//Extending Tickets and Artists but kids has 2 different columns (Location and Session)
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
        $this->kidsTicketSession = $kidsTicketSession;
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

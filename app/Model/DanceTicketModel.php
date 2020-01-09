<?php
require('TicketModel.php');
require('ArtistModel.php');
class DanceTicketModel extends TicketModel {
    private $danceTicketLocation;
    private $danceTicketSession;
    private $artistName;
    private $artists = array();

    //Objects for dance ticket location
    public function setDanceTicketLocation($location){
        $this->danceTicketLocation = $location;
    }

    public function getDanceTicketLocation(){
        return $this->danceTicketLocation;
    }

    //Object for ticket session
    public function setDanceTicketSession($danceTicketSession){
        $this->danceTicketSession = $danceTicketSession;
    }

    public function getDanceTicketSession(){
        return $this->danceTicketSession;
    }


    // ARTISTS (EXTRA)
    public function setArtistName($artist){
        $this->artistName = $artist;
    }

    public function getArtistName(){
        return $this->artistName;
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

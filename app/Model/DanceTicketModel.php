<?php
require_once('TicketModel.php');
require_once('ArtistModel.php');

//Extending Tickets and Artists but dance has 2 different columns (Location and Session)
class DanceTicketModel extends TicketModel {
    private $danceTicketLocation;
    private $danceTicketSession;
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

    //Objects from artists
    public function addArtist($artist) {
        array_push($this->artists, $artist);
    }
    public function setArtists($artists){
        $this->artists = $artists;
    }
    public function getArtists() {
        return $this->artists;
    }
}


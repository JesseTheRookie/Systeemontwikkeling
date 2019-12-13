<?php
require('TicketModel.php');
require('ArtistModel.php');
class JazzTicketModel extends TicketModel {
    private $jazzTicketLocation;
    private $jazzTicketHall;
    private $artists = array();

    public function setJazzTicketLocation($location){
        $this->jazzTicketLocation = $location;
    }
    public function getJazzTicketLocation(){
        return $this->jazzTicketLocation;
    }
    public function setJazzTicketHall($hall){
        $this->jazzTicketHall = $hall;
    }
    public function getJazzTicketHall(){
        return $this->jazzTicketHall;
    }
    public function addArtist($artist){
        array_push($this->artists, $artist);
    }
    public function getArtists(){
        return $this->artists;
    }
}

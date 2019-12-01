<?php
require('TicketModel.php');
require('ArtistModel.php');
class JazzTicketModel extends TicketModel {
    protected $jazzTicketId;
    protected $jazzTicketLocation;
    protected $jazzTicketHall;
    protected $artists = array();

    public function setJazzTicketId($id){
        $this->jazzTicketId = $id;
    }
    public function getJazzTicketId(){
        return $this->jazzTicketId;
    }
    public function setJazzTicketLocation($location){
        $this->jazzTicketLocation = $location;
    }
    public function getJazzTicketLocation(){
        return $this->jazzTicketLocation;
    }
    public function setJazzTicketHall($hall){
        $this->jazzTicketHall = $hall;
    }
    public function addArtist($artist){
        array_push($this->artists, $artist);
    }
    public function getArtists(){
        return $this->artists;
    }
}
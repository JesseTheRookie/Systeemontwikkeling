<?php
class ArtistModel
{
    protected $artistId;
    protected $artistName;
    protected $artistBio;
    protected $eventType;

    public function setArtistId($id){
        $this->artistId = $id;
    }
    public function getArtistId(){
        return $this->artistId;
    }
    public function setArtistName($name){
        $this->artistName = $name;
    }
    public function getArtistName(){
        return $this->artistName;
    }
    public function setArtistBio($bio){
        $this->artistBio = $bio;
    }
    public function getArtistBio(){
        return $this->artistBio;
    }
    public function setEventType($type){
        $this->eventType = $type;
    }
    public function getEventType()
    {
        return $this->eventType;
    }
}
<?php
class ArtistModel
{
    private $artistId;
    private $artistName;
    private $artistBio;
    private $ticketId;

    public function setTicketId($id){
        $this->ticketId = $id;
    }
    public function getTicketId(){
        return $this->ticketId;
    }
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
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;
    }
    public function getImgUrl(){
        return $this->imgUrl;
    }

}

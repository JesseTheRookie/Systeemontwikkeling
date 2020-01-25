<?php
require ('HomeModel.php');

class ContentModel extends HomeModel {
    private $totalArtists;
    private $totalLocations;
    private $totalTickets;
    private $totalEvents;
    private $eventStartDate;
    private $eventEndDate;
    private $name;
    private $description;
    private $content;

    //Object for total artists
    public function setTotalArtists($artists){
        $this->totalArtists = $artists;
    }
    public function getTotalArtists(){
        return $this->totalArtists;
    }

    //Object for total locations
    public function setTotalLocations($locations){
        $this->totalLocations = $locations;
    }

    public function getTotalLocations(){
        return $this->totalLocations;
    }

    //Object for total tickets
    public function setTotalTickets($tickets){
        $this->totalTickets = $tickets;
    }

    public function getTotalTickets(){
        return $this->totalTickets;
    }

    //Object for total locations
    public function setTotalEvents($events){
        $this->totalEvents = $events;
    }

    public function getTotalEvents(){
        return $this->totalEvents;
    }

    //Object for start date
    public function setEventStartDate($dateTime){
        $this->eventStartDate = $dateTime;
    }

    public function getEventStartDate(){
        return $this->eventStartDate;
    }

    //Object for event end date
    public function setEventEndDate($dateTime){
        $this->eventEndDate = $dateTime;
    }

    public function getEventEndDate(){
        return $this->eventEndDate;
    }

    //Object for element content homepage
    public function setName($names){
        $this->name = $names;
    }

    public function getName(){
        return $this->name;
    }

    //Object for description content homepage
    public function setDescription($descriptions){
        $this->description = $descriptions;
    }

    public function getDescription(){
        return $this->description;
    }

    //Object for Events content homepage
    public function setContent($contents){
        $this->content = $contents;
    }

    public function getContent(){
        return $this->content;
    }
}

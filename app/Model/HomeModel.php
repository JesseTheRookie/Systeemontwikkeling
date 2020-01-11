<?php

//Event objects to output on the frontpage of the website
class HomeModel {
    private $totalArtists;
    private $totalLocations;
    private $totalTickets;
    private $totalEvents;
    private $eventStartDate;
    private $eventEndDate;
    private $elementName;
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
    public function setElementName($names){
        $this->elementName = $names;
    }

    public function getElementName(){
        return $this->elementName;
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
?>

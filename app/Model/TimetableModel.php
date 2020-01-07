<?php
class TimetableModel {
    private $eventTypeId;
    private $eventType;

    //Object for total artists
    public function setEventTypeId($id){
        $this->eventTypeId = $id;
    }
    public function getEventTypeId(){
        return $this->totalArtists;
    }

    //Object for total artists
    public function setEventType($type){
        $this->eventType = $type;
    }
    public function getEventType(){
        return $this->eventType;
    }
}

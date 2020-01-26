<?php
require_once('TicketModel.php');
require_once('ArtistModel.php');

class HistoricTicketModel extends TicketModel
{
    private $historicTicketLocation;

    public function setHistoricTicketLocation($location){
        $this->historicTicketLocation = $location;
    }
    public function getHistoricTicketLocation(){
        return $this->historicTicketLocation;
    }
}
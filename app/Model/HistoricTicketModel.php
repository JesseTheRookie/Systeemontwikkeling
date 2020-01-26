<?php
require_once('TicketModel.php');

class HistoricTicketModel extends TicketModel
{
    private $historicTicketLanguage;

    public function setHistoricTicketLanguage($language){
        $this->historicTicketLanguage = $language;
    }
    public function getHistoricTicketLanguage(){
        return $this->historicTicketLanguage;
    }
}
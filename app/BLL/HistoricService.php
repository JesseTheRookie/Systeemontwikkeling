<?php 
    class HistoricService EXTENDS Controller{
        public function __construct() {
            $this->HistoricDAO = $this->dal('HistoricDAO');
            $this->VenueModel = $this->model('VenueModel');
        }
  
        public function historic(){
            $data = [
                'title' => 'Historic Page',
            ];

            $this->ui('events/historic', $data);
        }

        public function historicVenues(){
            $data = [
                'title' => 'Historic Venues'
            ];

            $this->ui('events/historicVenues', $data);
        }
    }
    
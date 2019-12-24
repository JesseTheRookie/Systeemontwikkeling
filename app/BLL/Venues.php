<?php 
    class Venues EXTENDS Controller{
        public function __construct() {
            $this->HistoricDAO = $this->dal('HistoricDAO');
            $this->VenueModel = $this->model('VenueModel');
        }

        public function index(){
            $data = [
                'title' => 'Historic Venues'
            ];

            $this->ui('events/historicVenues', $data);
        }
    }
    
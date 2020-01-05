<?php 
    class Historic EXTENDS Controller{
        public function __construct() {
            $this->HistoricDAO = $this->dal('HistoricDAO');
            $this->VenueModel = $this->model('VenueModel');
        }
  
        public function index(){
            $data = [
                'title' => 'Historic Page',
            ];

            $this->ui('events/historic', $data);
        }
    }
    
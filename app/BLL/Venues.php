<?php 
    class Venues EXTENDS Controller{

        // Create object for DAO and Model layer
        public function __construct() {
            $this->historicDAO = $this->dal('HistoricDAO');
            $this->VenueModel = $this->model('VenueModel');
        }

        public function index(){

            $venues = $this->getVenues();

            $data = [
                'title' => 'Historic Venues',
                'venues' => $venues
            ];

            $this->ui('events/historicVenues', $data);
        }

        public function getVenues(){
            $venues = $this->historicDAO->getVenuesContent();
            return $venues;
        }

        public function timelineSideSetter($side){
            switch ($side) {
                case "left":
                    return "right";
                case "right":
                    return "left";
                default:
                    return "left";
            }
        }
    }
    
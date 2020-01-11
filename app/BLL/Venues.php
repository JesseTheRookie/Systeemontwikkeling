<?php 
    class Venues EXTENDS Controller{

        // Create object for DAO and Model layer
        public function __construct() {
            $this->venueDAO = $this->dal('VenueDAO');
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
            $venues = $this->venueDAO->getVenuesContent();
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
    
<?php 
    class Venues EXTENDS Controller{

        // Create object for DAO and Model layer
        public function __construct() {
            $this->venueDAO = $this->dal('VenueDAO');
            $this->VenueModel = $this->model('VenueModel');
        }

        public function index(){
            // Acquire the venues
            $venues = $this->getVenues();

            // Init data
            $data = [
                'title' => 'Historic Venues',
                'venues' => $venues
            ];

            $this->ui('events/historicVenues', $data);
        }

        // Get the venues from the DAL
        public function getVenues(){
            $venues = $this->venueDAO->getVenuesContent();
            return $venues;
        }

        // Create the timeline on the venues page
        public function venueTimeline($data){
            $side = "";
            foreach($data['venues'] as $venue) {
                $side = $this->timelineSideSetter($side);
                echo '
                    <div class="container '.$side.'">
                        <div class="content">
                            <img class="timelineImg" src="'.URLROOT.'/'.$venue->getVenueImg().'"></img>
                            <h2 class="contentHeader">'.$venue->getVenueName().'</h2>
                            <p class="contentText">'.$venue->getVenueDesc().'</p>
                        </div>
                    </div>    
                ';
            }
        }

        // Determine on which side of the timeline the venue should be
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
    
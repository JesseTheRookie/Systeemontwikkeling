<?php
    class VenueModel {
        private $venueName;
        private $venueDesc;
        private $venueImg;

        // Get & set for venueName
        public function setVenueName($venueName){
            $this->venueName = $venueName;
        }
        public function getVenueName(){
            return $this->venueName;
        }

        // Get & set for venueDesc
        public function setVenueDesc($venueDesc){
            $this->venueDesc = $venueDesc;
        }
        public function getVenueDesc(){
            return $this->venueDesc;
        }

        // Get & set for venueImg
        public function setVenueImg($venueImg){
            $this->venueImg = $venueImg;
        }
        public function getVenueImg(){
            return $this->venueImg;
        }
    }

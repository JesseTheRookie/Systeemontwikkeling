<?php
    class VenuesService extends Controller {
        public function __construct(){

        }
    }

    public function historicVenues(){
        $data = [
            'title' => 'Historic Venues'
        ];

        

        $this->ui('events/historicVenues', $data);
    }
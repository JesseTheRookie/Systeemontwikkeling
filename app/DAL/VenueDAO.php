<?php
    class VenueDAO {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }        
        
        // Get all the venues stuff from the database
        public function getVenuesContent() {
            $venuesContentArray = array();

            $this->db->query("SELECT elementName, description, content
                              FROM Content as c
                              WHERE contentType = 1 AND eventType = 6
                            ");
            
            $venuesContent = $this->db->resultSet();

            foreach ($venuesContent as $content) {
                $venue = new VenueModel();

                $venue->setVenueName($content->elementName);
                $venue->setVenueDesc($content->description);
                $venue->setVenueImg($content->content);

                array_push($venuesContentArray, $venue);
            }
            return $venuesContentArray;
        }
    }

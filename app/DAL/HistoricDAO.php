<?php
    class HistoricDAO {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        // Get all the historic stuff from the database
        public function getHistoricContent() {
            $historicContentArray = array();

            $this->db->query("SELECT elementName, description, content
                              FROM Content as c
                              WHERE AND eventType = 5
                            ");
            
            $historicContent = $this->db->resultSet();

            foreach ($historicContent as $content) {
                $historicContentModel = new HomeModel();

                $historicContentModel->setElementName($content->elementName);
                $historicContentModel->setDescription($content->description);
                $historicContentModel->setContent($content->content);

                array_push($historicContentArray, $historicContentModel);
            }
            return $historicContentArray;
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
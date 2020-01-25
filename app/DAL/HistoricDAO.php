<?php
    class HistoricDAO {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        // Get all the historic stuff from the database
        public function getHistoricContent() {
            $historicContentArray = array();

            $this->db->query("SELECT name, description, content
                              FROM Content as c
                              WHERE eventType = 5 AND contentType = 4
                            ");
            
            $historicContent = $this->db->resultSet();

            foreach ($historicContent as $content) {
                $historicContentModel = new HistoricModel();

                $historicContentModel->setHeader($content->name);
                $historicContentModel->setDescription($content->description);
                $historicContentModel->setButton($content->content);

                array_push($historicContentArray, $historicContentModel);
            }
            return $historicContentArray;
        }        

        // Get all the historic images from the database
        public function getHistoricImages() {
            $historicImageArray = array();

            $this->db->query("SELECT content
                              FROM Content as c
                              WHERE eventType = 5 AND contentType = 1
                            ");
            
            $historicImages = $this->db->resultSet();

            foreach ($historicImages as $image) {
                $historicImageModel = new HistoricImageModel();

                $historicImageModel->setImageUrl($image->content);

                array_push($historicImageArray, $historicImageModel);
            }
            return $historicImageArray;
        }
    }
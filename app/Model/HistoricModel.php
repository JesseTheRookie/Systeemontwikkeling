<?php   
    class HistoricModel{
        private $header;
        private $description;
        private $button;      

        // Get & Set for header
        public function setHeader($header){
            $this->header = $header;
        }
        public function getHeader(){
            return $this->header;
        }

        // Get & Set for description
        public function setDescription($description){
            $this->description = $description;
        }
        public function getDescription(){
            return $this->description;
        }

        // Get & Set for button
        public function setButton($button){
            $this->button = $button;
        }
        public function getButton(){
            return $this->button;
        }
    }
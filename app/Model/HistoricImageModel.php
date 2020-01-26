<?php   
    class HistoricImageModel{
        private $imageUrl;   

        // Get & Set for imageUrl
        public function setImageUrl($imageUrl){
            $this->imageUrl = $imageUrl;
        }
        public function getImageUrl(){
            return $this->imageUrl;
        }
    }
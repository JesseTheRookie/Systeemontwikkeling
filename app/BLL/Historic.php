<?php 
    class Historic EXTENDS Controller{

        // Create object for DAO and Model layer
        public function __construct() {
            $this->historicModel = $this->model('HistoricModel');
            $this->historicImageModel = $this->model('HistoricImageModel');
            $this->historicDAO = $this->dal('HistoricDAO');
        }
  
        public function index(){
            $content = $this->getHistoricContent();
            $images = $this->getHistoricImages();

            $data = [
                'title' => 'Historic Page',
                'content' => $content,
                'images' => $images
            ];

            $this->ui('events/historic', $data);
        }

        // Get all the Historic content from the DAL
        public function getHistoricContent(){
            return $this->historicDAO->getHistoricContent();
        }

        // Get all the Historic images from the DAL
        public function getHistoricImages(){
            return $this->historicDAO->getHistoricImages();
        }

        // Top left item
        public function gridItem1($data){
            $content = array_slice($data['content'], 0);

            echo '
                <div class="contentItem">
                    <h2 class="gridHeaders">
                        '.$content[0]->getHeader().'
                    </h2>
                
                    <p class="contentText">
                    '.$content[0]->getDescription().'
                    </p>
                
                    <br>
                
                    <a href="'.URLROOT.'/ticketpagina" class="button">
                    '.$content[0]->getButton().'
                    </a>
                </div>
            ';
        }

        // Top right item
        public function gridItem2($data){
            $images = array_slice($data['images'], 0);

            echo 
            '
            <div class="contentItem">
                <img class="img" src="'.URLROOT.'/'.$images[0]->getImageUrl().'">
            </div>
            ';
        }

        // Bottom left item
        public function gridItem3($data){
            $images = array_slice($data['images'], 1);

            echo 
            '
            <div class="contentItem">
                <img class="img" src="'.URLROOT.'/'.$images[0]->getImageUrl().'">
            </div>
            ';
        }        

        // Bottom right item
        public function gridItem4($data){
            $content = array_slice($data['content'], 1);

            echo '
                <div class="contentItem">
                    <h2 class="gridHeaders">
                        '.$content[0]->getHeader().'
                    </h2>
                
                    <p class="contentText">
                        '.$content[0]->getDescription().'
                    </p>
                
                    <br>
                
                    <a href="'.URLROOT.'/venues" class="button">
                        '.$content[0]->getButton().'
                    </a>
                </div>
            ';
        }
    }
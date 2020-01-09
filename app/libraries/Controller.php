<?php
  /*
   * Base Controller
   * Loads the models and views
   */
  class Controller {
    // Load model
    public function model($model){
      // Require model file
      require_once '../app/Model/' . $model . '.php';

      // Instatiate model
      return new $model();
    }

    // Load DAL
    public function dal($dal){
      // Require dal file
      require_once '../app/DAL/' . $dal . '.php';

      // Instatiate dal
      return new $dal();
    }

    // Load DAL
    public function bll($bll){
      // Require dal file
      require_once '../app/BLL/' . $bll . '.php';

      // Instatiate dal
      return new $bll();
    }

    // Load view
    public function ui($ui, $data = []){
      // Check for ui file
      if(file_exists('../app/UI/' . $ui . '.php')){
        require_once '../app/UI/' . $ui . '.php';
      } else {
        // ui does not exist
        die('ui does not exist');
      }
    }
  }

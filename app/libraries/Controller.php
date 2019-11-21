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
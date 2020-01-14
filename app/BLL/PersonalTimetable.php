<?php
class PersonalTimeTable Extends Controller{

    //Create object for DAO and Model layer
    public function __construct() {

    }

    public function index () {


      $this->ui('pages/personaltimetable', $data);
    }

}

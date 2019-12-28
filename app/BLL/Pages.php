<?php
  class Pages extends Controller {

    public function __construct(){
        $this->homeDal = $this->dal('HomeDAO');
        $this->homeModel = $this->model('HomeModel');
    }

    public function index(){
      $eventInformation = $this->homeDal->eventInformation();
      $allEvents = $this->homeDal->allEvents();
      $eventDates = $this->homeDal->eventDates();

      $data = [
        'title' => 'Welcome',
        'informations' => $eventInformation,
        'events' => $allEvents,
        'dates' => $eventDates
      ];

      $this->ui('pages/index', $data);
    }
  }

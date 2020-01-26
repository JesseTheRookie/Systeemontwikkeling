<?php
  class Mollie extends Controller {

    public function __construct(){
    }


    public function index(){

      $data = [
          'title' => 'Payment Form'
      ];
      $this->ui('payment/mollie', $data);
    }

}

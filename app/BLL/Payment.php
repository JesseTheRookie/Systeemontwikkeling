<?php
  class Payment extends Controller {

    public function __construct(){
        //Sees is the session user id is there to check if you are logged in (in able to only acces the page)
       if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->paymentDal = $this->dal('PaymentDAO');
        $this->paymentModel = $this->model('PaymentModel');
    }


    public function index(){

      $data = [
          'title' => 'Payment Form'
      ];

      if (!isset($_POST['submit'])) {
        redirect('index');

      }
      $this->ui('payment/payment', $data);
    }

}

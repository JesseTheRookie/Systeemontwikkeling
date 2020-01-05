<?php

  class PDF extends Controller {

    public function __construct(){
        $this->pdfDal = $this->dal('PdfDAO');
        $this->pdfModel = $this->model('PdfModel');
    }

    //User confirmation of ordered ticket(s)
    public function index(){
      $orderInformation = $this->pdfDal->getOrderInformation();

      $data = [
        'orders' => $orderInformation
      ];

      $this->ui('pdf/index', $data);
    }

    //User ordered ticket with QR code
    public function ticket(){
      $orderInformation = $this->pdfDal->getOrderInformation();

      $data = [
        'orders' => $orderInformation
      ];

      $this->ui('pdf/ticket', $data);
    }
  }

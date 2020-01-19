<?php
class Mollie Extends Controller{

    //Need ticket/artist and days information. Passing it in an array that will be passed around on the website.
    public function index(){

        if (!isset($_POST['submit'])) {
          redirect('index');
        }

    //Load View
    $this->ui('pages/mollie');
        }
    }


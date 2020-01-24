<?php
    // Load Config
    require_once 'config/config.php';

    //Load helpers
    require_once 'helpers/session_helper.php';
    require_once 'helpers/urlHelper.php';

    //Load Mollie
    require_once 'libraries/mollie/vendor/autoload.php';
    require_once 'libraries/mollie/examples/functions.php';

    //Load FPDF
    //require_once 'libraries/FPDF/fpdf.php';
    require_once 'libraries/TCPDF/tcpdf.php';

/*
    require 'libraries/PHPMailer/Exception.php';
    require 'libraries/PHPMailer/PHPMailer.php';
    require 'libraries/PHPMailer/SMTP.php';

*/
    // Autoload Core Libraries
    spl_autoload_register(function($className){
        require_once 'libraries/' . $className . '.php';
  });

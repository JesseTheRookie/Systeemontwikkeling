<?php
    // Load Config
    require_once 'config/config.php';

    //Load helpers
    require_once ('helpers/session_helper.php');
    require_once 'helpers/urlHelper.php';

    require_once 'libraries/mollie/vendor/autoload.php';
    require_once 'libraries/mollie/examples/functions.php';

    // Autoload Core Libraries
    spl_autoload_register(function($className){
        require_once 'libraries/' . $className . '.php';
  });

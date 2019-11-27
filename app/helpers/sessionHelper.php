<?php   
    session_start();
    
    //Flash message helper
    //EXAMPLE - flash('registerSuccess', 'You are now registered', 'alert alert-danger');
    //DISPLAY IN VIEW - echo flash('registerSuccess');
    function flash($name= '', $message = '', $class = 'alert alert-success'){
        if(!empty($name)){
            if(!empty($message) && empty($_SESSION[$name])){
                if(!empty($_SESSION[$name])) {
                    unset($_SESSION[$name]);
                }

                if(!empty($_SESSION[$name. 'Class'])) {
                    unset($_SESSION[$name. 'Class']);
                }
                
                $_SESSION[$name] = $message;
                $_SESSION[$name. 'Class'] = $class;
            } elseif(!empty($message) && empty($_SESSION[$name])) {
                $class = !empty($_SESSION[$name. 'Class']) ? $_SESSION[$name. 'Class'] : '';
                echo '<div class="'.$class.'" id="msgFlash">'.$_SESSION[$name].'</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$class]);
            }
        }
    }



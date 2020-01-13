<?php 
    class Navigation Extends Controller{
        public function loginButton($_SESSION){
            if(isset($_SESSION['userId'])) : ?>
                <li>
                  <a href="<?php echo URLROOT; ?>/users/logout" class="buttonStyle">
                    Logout
                  </a>
                </li>
              <?php else : ?>
    
                <li>
                  <a href="<?php echo URLROOT; ?>/users/login" class="buttonStyle">
                    Login
                  </a>
                </li>
        }
    }
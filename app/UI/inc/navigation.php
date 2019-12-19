<header>
  <section id="section-header-50">
    <div class="content-header-50">
      <div>
        <a href="<?php echo URLROOT; ?>">
          <img src="./img/logo.png"
            alt="Logo Haarlem Festival"
            title="Logo Haarlem Festival"
            class="logo-header"
          />
        </a>
      </div>

      <div>
        <ul class="header-nav">
          <li>
            <a href="<?php echo URLROOT; ?>/about">
              About
            </a>
          </li>

          <li>
            <a href="<?php echo URLROOT; ?>/tickets">
              Tickets
            </a>
          </li>

          <li>
            <article class="dropdown">
              <li class="dropbtn">
                <a href="">
                  Events <i class="fas fa-caret-down"></i>
                </a>
              </li>

              <article class="dropdown-content">
                  <a href="<?php echo URLROOT; ?>/dance">
                    Dance
                  </a>

                  <a href="<?php echo URLROOT; ?>/jazz">
                    Jazz
                  </a>

                  <a href="<?php echo URLROOT; ?>/historic">
                    Historic
                  </a>
                  <a href="<?php echo URLROOT; ?>/food">
                    Food
                  </a>
                  <a href="<?php echo URLROOT; ?>/kids">
                    Kids
                  </a>
              </article>
            </article>
          </li>

          <li>
            <article class="dropdown">
              <li class="dropbtn">
                <a href="<?php echo URLROOT; ?>/information/information">
                  Information <i class="fas fa-caret-down"></i>
                </a>
              </li>

              <article class="dropdown-content">
                <a href="<?php echo URLROOT; ?>/information/travel">
                  Travel
                </a>

                <a href="<?php echo URLROOT; ?>/information/rules">
                  Rules
                </a>

                <a href="<?php echo URLROOT; ?>/information/faq">
                  FAQ
                </a>
              </article>
            </article>
          </li>

          <li>
            <a href="<?php echo URLROOT; ?>/contact">
              Contact
            </a>
          </li>

          <?php if(isset($_SESSION['userId'])) : ?>
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
          <?php endif; ?>

            <li>
              <a href="<?php echo URLROOT; ?>/shoppingcart/shopping-cart">
                <img
                  src="./img/shopping-cart.png"
                  class="shopping-cart"
                  alt="Shopping cart"
                />
              </a>
            </li>
          </ul>
        </div>
    </div>
  </section>
</header>

<footer id="layout-footer-25">

  <article class="footer-center">
    <li>
        <input type="text" placeholder="Subscribe to our newsletter...">
    </li>

    <li>
      <button class="button-footer">
        Sign up
      </button>
    </li>
  </article>

  <div class="content-footer-25">
    <div>
      <h5>
        Navigation
      </h5>

      <ul>
        <li>
          <a href="<?php echo URLROOT; ?>">
            Home
          </a>
        </li>

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
          <a href="<?php echo URLROOT; ?>/contact">
            Contact
          </a>
        </li>

        <li>
          <a href="<?php echo URLROOT; ?>/login">
            Log in
          </a>
        </li>
      </ul>
    </div>

    <div>
      <h5>
        Festival Info
      </h5>

      <ul>
        <li>
          <a href="<?php echo URLROOT; ?>/information/travel">
            Travel
          </a>
        </li>

        <li>
          <a href="<?php echo URLROOT; ?>/information/rules">
            Rules
          </a>
        </li>

        <li>
          <a href="<?php echo URLROOT; ?>/information/faq">
            FAQ
          </a>
        </li>
      </ul>
    </div>

    <div>
      <h5>
        Events
      </h5>

      <ul>
        <?php foreach($data['events'] as $event) : ?>
          <li>
            <a href="<?php echo URLROOT; ?>/ <?php echo $event->getElementName(); ?>">
                <?php echo ucfirst($event->getElementName()); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div>
      <h5>
        Contact
      </h5>

      <ul>
        <li>
          <a href="https://www.finaldraft.com" target="_blank">
            Final Draft
          </a>
        </li>

        <li>
          <a href="mailto:info@finaldraft.nl">
            info@finaldraft.nl
          </a>
        </li>

        <li>
          <a href="https://www.google.com/maps?q=zijlweg+7+haarlem&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjm3OvmlInmAhVM_aQKHekzDsQQ_AUoAXoECAwQAw" target="_blank">
            Zijlweg 7
          </a>
        </li>

        <li>
          <a href="https://www.google.com/maps?q=zijlweg+7+haarlem&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjm3OvmlInmAhVM_aQKHekzDsQQ_AUoAXoECAwQAw" target="_blank">
            1234 AA Haarlem
          </a>
        </li>
      </ul>
    </div>
    </div>
  </div>
</footer>
</body>
</html>

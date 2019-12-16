<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>


<div id="section-hero">
    <div class="content-hero">
      <h1>
        Haarlem Festival
      </h1>

      <ul>

    <?php foreach($data['dates'] as $date) : ?>
        <li>
          Haarlem
        </li>
        <li>
          <?php
                $startDate = $date->getEventStartDate();
                $endDate = $date->getEventEndDate();
                echo date("jS", strtotime($startDate)) . " - " . date("jS F", strtotime($endDate));
          ?>
        </li>

        <li>
          <?php
                $endDate = $date->getEventEndDate();
                echo date("Y", strtotime($endDate));
          ?>
        </li>
    <?php endforeach; ?>

      </ul>

      <a href="<?php echo URLROOT; ?>/pages/tickets"
         class="buttonStyle">
        Tickets
      </a>

       <a href="<?php echo URLROOT; ?>/pages/about"
          class="buttonStyle">
        Program
      </a>
    </div>
</div>

<div id="festival-info">
    <h2>
      Experience a different kind of festival
    </h2>

    <hr>

  <div class="content-festival-info">
    <?php foreach($data['informations'] as $information) : ?>
      <div>
        <?php echo $information->getTotalArtists(); ?>
      </div>

      <div>
        <?php echo $information->getTotalLocations(); ?>
      </div>

      <div>
        <?php echo $information->getTotalTickets(); ?>
      </div>

      <div>
        <?php echo $information->getTotalEvents(); ?>
      </div>
    <?php endforeach; ?>

    <div>
      Artists
    </div>

    <div>
      Locations
    </div>

    <div>
      Tickets
    </div>

    <div>
      Events
    </div>
  </div>
</div>

<div id="section-events">
  <h2>
    Events
  </h2>

  <hr>

  <div class="content-events">
  <?php foreach($data['events'] as $event) : ?>
  <div class="eventContainer">
      <a href="<?php echo URLROOT; ?>/ <?php echo $event->getElementName(); ?>">
        <img
            src="<?php echo $event->getContent(); ?>"
            alt=""
        />

        <div class="centered">
          <h4>
            <?php echo $event->getElementName(); ?>
          </h4>

          <p>
            26TH JULY - 29TH JULY
          </p>
        </div>
      </a>
    </div>
  <?php endforeach; ?>

  </div>
</div>

<div id="layout-artists-33">
  <h2>
    Artists
  </h2>

  <hr>

  <div class="content-artists-33">
    <div>
        <img id="image" src="./img/tiesto.jpg">
    </div>

    <div>
        <img id="image2" src="./img/armin.png">
    </div>

    <div>
        <img id="image3" src="./img/afrojack.jpg">
    </div>
  </div>
</div>

<?php
    require APPROOT . '/UI/inc/footer.php';
?>

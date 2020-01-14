<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

<section id="section-hero">
    <article class="content-hero">
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

      <a href="<?php echo URLROOT; ?>/tickets"
         class="buttonStyle">
         Tickets
      </a>

       <a href="<?php echo URLROOT; ?>/timetable"
          class="buttonStyle">
          Timetable
      </a>
    </article>
  </section>

<section id="festival-info">
    <h2>
      Experience a different kind of festival
    </h2>

    <hr>

  <article class="content-festival-info">
    <?php foreach($data['eventInfo'] as $information) : ?>
      <article>
        <?php echo $information->getTotalArtists(); ?>
      </article>

      <article>
        <?php echo $information->getTotalLocations(); ?>
      </article>

      <article>
        <?php echo $information->getTotalTickets(); ?>
      </article>

      <article>
        <?php echo $information->getTotalEvents(); ?>
      </article>
    <?php endforeach; ?>

    <article>
      Artists
    </article>

    <article>
      Locations
    </article>

    <article>
      Tickets
    </article>

    <article>
      Events
    </article>
  </article>
</section>
  <?php var_dump($_SESSION['userId']); ?>

<section id="section-events">
  <h2>
    Events
  </h2>

  <hr>

  <article class="content-events">
  <?php foreach($data['events'] as $event) : ?>
  <article class="eventContainer">
      <a href="<?php echo URLROOT; ?>/ <?php echo $event->getElementName(); ?>">
        <img
            src="<?php echo $event->getContent(); ?>"
            alt=""
        />

        <article class="centered">
          <h4>
            <?php echo $event->getElementName(); ?>
          </h4>

          <p>
            26TH JULY - 29TH JULY
          </p>
        </article>
      </a>
    </article>
  <?php endforeach; ?>
</article>
</section>

<section id="layout-artists-33">
  <h2>
    Artists
  </h2>

  <hr>

  <article class="content-artists-33">
    <article>
        <img id="image" src="./img/dance/tiesto.jpeg">
    </article>

    <article>
        <img id="image2" src="./img/dance/armin.png">
    </article>

    <article>
        <img id="image3" src="./img/dance/afrojack.jpg">
    </article>
  </article>
</article>

<?php
    require APPROOT . '/UI/inc/footer.php';
?>

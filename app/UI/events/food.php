<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?>
<?php foreach($data['content'] as $c) : ?>
  <section id="section-restaurant-header">
      <article class="content-restaurant-header">
          <article>
              <img
                  src="<?php echo URLROOT; ?>/<?php echo $c->getContent(); ?>"
                  alt="Header food"
                  title="Header food"
                  class="header-food"
              />
          </article>

          <article class="content-food-right">
              <h3>
                  <?php
                    echo $c->getName();
                  ?>
              </h3>

              <?php
                  //To create a dynamic link, we need the button names(links), and we need the event name. In order to get the event name, we need to explode 'HAARLEM FOOD' because we only need 'FOOD'
                  $links = explode(", ", $c->getDescription());
                  $eventName = explode(" ", $c->getName());
              ?>

              <?php foreach($links as $link) : ?>
                  <a href="<?php echo URLROOT; ?>/<?php echo end($eventName); ?>#<?php echo $link ?>">
                      <?php
                          echo $link;
                      ?>
                  </a>
              <?php endforeach; ?>
          </article>
      </article>
  </section>
<?php endforeach; ?>

<section id="section-restaurant-food">
    <article class="content-restaurant-food" id="restaurants">
      <h2>
        Search for your cuisine or scroll down to see all restaurants!
      </h2>
    </article>

    <article class="form-restaurants">
      <form
          action="<?php echo URLROOT; ?>/food"
          method="POST"
          role="form">

          <input
            type="text"
            name="restaurantType"
            value=""
            placeholder="Choose your cuisine...">

          <button
            type="submit"
            class="submit-cuisine"
            value="submit">
              SEARCH
          </button>
      </form>
    </article>

    <article class="error-message-food">
        <span class="errorFood">
            <?php echo $data['restaurantsError']; ?>
        </span>
    </article>
</section>

<section id="section-all-restaurants">
  <article class="content-all-restaurants">
      <?php foreach($data['restaurants'] as $restaurant) : ?>
        <article class="restaurant-box">
            <a href="<?php echo URLROOT; ?>/restaurant/<?php echo $restaurant->getRestaurantId(); ?>">

              <img
                  src="<?php echo URLROOT; ?>/<?php echo $restaurant->getRestaurantContent(); ?>"
                  alt="Restaurant image"
                  title="Restaurant image"
              />

              <article class="overlay-food">
                  <h4>
                    <?php echo $restaurant->getRestaurantName(); ?>
                  </h4>

                  <p>
                    <?php echo $restaurant->getRestaurantType(); ?>
                  </p>
              </article>
            </a>
        </article>
      <?php endforeach; ?>
  </article>
</article>

<?php
    require APPROOT . '/UI/inc/footer.php';
?>

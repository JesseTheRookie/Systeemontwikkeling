<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>
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
                    echo $c->getElementName();
                  ?>
              </h3>

              <?php
                  $links = explode(", ", $c->getDescription());
              ?>

              <?php foreach($links as $link) : ?>
                  <a href="<?php echo $link; ?>">
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
    <article class="content-restaurant-food">
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
        placeholder="Type your cuisine...">

        <button
        type="submit"
        class="submit-cuisine"
        value="French">
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
    require APPROOT . '/ui/inc/footer.php';
?>

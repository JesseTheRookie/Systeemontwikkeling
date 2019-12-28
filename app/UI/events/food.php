<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

<div id="section-restaurant-header">
    <div class="content-restaurant-header">
        <div>
            <img
                src="./img/food-banner.jpg"
                alt="Header food"
                title="Header food"
                class="header-food"
            />
        </div>

        <div class="content-food-right">
            <h3>
                Haarlem <br>Food.
            </h3>

            <a href="#section-restaurant-food">
                Reservations
            </a>

            <a href="">
                Tickets
            </a>
        </div>
    </div>
</div>

<div id="section-restaurant-food">
    <div class="content-restaurant-food">
        <h2>
            Choose your restaurant <span class="food-span">:</span>
        </h2>
    </div>

    <div>
        <form
            action="<?php echo URLROOT; ?>/food"
            method="POST"
            role="form">

            <select name="all(8)" class="select-food">
                <option value="*">
                    All
                </option>

                <option
                    value="Dutch / European / Modern"
                    name="cuisineType">
                    Dutch / European / Modern
                </option>
            </select>

            <input
                type="submit"
                value="submit"
                class="submit-cousine"
            />
        </form>
    </div>
</div>

<div id="section-all-restaurants">
  <div class="content-all-restaurants">
      <?php foreach($data['restaurants'] as $restaurant) : ?>

        <div class="restaurant-box">
            <a href="<?php echo URLROOT; ?>/restaurant/<?php echo $restaurant->getRestaurantId(); ?>">

              <img
                  src="<?php echo URLROOT; ?>/<?php echo $restaurant->getRestaurantContent(); ?>"
                  alt="Restaurant image"
                  title="Restaurant image"
              />

              <div class="overlay-food">
                  <h4>
                    <?php echo $restaurant->getRestaurantName(); ?>
                  </h4>

                  <p>
                    <?php echo $restaurant->getRestaurantType(); ?>
                  </p>
              </div>
            </a>
        </div>
      <?php endforeach; ?>
  </div>
</div>

<?php
    require APPROOT . '/ui/inc/footer.php';
?>

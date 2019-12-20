<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>


<div id="section-restaurant-header">
    <div class="content-restaurant-header">
       <div>
            <img src="../img/food-banner.jpg" alt="" class="header-food">
        </div>

            <div class="content-food-right">
            <?php foreach($data['restaurant'] as $restaurant) : ?>

                <h3>
                    <?php echo $restaurant->getRestaurantName(); ?>
                </h3>
        <?php endforeach; ?>

        </div>
    </div>
</div>

<div id="section-restaurant-food">
    <div class="content-restaurant-food">
        <h2>
            Reservation
        </h2>
    </div>
</div>

<div id="section-detailed-restaurant">
    <div class="content-detailed-restaurant">
        <div>
            <?php foreach($data['restaurant'] as $restaurant) : ?>
                <h3>
                    <?php echo $restaurant->getRestaurantName(); ?>
                </h3>

                <?php
                    $cousines = explode("/ ", $restaurant->getRestaurantDescription()); ?>
                    <?php foreach($cousines as $cousine) : ?>
                        <span>
                           <?php echo $cousine; ?>
                        </span>
                    <?php endforeach; ?>

                    <img
                        src="<?php echo URLROOT; ?>/<?php echo $restaurant->getRestaurantContent(); ?>"
                        alt=""
                    />
        </div>

        <div>
            <form action="" id="form-food">
                <h1>
                    Book a table
                </h1>
                <article>
                    <label for="guests">Guests: </label>
                    <input type="text" name="guests" class="input-guests">
                </article>

                <article class="radio-buttons-food">
                    <label for="guests">Date: </label>
                        <?php foreach($data['information'] as $information) : ?>
                            <input
                                type="radio"
                                name="date"
                                value="<?php $information->getStartDateTime(); ?>"
                                class="radio-date">
                        <?php
                            $time = $information->getStartDateTime();
                            echo date("jS F", strtotime($time));
                         ?>
                    <?php endforeach; ?>
                </article>

                <article>
                    <label for="guests">Time: </label>
                        <?php foreach($data['information'] as $information) : ?>
                            <input
                                type="radio"
                                name="date"
                                value="<?php $information->getStartDateTime(); ?>"
                                class="radio-date">
                        <?php
                            $time = $information->getStartDateTime();
                            echo date("H:m", strtotime($time));
                         ?>
                    <?php endforeach; ?>
                </article>
                <article>
                    <textarea name="comment" class="comment-food"></textarea>
                </article>

                <article>
                    <p><span>*</span>Reservation fee</p>
                    <p><?php echo $restaurant->getPrice(); ?></p>
                </article>

                <button type="submit" class="button-submit">Add to cart</button>

                <p class="reservation-fee">
                    <span>*</span>A reservation fee of 10,- per person will be charged when a reservation is made on the Haarlem Festival site. Thhis fee will be deducted from the final check when visiting the restaurant.
                </p>
            </form>


            <?php endforeach; ?>
        </div>

    </div>
</div>

<?php
    require APPROOT . '/ui/inc/footer.php';
?>

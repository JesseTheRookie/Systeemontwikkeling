<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

<section id="section-restaurant-header">
    <article class="content-restaurant-header">
        <?php foreach($data['restaurant'] as $restaurant) : ?>
           <article>
                    <img
                        src="<?php echo URLROOT; ?>/<?php echo $restaurant->getRestaurantContent(); ?>"
                        alt="Restaurant image"
                        title="Restaurant image"
                        class="header-food"
                    />
            </article>

            <article class="content-food-right">
                    <h3>
                        <?php echo $restaurant->getRestaurantName(); ?>
                    </h3>
            </article>
        <?php endforeach; ?>
    </article>
</section>

<section id="section-detailed-restaurant">
    <article class="content-detailed-restaurant">
        <article>
            <?php foreach($data['restaurant'] as $restaurant) : ?>
                <h3>
                    <?php echo $restaurant->getRestaurantName(); ?>
                </h3>

                <?php
                    $cousines = explode("/ ", $restaurant->getRestaurantType());
                ?>

                <?php foreach($cousines as $cousine) : ?>
                    <span>
                       <?php echo $cousine; ?>
                    </span>
                <?php endforeach; ?>

                <img
                    src="<?php echo URLROOT; ?>/<?php echo $restaurant->getRestaurantContent(); ?>"
                    alt="Restaurant image"
                    title="Restaurant image"
                />

                <h5>
                    <?php echo $restaurant->getRestaurantDescription(); ?>
                </h5>
        </article>

        <article>
            <form
                action=""
                id="form-food">
                <h1>
                    Book a table
                </h1>

                <article>
                    <label for="guests">
                        Guests:
                    </label>

                    <input
                        type="text"
                        name="guests"
                        class="input-guests"
                    />
                </article>

                <article class="radio-buttons-food">
                    <label for="guests">
                        Pick time:
                    </label>

                    <select class="content-time-food">
                    <?php foreach($data['information'] as $information) : ?>
                          <option value="<?php $information->getStartDateTime(); ?>">
                                <?php echo $information->getStartDateTime(); ?>
                            </option>
                    <?php endforeach; ?>
                    </select>
                </article>




                <article>
                    <textarea name="comment" class="comment-food">
                    </textarea>
                </article>

                <article>
                    <p>
                        <span>
                            *
                        </span>
                        Reservation fee
                    </p>

                    <p class="price-right">
                        Subtotaal:
                        <span class="color-red">
                            € <?php echo $information->getPrice(); ?>
                        </span>
                    </p>
                </article>

                <button
                    type="submit"
                    class="button-submit">
                        Add to cart
                </button>

                <p class="reservation-fee">
                    <span>*</span>
                    A reservation fee of
                        <span class="color-red">
                            € <?php echo $information->getPrice();?>
                        </span>
                         per person will be charged when a reservation is made on the Haarlem Festival site. This fee will be deducted from the final check when visiting the restaurant.
                </p>
            </form>
        <?php endforeach; ?>
        </div>
    </article>
</section>

<?php
    require APPROOT . '/ui/inc/footer.php';
?>

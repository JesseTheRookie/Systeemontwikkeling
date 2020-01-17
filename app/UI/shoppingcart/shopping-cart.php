<?php
    require APPROOT . '/UI/inc/header.php';
<<<<<<< HEAD
   // require APPROOT . '/UI/inc/navigation.php';
=======
    require APPROOT . '/UI/inc/navigation.php';
>>>>>>> develop
?>
<div id="layout-shoppingcart">
    <h1>
        Shopping Cart
    </h1>

    <hr>

    <div class="content-shoppingcart">
        <div>
            <h2>
                Tickets >
            </h2>
        </div>

        <div>
            <h2>
                Registration >
            </h2>
        </div>

        <div class="background-grey-location">
            <h2>
                Overview >
            </h2>
        </div>

        <div>
            <h2>
                Payment >
            </h2>
        </div>

        <div>
            <h2>
                Confirmation >
            </h2>
        </div>
    </div>
</div>

<div id="shoppingcart-overview">
    <table class="shoppingcart-items">
        <tr>
            <th>
                Description
            </th>

            <th>
                Quantity
            </th>

            <th>
                Time
            </th>

            <th>
                Subtotal
            </th>

            <th>
                Total
            </th>
        </tr>
<<<<<<< HEAD

        <?php foreach ($data['items'] as $item): ?>
            <tr>
                <td>
                    <?php
                        echo $item['name'];
                    ?>
                </td>

                <td>
                    <?php
                        echo $this->getQuantity($item['ticketId']);
                     ?>
                </td>

                <td>
                    <?php
                        echo date("jS F H:i", strtotime($item['startDateTime']));
                     ?>
                </td>

                <td>
                    <?php
                        echo "€ " . $item['price'];
                    ?>
                </td>

                <td class="totalpp">
                    <?php
                         echo "€ " . $this->calculateTotalPricePerProd($item['ticketId']);
                     ?>
                </td>

                <td>
=======
         <?php foreach ($data['items'] as $item): ?>
        <tr>
            <td>
                <?php
                    echo $item['name'];
                ?>
            </td>

            <td>
                <?php
                    foreach ($_SESSION['shoppingCart'] as $quantity => $total) {
                        //Converting array ($Total) to a string by the implode function.
                        if ($item['ticketId'] == $quantity) {
                            $string_product = implode(',',$total);
                            echo $string_product;
                        }
                    }
                 ?>
            </td>

            <td>
                <?php
                   echo date("jS F H:i", strtotime($item['startDateTime']));
                 ?>
            </td>

            <td>
                <?php
                    echo $item['price'];
                ?>
            </td>

            <td>
                <?php
                    foreach ($_SESSION['shoppingCart'] as $quantity => $total) {
                        if ($item['ticketId'] == $quantity) {
                            echo $item['price'] * $total['Quantity'];
                        }
                    }
                 ?>
            </td>

            <td>
>>>>>>> develop
                    <form
                        action="<?php echo URLROOT; ?>/shoppingcart/deleteFromCart"
                        method="POST"
                        role="form">

                        <button
                            type="submit"
                            name="delete"
                            value="<?php echo $item['ticketId']; ?>">
<<<<<<< HEAD

                            <img
                                src="<?php echo URLROOT; ?>/img/shopping-cart/delete.png"
                                alt="Trash button"
                                title="Trash button"
                            />
                        </button>
                    </form>
                </td>
            </tr>
=======
                        <img
                            src="<?php echo URLROOT; ?>/img/shopping-cart/delete.png"
                            alt="Trash button"
                            title="Trash button"
                        />
                        </button>
                    </form>
            </td>
        </tr>
>>>>>>> develop
        <?php endforeach; ?>
    </table>
</div>

<div id="layout-checkout">
    <div class="content-checkout">
        <div>
            <h3>
                Total amount
            </h3>
        </div>

        <div>
            <?php
                echo "€ " . $this->calculateTotalPrice();
            ?>
        </div>

        <div>
            <form
                action="<?php echo URLROOT; ?>/payment"
                method="POST"
                role="form">
                <?php
                    $this->buttonShoppingCart();
                ?>
            </form>

                <img
                    src="<?php echo URLROOT; ?>/img/shopping-cart/ideal.png"
                    alt="Icon iDeal"
                    title="Icon iDeal"
                    class="header-food"
                />

                <img
                    src="<?php echo URLROOT; ?>/img/shopping-cart/mastercard.png"
                    alt="Icon mastercard"
                    title="Icon mastercard"
                    class="header-food"
                />

                <img
                    src="<?php echo URLROOT; ?>/img/shopping-cart/paypal.png"
                    alt="Icon paypal"
                    title="Icon paypal"
                    class="header-food"
                />
        </div>
    </div>
</div>

<div id="layout-cross-selling">
    <div class="content-cross-selling">
        <div>
            <h4>
                Grab a bite
            </h4>
            <img
                src="<?php echo URLROOT; ?>/img/food/fris.jpg"
                alt="Cross selling"
                title="Cross selling Item"
            />
            <p>
                Restaurant: Urban Frenchy Bistro Tojours
            </p>
            <p>
                Price: 35,00 pp
            </p>
            <p>
                Start: Today, 17.30
            </p>
            <p>
                Location: Oude Groenmarkt 10, Haarlem
            </p>
            <button type="submit" name="submit" >
                Add to cart
            </button>
        </div>
        <div>
            <h4>
                Go Party
            </h4>
            <img
<<<<<<< HEAD
                src="<?php echo URLROOT; ?>/img/dance/armin.png"
=======
                src="<?php echo URLROOT; ?>/img/food/fris.jpg"
>>>>>>> develop
                alt="Cross selling"
                title="Cross selling Item"
            />
            <p>
                Session: Back2Back
            </p>
            <p>
                Price:  € 75
            </p>
            <p>
                Start: 20:00, 27th July
            </p>
            <p>
                Location: Oude Groenmarkt 10, Haarlem
            </p>
            <button type="submit" name="submit">
                Add to cart
            </button>
        </div>

        <div>
            <h4>
                Grab a bite
            </h4>
            <img
                src="<?php echo URLROOT; ?>/img/food/fris.jpg"
                alt="Cross selling"
                title="Cross selling Item"
            />
            <p>
                Restaurant: Urban Frenchy Bistro Tojours
            </p>
            <p>
                Price: 35,00 pp
            </p>
            <p>
                Start: Today, 17.30
            </p>
            <p>
                Location: Oude Groenmarkt 10, Haarlem
            </p>
            <button type="submit" name="submit">
                Add to cart
            </button>
        </div>
    </div>

</div>

<script src="<?php echo URLROOT; ?>/js/ShoppingCartFunctions.js"></script>
<?php
    require APPROOT . '/ui/inc/footer.php';
?>

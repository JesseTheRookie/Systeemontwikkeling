<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
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
                VAT %
            </th>

            <th>
                Total
            </th>
        </tr>
        <tr>
            <td>
                Hardwell / Martin Garrix/ Armin van Buuren $ Caprera Openluchttheater
            </td>

            <td>
                1
            </td>

            <td>
                21 %
            </td>

            <td>
                150,00
            </td>

            <td>
                <img
                    src="./img/delete.png"
                    alt="Header food"
                    title="Header food"
                    class="header-food"
                />
            </td>
        </tr>
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
            260,-
        </div>

        <div>
            <button type="submit" name="submit">
                Order
            </button>
                <img
                    src="./img/ideal.png"
                    alt="Icon iDeal"
                    title="Icon iDeal"
                    class="header-food"
                />
                <img
                    src="./img/mastercard.png"
                    alt="Icon mastercard"
                    title="Icon mastercard"
                    class="header-food"
                />
                <img
                    src="./img/paypal.png"
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
            <hr>
            <img src="./img/food-banner.jpg" alt="">
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
        <div>
            <h4>
                Grab a bite
            </h4>
            <hr>
            <img src="./img/food-banner.jpg" alt="">
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

        <div>
            <h4>
                Grab a bite
            </h4>
            <hr>
            <img src="./img/food-banner.jpg" alt="">
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


<?php
    require APPROOT . '/ui/inc/footer.php';
?>

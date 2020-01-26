<?php
    require APPROOT . '/UI/inc/header.php';
    require APPROOT . '/UI/inc/navigation.php';
?>

<div id="layout-shoppingcart">
        <h1>
            Payment
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

        <div>
            <h2>
                Overview >
            </h2>
        </div>

        <div>
            <h2 class="background-grey-location">
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

<div id="layout-payment-form">
    <div class="content-payment-form">
        <div class="box-left">
            <h3>
                Shopping Cart
            </h3>

            <?php foreach ($_SESSION['cartItems'] as $item => $value): ?>
                <p>
                    <?php
                        $time = date("jS F H:i", strtotime($value['startDateTime']));
                        echo $value['name'] . ", " . $time . "<br>";
                    ?>
                </p>
            <?php endforeach; ?>

            <p class="border-above">
                Total: € <?php echo $_SESSION['totalPrice'] ?>
            </p>
        </div>

        <div class="box-right">
                <h3>
                   <?php echo "Choose your payment method, " . $_SESSION['userName']; ?>
                </h3>
                <article>
                <form
                    action="<?php echo URLROOT; ?>/mollie"
                    method="GET"
                    role="form">

                <input type="radio" class="radio-payment">
                    <img
                        src="<?php echo URLROOT; ?>/img/shopping-cart/ideal.png"
                        alt="Icon iDeal"
                        title="Icon iDeal"
                        class="header-food"
                    />
                        <h4>
                            iDeal (Free)
                        </h4>
                </article>

                <article>
                        <input type="radio" class="radio-payment">
                    <img
                        src="<?php echo URLROOT; ?>/img/shopping-cart/PayPal.png"
                        alt="Icon paypal"
                        title="Icon paypal"
                        class="header-food"
                    />
                        <h4>
                            PayPal (Free)
                        </h4>
                </article>

                <article>
                        <input type="radio" class="radio-payment">
                    <img
                        src="<?php echo URLROOT; ?>/img/shopping-cart/mastercard.png"
                        alt="Icon mastercard"
                        title="Icon mastercard"
                        class="header-food"
                    />
                        <h4>
                            MasterCard
                        </h4>
                </article>
                <article class="confirm-btn-payment">
                    <button
                        type="confirm"
                        value="confirm"
                        name="confirm"
                        class="button-payment">
                        Confirm
                    </button>
                    <h4>
                        Click to make your payment official
                    </h4>
                </article>
                </form>
        </div>
    </div>
</div>


<?php
require APPROOT . '/UI/inc/footer.php';
?>

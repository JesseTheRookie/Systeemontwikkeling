<?php
    require APPROOT . '/UI/inc/header.php';
    require APPROOT . '/UI/inc/navigation.php';
?>

<div id="layout-shoppingcart">
        <h1>
            Success
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
            <h2>
                Payment >
            </h2>
        </div>

        <div>
            <h2 class="background-grey-location">
                Confirmation >
            </h2>
        </div>
    </div>
</div>

<div id="section-confirm">
    <div class="content-confirm">
        <h2>
            <?php echo "Your order has been completed, " . $_SESSION['userName'] . "!" ?>
        </h2>

        <p>
            We will be processing your order, please check your e-mail for the confirmation.
        </p>

        <p>
            Redirect to the home page.
        </p>

        <a href="<?php echo URLROOT; ?>/index">
            Home
        </a>
    </div>
</div>

<?php
require APPROOT . '/ui/inc/footer.php';
?>

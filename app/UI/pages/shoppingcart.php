<?php
    require APPROOT . '/views/inc/header.php';
?>
<?php
    require APPROOT . '/views/inc/navigation.php';
?>
<div id="section-progress-cart">
    <h2>
        Shopping cart
    </h2>

    <hr>

    <div class="content-progress-cart">
        <div>
            Tickets >
        </div>
        <div>
            Registration >
        </div>
        <div class="button-position">
            Overview >
        </div>
        <div>
            Payment >
        </div>
        <div>
            Confirmation
        </div>
    </div>

    <table>
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
            Hardwell, Martin Garrix, Armin van Buuren @ Caprera Openluchttheater
        </td>
        <td>
            <input type="number" name="points" min="0" max="100" step="10" value="30">
        </td>
        <td>
            21%
        </td>
        <td>
            110
        </td>
        <td>
            <i class="fas fa-trash-alt"></i>
        </td>
      </tr>

    </table>
</div>

<div id="layout-total-amount">
    <div class="content-total-amount">
        <div>
            Total amount
        </div>
        <div>
            260,-
        </div>
        <div>
            <a href="">
                Order
            </a>
            <img src="<?php echo URLROOT; ?>/img/shopping-cart/mastercard.png">
            <img src="<?php echo URLROOT; ?>/img/shopping-cart/mastercard.png">
            <img src="<?php echo URLROOT; ?>/img/shopping-cart/mastercard.png">
        </div>
    </div>
</div>

<div id="section-cross-selling">
    <h2>
        Customers also go to...
    </h2>

    <hr>
    <div class="content-cross-selling">
        <div>
            <h4>
                Grab a bite
            </h4>
            <hr>
            <img src="../img/armin.png" alt="">
            <p>
                Restaurant: Urban Restaurant Bristro
            </p>
            <p>
                Price: <span class="red"> 35,00</span> p.p
            </p>
            <p>
                Start: Today: 17.30
            </p>
            <p class="bottom-p">
                Location: Oude Groenmarkt 10, Haarlem
            </p>
            <a href="">Add to Cart</a>
        </div>

        <div>
            <h4>
                Go to a venue
            </h4>
            <hr>
            <img src="../img/gare-du-nord-crossselling.jpg" alt="">
            <p>
                Dance: Martin Garrix
            </p>
            <p>
                Price: <span class="red"> 15,00</span> p.p
            </p>
            <p>
                Start: 27-07-2020, 22:00 - 23:00
            </p>
            <p class="bottom-p">
                Location: Club Ruis, Haarlem
            </p>
            <a href="">Add to Cart</a>
        </div>

        <div>
            <h4>
                Visit A Jazz Concert
            </h4>
            <hr>
            <img src="../img/restaurant-crossselling.jpg" alt="">
            <p>
                <span class="font-bold">Jazz:</span> Garde Du Nord
            </p>
            <p>
                Price: <span class="red"> Free</span>
            </p>
            <p>
                Start: 28-07-2020, 21:00 - 22:00
            </p>
            <p class="bottom-p">
                Location: De Grote Markt, Haarlem
            </p>
            <a href="">Add to Cart</a>
        </div>
    </div>
</div>
<?php
    require APPROOT . '/views/inc/footer.php';
?>

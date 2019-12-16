<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

<div id="section-restaurant-header">
    <div class="content-restaurant-header">
        <div>
            <img src="public/img/test.jpg" alt="">
        </div>

        <div class="content-dance-right">
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
            Reservation
        <hr>
        </h2>
    </div>
</div>

<div id="section-reservation-food">
    <div class="content-food-header">
        <div>

        <button class="button button1">
        ewlkjrwelk
        </button>
        <button class="button button2">
            EUROPEAN
        </button>
        <button class="button button3">
            SEAFOOD
        </button>

                <br>
                <a>

                </a>
                <a>

                </a>
                <a>

                </a>
                <a>

                </a>
            <div>
                <img src="" alt="" />
            </div>
                <p>
                    Exciting mix of traditions!
                    <br>
                    <br>
                    Anyone who wants to eat in the city center of Haarlem is more than welcome at the restaurant ML. The restaurant is housed in a beautifully renovated 17th century monument on the Klokhuisplein 9 in Haarlem. Here you can enjoy a combination of classic and modern and exclusive products with the most diverse taste sensations! In short, the perfect place for a culinary dinner.
                </p>
                <hr>

<div id="section-information-food">
    <div class="content-information-food">
        <div>
            <h1>
                Openings hours
            </h1>

            <a>
                Tuesday till saurday 18:00 - 22:00
            </a>
        </div>

        <div class="content-information-right">
            <h1>
                Services
            </h1>
            <a>
                Wheelchair access, Wi-Fi
            </a>
        </div>
    </div>
</div>
</div>

<div class="content-food-right">
    <h3>
        Book a table
    </h3>
    <br>

    <form action="" method="POST">
        <div style="width: 400px;">
        </div>

        <div style="padding-bottom: 18px;">
            Number of guests
            <span style="color: red;"> *</span>

            <input
                type="text"
                id="data_3"
                name="nombre"
                style="width: 200px;"
                class="form-control"
            />
        </div>

        <div style="padding-bottom: 18px;">
            Date:
        <span style="color: red;"> *</span>

        <button class="w3-btn w3-white w3-border w3-round-large">
            Thursday
        </button>
                <button class="w3-btn w3-white w3-border w3-round-large">Friday</button>
                <button class="w3-btn w3-white w3-border w3-round-large">Saturday</button>
                </div>
                <div style="padding-bottom: 18px;">Time:<span style="color: red;"> *</span>
                <button class="w3-btn w3-white w3-border w3-round-large">17:30</button>
                <button class="w3-btn w3-white w3-border w3-round-large">19:00</button>
                <button class="w3-btn w3-white w3-border w3-round-large">20:30</button>
                </div>
                <div style="padding-bottom: 18px;">Comments / Additional Requests<br/>
                <textarea id="data_9" false name="data_9" style="width : 400px;" rows="6" class="form-control"></textarea>
                </div>
                <div style="padding-bottom: 18px;"><input name="submit" value="submit" type="submit"/></div>
                </form>
                </form>
            </div>
        </div>
    </div>








<?php
    require APPROOT . '/ui/inc/footer.php';
?>

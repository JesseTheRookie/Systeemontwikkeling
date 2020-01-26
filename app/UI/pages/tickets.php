<?php
require APPROOT . '/UI/inc/header.php';
require APPROOT . '/UI/inc/navigation.php';
include APPROOT . '/BLL/ShoppingCart.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>jazz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/generic.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/tickets.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../libraries/fontawesome-free-5.11.2-web/css/all.css">
    <script src="../frameworks/jquery-3.4.1.min.js"></script>
    <script src="../js/functions.js"></script>
</head>
<body>
    <nav></nav>
    <header class="ticketsHeader">
        <h1>2019 buying passes</h1>
        <p>Tickets Haarlem Festival 2019</p>
    </header>
    <section id="filters">
        <form action="<?php echo URLROOT; ?>/Tickets/setCurrentEvent" method="POST" role="form">
        <div id="eventButtons">
            <h2>Choose event...</h2>
            <button class="bigButtonTicket" name="event" type="submit" value="dance">tickets dance</button>
            <button class="bigButtonTicket" name="event" type="submit" value="jazz">tickets jazz</button>
            <button class="bigButtonTicket" name="event" type="submit" value="historic">tickets historic</button>
            <button class="bigButtonTicket" name="event" type="submit" value="food">tickets food</button>
        </div>
        </form>
        <form action="<?php echo URLROOT; ?>/Tickets/setCurrentDate" method="POST" role="form">
        <div id="dateButtons">
            <h2>Choose a date...</h2>
            <button class="bigButtonTicket" type="submit" name="date" value="2020-07-26">26th july</button>
            <button class="bigButtonTicket" type="submit" name="date" value="2020-07-27">27th july</button>
            <button class="bigButtonTicket" type="submit" name="date" value="2020-07-28">28th july</button>
            <button class="bigButtonTicket" type="submit" name="date" value="2020-07-29">29th july</button>
        </div>
        </form>
    </section>
    <section id="tickets">

    <?php print_r($data['tickets']);
    foreach ($data['tickets'] as $ticket => $value) { ?>
        <div class="ticket">
            <div class="categories head">
                <h3>name</h3>
                <h3>time</h3>
                <h3>quantity</h3>
                <h3>price</h3>
                <h3>total</h3>
            </div>
            <div class="categories">
                <p><?php echo $value['name']?></p>
                <p><?php echo $value['time']?></p>
                <p><input type="text" id="" name="quantity" placeholder="0"></p>
                <p><?php echo $value['name']?></p>
                <p>€ 0.00</p>
            </div>
            <button class="smallButton"><i class="fas fa-shopping-cart"></i></button>
        </div>
    <?php } ?>

        <div class="ticket">
            <div class="categories head">
                <h3>name</h3>
                <h3>time</h3>
                <h3>quantity</h3>
                <h3>price</h3>
                <h3>total</h3>
            </div>
            <div class="categories">
                <p>Afrojack / Tiesto / Nicky Romero <br/> @ Caprera Openluchttheater</p>
                <p>14:00</p>
                <p><input type="text" id="" name="quantity" placeholder="0"></p>
                <p>€ 75.00</p>
                <p>€ 0.00</p>
            </div>
            <button class="smallButton"><i class="fas fa-shopping-cart"></i></button>
        </div>

        <button id="cta" class="bigButton">continue</button>
    </section>
    <footer></footer>
</body>
</html>

<?php
require APPROOT . '/UI/inc/footer.php';
?>

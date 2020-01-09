
<script type="text/javascript">
$('#dance').click(function (e) {
    $.ajax({
      type: 'POST',
      url: 'tickets.php',
      data: ({eventType:"danceTickets"}),
      cache: false
    })
});
</script>

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
    <header>
        <h1>2019 buying passes</h1>
        <p>Tickets Haarlem Festival 2019</p>
    </header>
    <section id="filters">
        <div id="eventButtons">
            <h2>Choose event...</h2>
            <button class="bigButton" id="dance">tickets dance</button>
            <button class="bigButton">tickets jazz</button>
            <button class="bigButton">tickets historic</button>
            <button class="bigButton">tickets food</button>
        </div>
        <div id="dateButtons">
            <h2>Choose a date...</h2>
            <button class="bigButton">26th july</button>
            <button class="bigButton">27th july</button>
            <button class="bigButton">28th july</button>
            <button class="bigButton">29th july</button>
        </div>
    </section>
    <section id="tickets">
        
    <?php foreach($data[$eventType] as $ticket){ 
        echo'<div class="ticket">
        <div class="categories head">
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
    </div>'
    }?>

        <div class="ticket">
            <div class="categories head">
                <h3>type</h3>
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
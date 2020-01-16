<?php
require APPROOT . '/UI/inc/header.php';
require APPROOT . '/UI/inc/navigation.php';
include APPROOT . '/BLL/ShoppingCart.php';

if (isset($_POST['ticket-quantity'])) {
    //$ticketId = $_POST['ticket-quantity'];

    //Nog ff naar kijken
    list($ticketId, $quantity) = explode("-", $_POST['ticket-quantity'], 2);

    foreach ($data['tickets'] as $t){
        if($t->getTicketId() == $ticketId){
            $t->setTicketQuantity($quantity);
            ShoppingCart::AddToCart($t);
        }
    }
}

?>

<header id="mainHeader">
    <section class="background" >
    </section>
    <section>
        <div class="overlay">
            <h1>haarlem <br/>jazz<span>.</span></h1>
            <button class="bigButton">Get Tickets</button>
            <button class="bigButton">Show program</button>
        </div>
        <p>
        <?php foreach($data['artists'] as $artist) :
            echo $artist->getArtistName(); echo "<span>.</span> ";
        endforeach; ?>
        </p>
    </section>
</header>

<section id="artiesten">
        <div id="lineup">
            <?php
            $counter = 0;
            foreach($data['artists'] as $artist) :

                ?>
                <article><h1><?php echo $artist->getArtistName(); ?><span>.</span></h1></article>
            <?php
                $counter++;
                if($counter >= 4){
                    break;
                }
            endforeach; ?>
         </div>
        <article id="allPerformers">
            <p>
            <?php foreach($data['artists'] as $artist) :
                echo $artist->getArtistName() + "<span>.</span>";
            endforeach; ?>
            </p>
        </article>
        <button id="performersButton" class="bigButton">see all performers</button>
    </section>
    <section id="ticketOverzicht">
        <header>
            <?php foreach ($data['days'] as $day) : ?>
            <section id="">
                <?php if ($day->startDateTime > date('Y-m-d H:i:s')): ?>
                    <h1><?php echo date("D", strtotime($day->startDateTime)) . "."; ?></h1>
                    <p><?php echo date("jS F", strtotime($day->startDateTime)); ?></p>
                    <form
                            action="<?php echo URLROOT; ?>/jazz"
                            method="POST"
                            role="form">

                        <button
                                type="submit"
                                class="ticket-date"
                                name="ticketDate"
                                value="<?php echo date("Y-m-d", strtotime($day->startDateTime)); ?>">
                            TICKETS
                        </button>
                    </form>
                <?php endif; ?>
            </section>
            <?php endforeach; ?>
        </header>
        <section id="ticketItems">
            <?php
            $i = 0;
            if (isset($_POST["ticketDate"]))
               {
                foreach($data['tickets'] as $ticket) {
                    $dateAndTime = explode(" ", $ticket->getStartDateTime());

                    if ($dateAndTime[0] == $_POST["ticketDate"]) { ?>

                        <article>
                            <form method="GET" action="<?php APPROOT . '/BLL/ShoppingCart.php/AddToCart' ?>">

                                <?php $artists = $ticket->getArtists();

                                foreach ($artists as $artist) : ?>
                                    <div><p><?php echo $artist->getArtistName(); ?></p></div>
                                <?php endforeach; ?>

                                <div><p><?php echo $ticket->getStartDateTime(); ?>
                                        - <?php echo $ticket->getEndDateTime() ?></p></div>
                                <div><p><?php echo $ticket->getJazzTicketLocation(); ?>
                                        <br/><span><?php echo $ticket->getJazzTicketHall(); ?></span></p></div>
                                <div><p>&#8364; <?php echo $ticket->getPrice(); ?></p></div>
                                <div>
                                    <select name="ticket-quantity" class="select-dance">
                                        <?php
                                        while ($i <= 10){ ?>
                                            <option value="<?php echo $ticket->getTicketId() . "-" . $i ?>">
                                                <?php
                                                echo ++$i;
                                                ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div><!-- drop down van maken -->
                                <div>
                                    <button class="smallButton" type="submit" name="addToCart">add</button>
                                </div>
                        </article>

                    <?php
                        }
                    }
                }
            ?>
<?php
require APPROOT . '/UI/inc/footer.php';
?>

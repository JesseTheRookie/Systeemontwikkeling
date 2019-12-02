<?php
require APPROOT . '/UI/inc/header.php';
?>
<?php
require APPROOT . '/UI/inc/navigation.php';
?>
<header id="mainHeader">
    <section class="background">
    </section>
    <section>
        <div class="overlay">
            <h1>haarlem <br/>jazz<span>.</span></h1>
            <button class="bigButton">Get Tickets</button>
            <button class="bigButton">Show program</button>
        </div>
        <p>gumbo kings<span>.</span> evolve<span>.</span> ntjam rosie<span>.</span> wicked jazz sounds<span>.</span> tom assemble<span>.</span> jonna frazer<span>.</span> fox & the mayors<span>.</span> unclu sue<span>.</span> chris allen<span>.</span> myles sanko<span>.</span>ruis soundsystem<span>.</span> the family XL<span>.</span> gare du nord<span>.</span> rilan & the bombardiers<span>.</span> soul six<span>.</span> han bennink<span>.</span> the nordanians<span>.</span> lilith merlot<span>.</span></p>
    </section>
</header>
<section id="artiesten">
        <div id="lineup">
            <?php foreach($data['artists'] as $artist) :
                $counter = 0;
                ?>
                <article><h1><?php echo $artist->artistName ?><span>.</span></h1></article>
            <?php
                $counter++;
                if($counter >= 4){
                    break;
                }
            endforeach; ?>
         </div>
        <article id="allPerformers">
            <p>gumbo kings<span>.</span> evolve<span>.</span> ntjam rosie<span>.</span> wicked jazz sounds<span>.</span> tom assemble<span>.</span> jonna frazer<span>.</span> fox & the mayors<span>.</span> unclu sue<span>.</span> chris allen<span>.</span> myles sanko<span>.</span>ruis soundsystem<span>.</span> the family XL<span>.</span> gare du nord<span>.</span> rilan & the bombardiers<span>.</span> soul six<span>.</span> han bennink<span>.</span> the nordanians<span>.</span> lilith merlot<span>.</span></p>
        </article>
        <button id="performersButton" class="bigButton">see all performers</button>
    </section>
    <section id="ticketOverzicht">
        <header>
            <section id="thursday">
                <h1>thu<span>.</span></h1>
                <p>26 july</p>
                <button class="normalButton">see tickets</button>
            </section>
            <section id="friday">
                <h1>fri<span>.</span></h1>
                <p>27 july</p>
                <button class="normalButton">see tickets</button>
            </section>
            <section id="saturday">
                <h1>sat<span>.</span></h1>
                <p>28 july</p>
                <button class="normalButton">see tickets</button>
            </section>
            <section id="sunday">
                <h1>sun<span>.</span></h1>
                <p>29 july</p>
                <button class="normalButton">see tickets</button>
            </section>
        </header>

        <p><?php echo print_r($data);  ?></p>
        <section id="ticketItems">
            <?php foreach($data['tickets'] as $ticket) : ?>
                <article>
                    <div><p><?php echo $ticket->artistName ?></p></div>
                    <div><p><?php $ticket->startDateTime ?> - <?php $ticket->endDateTime ?></p></div>
                    <div><p><?php echo $ticket->jazzTicketLocation ?><br/><span><?php echo $ticket->jazzTicketHall?></span></p></div>
                    <div><p>&#8364; <?php echo $ticket->price ?></p></div>
                    <div><input type="text" id="" name="quantity" placeholder="0"></div>
                    <div><button class="smallButton">add</button></div>
                </article>
            <?php endforeach; ?>


<?php
require APPROOT . '/UI/inc/footer.php';
?>

<?php
require APPROOT . '/UI/inc/header.php';
?>
<?php
require APPROOT . '/UI/inc/navigation.php';
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
               if (isset($_POST["ticketDate"]))
               {
                foreach($data['tickets'] as $ticket) :
                    $dateAndTime = explode(" ", $ticket->getStartDateTime());       
                    
                    if($dateAndTime[0] == $_POST["ticketDate"]){ ?>
                
                    <article>
                        <?php $artists = $ticket->getArtists();

                        foreach($artists as $artist) : ?>
                            <div><p><?php echo $artist->getArtistName(); ?></p></div>
                        <?php endforeach; ?>

                        <div><p><?php echo $ticket->getStartDateTime(); ?> - <?php echo $ticket->getEndDateTime() ?></p></div>
                        <div><p><?php echo $ticket->getJazzTicketLocation(); ?><br/><span><?php echo $ticket->getJazzTicketHall();?></span></p></div>
                        <div><p>&#8364; <?php echo $ticket->getPrice(); ?></p></div>
                        <div><input type="text" id="" name="quantity" placeholder="0"></div>
                        <div><button class="smallButton">add</button></div>
                    </article>
               
                <?php  }
                endforeach; 
                        
                    
                }           
                ?>       

<?php
require APPROOT . '/UI/inc/footer.php';
?>

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
            <h1>
                haarlem <br/>
                jazz<span>.</span>
            </h1>

            <button class="bigButton">
                Get Tickets
            </button>

            <button class="bigButton">
                Show program
            </button>
        </div>

        <p>
            <?php foreach($data['artists'] as $artist) :
                echo $artist->getArtistName() . "<span>.</span>";
            endforeach; ?>
        </p>
    </section>
</header>

<section id="artiesten">
    <div id="lineup">
        <?php $counter = 0; ?>
        <?php foreach($data['artists'] as $artist) : ?>
            <article>
                <h1>
                    <?php echo $artist->getArtistName(); ?>
                    <span>.</span>
                </h1>
            </article>

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
                echo $artist->getArtistName() . "<span>.</span>";
            endforeach; ?>
        </p>
    </article>

    <button
        id="performersButton"
        class="bigButton">
            see all performers
    </button>
</section>

<section id="ticketOverzicht">
    <header>
        <?php foreach ($data['days'] as $day) : ?>
            <section>
                <?php if ($day->startDateTime > date('Y-m-d H:i:s')): ?>
                    <h1>
                        <?php echo date("D", strtotime($day->startDateTime)) . "."; ?>
                    </h1>

                    <p>
                        <?php echo date("jS F", strtotime($day->startDateTime)); ?>
                    </p>

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

<?php if(isset($_POST["ticketDate"])): ?>
    <?php foreach($data['tickets'] as $ticket) : ?>
        <?php
            $dateAndTime = explode(" ", $ticket->getStartDateTime());
        ?>

        <?php if ($dateAndTime[0] == $_POST["ticketDate"]): ?>
            <form
                action="<?php echo URLROOT; ?>/jazz/orderJazzTickets"
                method="GET"
                role="form">

            <table class="table-tickets-dance">
                <tr>
                    <td>
                        <?php $artists = $ticket->getArtists();
                            foreach ($artists as $artist) : ?>
                            <div>
                                <p>
                                    <?php echo $artist->getArtistName(); ?>
                                </p>
                            </div>
                         <?php endforeach; ?>
                    </td>

                    <td>
                        <?php echo date("jS F H:i", strtotime($ticket->getStartDateTime())); ?>
                    </td>

                    <td>
                        <?php echo $ticket->getJazzTicketLocation(); ?>
                    </td>

                    <td>
                        &#8364; <?php echo $ticket->getPrice(); ?>
                    </td>

                    <td>
                        <select name="quantity" class="select-dance">
                            <?php
                            $i = 1;
                            while ($i <= 10){ ?>
                                <option value="<?php echo "jazz" . "|" . $i . "|" . $ticket->getTicketId() ?>">
                                    <?php
                                    echo $i;
                                    $i++;
                                    ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>

                <td class="reserved-tickets">
                    <input
                        type="checkbox"
                        name="reserved"
                        class="checkbox-reserved"
                        value="1">

                    <p class="p-checkbox">
                        Check to reserve
                    </p>
                </td>

                <td>
                    <button type="add" value="add" name="add" class="button-add-dance">
                        Add
                    </button>
                </td>
            </form>
        </table>
    <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
</section>

<?php
    require APPROOT . '/UI/inc/footer.php';
?>

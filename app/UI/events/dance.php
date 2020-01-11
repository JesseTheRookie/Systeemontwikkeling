<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

<section id="section-dance-header">
    <article class="content-dance-header">
        <?php foreach($data['content'] as $c) : ?>
            <article>
                <img src="<?php echo URLROOT; ?>/<?php echo $c->getContent(); ?>"
                    alt="Banner header dance page"
                    title="Banner header dance page"
                />
            </article>

            <article class="content-dance-right">
                <h3>
                    <?php
                        echo $c->getElementName();
                    ?>
                </h3>

                <?php
                  //To create a dynamic link, we need the button names(links), and we need the event name. In order to get the event name, we need to explode 'HAARLEM FOOD' because we only need 'FOOD'
                  $links = explode(", ", $c->getDescription());
                  $eventName = explode(" ", $c->getElementName());
                ?>

                <?php foreach($links as $link) : ?>
                  <a href="<?php echo URLROOT; ?>/<?php echo end($eventName); ?>#<?php echo $link ?>">
                        <?php
                            echo $link;
                        ?>
                    </a>
                <?php endforeach; ?>
            </article>
        <?php endforeach; ?>
    </article>
</section>

<section id="section-artists-dance">
    <h2>
        Performers
    </h2>

    <hr>

    <?php
    foreach ($data['artists'] as $artist) {
         $content[] = $artist->getContent();
         $names[] = $artist->getArtistName();
    }
        $content = array_unique($content);
        $names = array_unique($names);
    ?>

    <article class="content-artists-dance" id="performance">
        <?php foreach ($content as $c): ?>
            <article>
                <img
                    src="<?php echo URLROOT; echo $c ?>"
                    alt="Performer Dance Artist"
                    title="Performer Dance Artist"
                />
            </article>
        <?php endforeach; ?>
    </article>
</section>

<section id="layout-header-dance">
  <h1>
    Tickets
  </h1>

  <hr>

  <article class="content-header-dance" id="tickets">
        <?php foreach ($data['days'] as $day) : ?>
            <?php if ($day->startDateTime > date('Y-m-d H:i:s')): ?>
                <article>
                    <h2>
                        <?php echo date("D", strtotime($day->startDateTime)) . "."; ?>
                    </h2>

                    <p>
                        <?php echo date("jS F", strtotime($day->startDateTime)); ?>
                    </p>

                    <form
                        action="<?php echo URLROOT; ?>/dance"
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
                </article>
            <?php endif; ?>
        <?php endforeach; ?>
    </article>


<?php foreach($data['tickets'] as $ticket) : ?>

    <table class="table-tickets-dance">
        <tr>
            <td>
            <?php $artists = $ticket->getArtists();

                foreach($artists as $artist) :
                    echo $artist->getArtistName() . "<br>";
                endforeach;
            ?>
            </td>

            <td>
                <?php
                    $time = explode(" ", $ticket->getstartDateTime());
                    echo end($time);
                 ?>
            </td>

            <td>
                <?php echo $ticket->getDanceTicketSession(); ?>
            </td>

            <td>
                € <?php echo $ticket->getPrice(); ?>
            </td>

            <td>
                <input
                    type="text"
                    id=""
                    name="quantity"
                    class="input-amount-dance"
                    placeholder="0">
            </td>

                <td>
                    <a href="" class="button-add-dance">
                        Add
                    </a>
                </td>
        </tr>
    </table>
<?php endforeach; ?>

</section>

<?php
    require APPROOT . '/ui/inc/footer.php';
?>


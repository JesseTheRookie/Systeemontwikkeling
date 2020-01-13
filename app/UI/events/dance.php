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

    <article class="content-artists-dance" id="performance">
        <?php foreach ($data['performers'] as $performer) : ?>
            <article>
                <img
                    src="<?php echo URLROOT; echo $performer->content; ?>"
                    alt="Performer Dance Artist"
                    title="Performer Dance Artist"
                />
                <button class="myBtn">
                    <?php echo $performer->name ?>
                </button>
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
                <article>
                    <h2>
                        <?php echo date("D", strtotime($day->startDateTime)) . "."; ?>
                    </h2>

                    <p>
                        <?php echo date("jS F", strtotime($day->startDateTime)); ?>
                    </p>

                    <form
                        action="<?php echo URLROOT; ?>/dance"
                        method="GET"
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
        <?php endforeach; ?>
    </article>

    <?php foreach($data['tickets'] as $ticket) : ?>
        <table class="table-tickets-dance">
            <tr>
                <td>
                    <?php
                        foreach($data['artists'] as $artist) :
                            if ($artist->ticketId == $ticket->getTicketId()) {
                                echo $artist->artistName . "<br>";
                            }
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
                    <select class="select-dance">
                        <option value="">
                            SELECT
                        </option>

                        <?php
                        $i = 1;
                        while ($i <= 10): ?>
                        <option value="<?php echo $i; ?>">
                            <?php echo $i;
                            $i++;
                             ?>
                        </option>
                    <?php endwhile; ?>
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


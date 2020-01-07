<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

<?php foreach($data['content'] as $c) : ?>
    <section id="section-dance-header">
        <article class="content-dance-header">
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
                    $links = explode(", ", $c->getDescription());
                ?>

                <?php foreach($links as $link) : ?>
                    <a href="<?php echo $link; ?>">
                        <?php
                            echo $link;
                        ?>
                    </a>
                <?php endforeach; ?>

            </article>
        </article>
    </section>
<?php endforeach; ?>

<section id="section-artists-dance" class="Performance">
    <h2>
        Performers
    </h2>

    <hr>

    <article class="content-artists-dance">
        <?php foreach($data['artists'] as $artist) : ?>
            <article>
                <img
                    src="<?php echo URLROOT; ?>/<?php echo $artist->getContent(); ?>"
                    alt="Performer Dance Artist"
                    title="Performer Dance Artist"
                />
                <button class="myBtn">
                    <?php echo $artist->getArtistName(); ?>
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

  <article class="content-header-dance" class="">
        <?php foreach ($data['days'] as $day) : ?>

            <?php if ($day->startDateTime > date('Y-m-d H:i:s')): ?>
                <div>
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
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </article>

<?php
    foreach($data['tickets'] as $ticket) : ?>
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
                <?php
                    echo $ticket->getDanceTicketSession();
                ?>
            </td>

            <td>
                <?php
                    echo "€ " . $ticket->getPrice();
                ?>
            </td>

            <td>
                <input type="text" id="" name="quantity" placeholder="0" class="input-amount-dance">
            </td>

                <td>
                    <a href="" class="button-add-dance">
                        Add
                    </a>
                </td>
        </tr>
    </table>
<?php endforeach; ?>
</div>

<?php
    require APPROOT . '/ui/inc/footer.php';
?>

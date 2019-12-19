<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

    <div id="section-dance-header">
        <div class="content-dance-header">
            <div>
                <img src="./img/banner-dance.jpeg"
                    alt="Banner header dance page"
                    title="Banner header dance page"
                />
            </div>

            <div class="content-dance-right">
                <h3>
                    Haarlem <br>Dance.
                </h3>

                <a href="#section-artists-dance">
                    Performers
                </a>

                <a href="#layout-header-dance">
                    Tickets
                </a>
            </div>
        </div>
    </div>


<div id="section-artists-dance">
    <h2>
        Performers
    </h2>

    <hr>

    <div class="content-artists-dance">
        <?php foreach($data['artists'] as $artist) : ?>
            <div>
                <img src="<?php echo URLROOT; ?>/<?php echo $artist->getContent(); ?>" alt="">
                <button class="myBtn"><?php echo $artist->getArtistName(); ?></button>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div id="layout-header-dance">
  <h1>
    Tickets
  </h1>

  <hr>

  <div class="content-header-dance">
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
</div>

<?php foreach($data['tickets'] as $ticket) : ?>
    <table class="table-tickets-dance">
        <tr>
            <td>
                <?php foreach($data['artists'] as $artist) : ?>
                    <?php echo $artist->getArtistName(); ?>
                <?php endforeach; ?>
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
                    <option value="Quantity">
                        Quantity
                    </option>
                    <option value="1">
                        1
                    </option>
                    <option value="2">
                        2
                    </option>
                    <option value="3">
                        3
                    </option>
                    <option value="4">
                        4
                    </option>
                </select>
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


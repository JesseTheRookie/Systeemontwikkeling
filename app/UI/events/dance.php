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
                <img src="<?php echo URLROOT; ?>/<?php echo $artist->getImgUrl(); ?>" alt="">
                <button class="myBtn"><?php echo $artist->getArtistName(); ?></button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                    <article class="modal-header">

                        <span class="close">×</span>

                        <h1>
                            <?php echo $artist->getArtistName(); ?>
                        </h1>

                        <hr>
                    </article>
                    <article class="modal-body">
                        <p>
                            <?php echo $artist->getArtistBio(); ?>
                        </p>
                    </article>
                </article>
            </div>
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

                <input
                    type="text"
                    name="ticketDate"
                    value="Jopenkerk"
                />

                <input
                    type="submit"
                    name="name"
                    value="Jopenkerk"
                />
            </form>
        </div>
    <?php endif; ?>
    <?php endforeach; ?>
    </div>

<?php foreach($data['tickets'] as $ticket) : ?>
    <table class="table-tickets-dance">
        <tr>
            <td>
                <?php echo $ticket->getDanceTicketArtist(); ?>
            </td>

            <td>
                <?php
                    $date1 = $ticket->getEndDateTime();
                    $date2 = $ticket->getStartDateTime();
                    echo round((strtotime($date1) - strtotime($date2)) /60);
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


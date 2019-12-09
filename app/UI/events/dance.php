<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

    <div id="section-dance-header">
        <div class="content-dance-header">
            <div>
            <img src="./img/banner-dance.jpg" alt="">
            </div>
            <div class="content-dance-right">
                <h3>
                    Haarlem <br>Dance.
                </h3>
                <a href="">
                    Performers
                </a>
                <a href="">
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
            <img src="<?php echo URLROOT; ?>/<?php echo $artist->imgUrl ?>" alt="">
            <button class="myBtn"><?php echo $artist->artistName ?></button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h1><?php echo $artist->artistName ?></h1>
                        </article>
                    <article class="modal-body">
                        <p><?php echo $artist->artistBio ?></p>
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
    <div>
        <h2>
            Fri.
        </h2>
        <p>
            27th July
        </p>
        <form action="<?php echo URLROOT; ?>DanceTicketService/searchByDay" method="post" role="form">
                <input type="text" name="name" id="name" value="<?php echo $data['name'] ?>">
                <input type="submit" name="submit">
        </form>
    </div>


  </div>
  <?php foreach($data['tickets'] as $tickets) : ?>
<table class="table-tickets-dance">
  <tr>
    <td>    <?php echo $tickets->artistName; ?></td>
    <td>    <?php echo $tickets->startDateTime - $tickets->endDateTime; ?></td>
    <td>    <?php echo $tickets->danceTicketLocation; ?></td>
    <td>   € <?php echo $tickets->price; ?></td>
    <td>    <select class="select-dance">
                    <option value="Quantity">Quantity</option>
                    <option value="1">1</option>
                     <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
    </td>
    <td> <a href="" class="button-add-dance">Add</a></td>
  </tr>
</table>
<?php endforeach; ?>

</div>
<?php
    require APPROOT . '/ui/inc/footer.php';
?>

<style>
</style>

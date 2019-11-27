<?php
    require APPROOT . '/ui/inc/header.php';
?>
<?php
    require APPROOT . '/ui/inc/navigation.php';
?>

    <div id="section-dance-header">
        <div class="content-dance-header">
            <div>
            <img src="../img/banner-dance.jpg" alt="">
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
        <div>
            <img src="../img/Tiesto.jpg" alt="">
            <button class="myBtn">Tiesto</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>

        <div>
            <img src="../img/Nicky.jpg" alt="">
            <button class="myBtn">Nicky Romero</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>

        <div>
            <img src="../img/hardwell.jpg" alt="">
            <button class="myBtn">Hardwell</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>

        <div>
            <img src="../img/armin.png" alt="">
            <button class="myBtn">Armin van Buuren</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>

        <div>
            <img src="../img/martin.jpeg" alt="">
            <button class="myBtn">Martin Garrix</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>

        <div>
            <img src="../img/afrojack.jpg" alt="">
            <button class="myBtn">Afrojack</button>

            <div id="myModal" class="modal">
                <article class="modal-content">
                        <article class="modal-header">
                            <span class="close">×</span>
                            <h2>Modal Header</h2>
                        </article>
                    <article class="modal-body">
                        <p>Some text in the Modal Body</p>
                    </article>
                </article>
            </div>
        </div>
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
        <a href="" class="ticket-days-dance">Tickets</a>
    </div>

    <div>
        <h2>
            Sat.
        </h2>
        <p>
            28th July
        </p>
        <a href="" class="ticket-days-dance">Tickets</a>
    </div>

    <div>
        <h2>
            Sun.
        </h2>
        <p>
            29th July
        </p>
        <a href="" class="ticket-days-dance">Tickets</a>
    </div>
  </div>
  <?php foreach($data['tickets'] as $tickets) : ?>
<table class="table-tickets-dance">
  <tr>
    <td>    <?php echo $tickets->danceTicketArtist; ?></td>
    <td>    <?php echo $tickets->startTijd; ?></td>
    <td>    <?php echo $tickets->danceTicketLocation; ?></td>
    <td>   € <?php echo $tickets->Price; ?></td>
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
.content-dance-header h3
{
    color: #ffffff;
    font-size: 70px;
    padding: 80px 0px 40px 0px;
}
#layout-header-dance
{
    background-image: linear-gradient(to bottom, #e8e8e8, #cbcbcb, #aeaeae, #939393, #787878);
    margin-bottom: -100px;
    padding: 0px 0px 100px 0px;
}

#section-artists-dance > div
{
    padding: 0px 0px 100px 0px;
}

#section-artists-dance h2
{
     font-size: 60px;
    color: #ffffff;
    margin: 0 auto;
    text-align: center;
    padding: 100px 0px 0px 0px;
}

#layout-header-dance h1
{
    font-size: 60px;
    color: #ffffff;
    margin: 0 auto;
    text-align: center;
    padding: 100px 0px 0px 0px;
}
#section-header-dance > div
{
    display: grid;
    grid-template-columns: 33% 33% 33%;
    position: relative;
    width: 100%;
    text-align: center;
    margin: 0 auto;
    padding: 0px 0px 0px 0px;
}
#layout-header-dance > div {
    display: grid;
    grid-template-columns: 33% 33% 33%;
    position: relative;
    margin: 0 auto;
    font-size: 20px;
    width: 80%;
    text-align: center;
    padding: 0px 0px 60px 0px;
}
.content-header-dance h2
{
font-size: 70px;
color: #ffffff;
}

.content-header-dance p
{
font-size: 20px;
color: #ffffff;
padding: 20px 0px;
}

.content-header-dance a
{
font-size: 28px;
color: #ffffff;
padding: 20px 0px;
text-decoration: none;
border: 1px solid #ffffff;
padding: 8px 20px;
text-transform: uppercase;
}

.table-tickets-dance
{
    width: 70%;
    color: #ffffff;
    font-size: 20px;
    border: none;
    margin: 0 auto;
}

.table-tickets-dance td
{
    width: 20%;
}

.select-dance
{
    background: transparent;
    border: 1px solid #ffffff;
    font-size: 16px;
    color: #ffffff;
}


.button-add-dance
{
    background: transparent;
    border: 1px solid #ffffff;
    font-size: 16px;
    color: #ffffff;
    padding: 12px 20px;
    text-decoration: none;
    text-transform: uppercase;
}
</style>

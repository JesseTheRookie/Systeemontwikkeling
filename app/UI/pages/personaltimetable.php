<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

<section id="layout-header-pt">
        <h1>
            Timetable
        </h1>

        <hr>

        <article class="content-header-pt">
            <article>
                <a href="">
                    Tickets Dance
                </a>
            </article>

            <article>
                <a href="">
                    Tickets Jazz
                </a>
            </article>

            <article>
                <a href="">
                    Tickets Historic
                </a>
            </article>


            <article>
                <a href="">
                    Tickets Food
                </a>
            </article>


            <article>
                <a href="">
                    Tickets Kids
                </a>
            </article>

            <article>
                <a href="">
                    Reserved
                </a>
            </article>
        </article>
</section>

  <?php //var_dump($_SESSION['userId']);
          //print_r($data['jazzTickets']);
          //print_r($data['danceTickets']);
  ?>


<section id="layout-calendar">
    <article class="content-calendar">
    <table class="table-bordered" id="table">

        <tr>
            <td></td>
            <td>Monday</td>
            <td>Wednesday</td>
            <td>Thursday</td>
            <td>Friday</td>
        </tr>
            <?php
                for($i = 10; $i < 24; $i++ ){
            ?>            <tr>
                            <td> <?php echo "$i:00:00" ?></td>
                            <td value="2020-07-26"><?php $this->getTicketByDayAndTime("2020-07-26", $i ) ?></td>
                            <td value="2020-07-27"><?php $this->getTicketByDayAndTime("2020-07-27", $i ) ?></td>
                            <td value="2020-07-28"><?php $this->getTicketByDayAndTime("2020-07-28", $i ) ?></td>
                            <td value="2020-07-29"><?php $this->getTicketByDayAndTime("2020-07-29", $i ) ?></td>
                          </tr>
          <?php  }
                ?>

    </table>
    </article>
</section>


<section id="layout-button-confirm">
    <article class="content-button-confirm">
        <a href="">
            Confirm Timetable
        </a>
    </article>
</section>

<?php
    require APPROOT . '/UI/inc/footer.php';
?>
<script>
var table = document.getElementById("table"),rIndex,cIndex;
var row = document.getElementById("row"),rIndex,cIndex;

for (var i = 0; i < table.rows.length; i++) {
    for (var j = 0; j < table.rows[i].cells.length; j++) {
 document.getElementById('row').firstChild.data = 'New Value';


    }
}
</script>

<!--$(table).find('tbody').append("<tr><td>aaaa</td></tr>"); -->

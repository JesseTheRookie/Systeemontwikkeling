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

  <?php var_dump($_SESSION['userId']);
          print_r($data['jazzTickets']);
          print_r($data['danceTickets']);
  ?>
        <?php foreach($data['jazzTickets'] as $jazzTicket) : ?>
            <?php print_r($jazzTicket); ?>
        <?php endforeach; ?>


<section id="layout-calendar">
    <article class="content-calendar">
    <table class="table-bordered" id="table">
        <tr>
        <?php foreach($data['days'] as $day) : ?>
            <th>
                <?php echo date("jS F", strtotime($day->startDateTime)); ?>
            </th>
        <?php endforeach; ?>
        </tr>

        <tr>
            <td id="row">

            </td>
            <td>
                1
            </td>
            <td>
                2
            </td>
            <td>
                15
            </td>
            <td>
                16
            </td>
        </tr>

        <tr>
            <td>
                7
            </td>
            <td>
                8
            </td>
            <td>
                9
            </td>
            <td>
                15
            </td>
            <td>
                16
            </td>
        </tr>

        <tr>
            <td>
                14
            </td>
            <td>
                15
            </td>
            <td>
                16
            </td>
            <td>
                15
            </td>
            <td>
                16
            </td>
        </tr>
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

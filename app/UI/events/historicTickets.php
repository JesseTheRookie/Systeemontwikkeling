<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

<h1 id="historicHeader">
  <?php echo $data['title']; ?>
</h1>

<section id="layout-header-dance">
    <article class="historicTickets" id="historicDays">
            <?php foreach ($data['days'] as $day) : ?>
                    <article>
                        <h2>
                            <?php echo date("D", strtotime($day->startDateTime)) . "."; ?>
                        </h2>

                        <p>
                            <?php echo date("jS F", strtotime($day->startDateTime)); ?>
                        </p>

                        <form
                            action="<?php echo URLROOT; ?>/historictickets"
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
        <form
            action="<?php echo URLROOT; ?>/historic/order"
            method="GET"
            role="form">

        <table class="table-tickets-dance">
            <tr>
                <td>
                    <?php                        
                        echo $ticket->getstartDateTime();
                     ?>
                </td>

                <td>
                    <?php
                        echo $ticket->getEndDateTime();
                     ?>
                </td>
                <td>
                    <?php
                       echo $ticket->getHistoricTicketLanguage();
                     ?>
                </td>
                <td>
                    <?php
                        echo '€ ' . $ticket->getPrice();
                     ?>
                </td>

                <td>
                    <?php
                        if(($ticket->getPrice() == 17.5)){
                            echo "1P ticket";
                        }else{
                            echo "4P ticket";
                        }
                     ?>
                </td>

                <td>
                    <select name="quantity" class="select-dance">
                        <?php
                            $i = 1;
                            while ($i <= 10){ ?>
                                <option value="<?php echo "dance" . "|" . $i . "|" . $ticket->getTicketId() ?>">
                                    <?php
                                        echo $i;
                                        $i++;
                                    ?>
                                </option>
                        <?php } ?>
                    </select>
                <td>

                        <button type="add" value="add" name="add" class="button-add-dance">
                            Add
                        </button>
                    </form>
                </td>

            </tr>
        </table>
    <?php endforeach; ?>
</section>


<?php
	require APPROOT . '/UI/inc/footer.php';
?>
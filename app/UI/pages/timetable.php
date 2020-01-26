<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

<section id="layout-timetable-buttons">
    <article class="content-timetable-buttons">
        <?php foreach ($data['events'] as $event) : ?>
                <div>
                    <form
                        action="<?php echo URLROOT; ?>/timetable/ <?php echo $event->getEventType(); ?>"
                        method="POST"
                        role="form">

                        <button
                            type="submit"
                            class="button-header-timetable"
                            name=" <?php echo $event->getEventType(); ?>"
                            value="<?php echo $event->getEventType(); ?>">
                            <?php echo $event->getEventType(); ?>
                        </button>
                    </form>
                </div>
        <?php endforeach; ?>
    </article>
</section>

<section id="layout-timetable-25">
    <article class="content-timetable-25">
        <?php foreach ($data['eventTimes'] as $eventTime) : ?>
        <article>
            <h2>
                <?php
                    echo $eventTime->getDanceTicketSession() . " On the ";
                ?>
                <?php
                    $strTime = $eventTime->getStartDateTime();
                    echo date("jS F", strtotime($strTime));
                ?>

            </h2>
            <h3>
                <span>
                <?php echo "€ " . $eventTime->getPrice(); ?>
            </span>
            </h3>
            <p>
                <?php
                    $strTime = $eventTime->getStartDateTime();
                    echo "Event starts at: " . date("H:i:s", strtotime($strTime));
                ?>
            </p>
            <p>
                <?php
                    $strTime = $eventTime->getEndDateTime();
                    echo "Event ends at: " . date("H:i:s", strtotime($strTime));
                ?>
            </p>
        </article>
        <?php endforeach; ?>
    </article>
</section>











<?php
    require APPROOT . '/UI/inc/footer.php';
?>

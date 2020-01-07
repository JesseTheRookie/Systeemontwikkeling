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
                        action="<?php echo URLROOT; ?>/timetable"
                        method="POST"
                        role="form">

                        <button
                            type="submit"
                            class="button-header-timetable"
                            name=""
                            value="<?php $event->getEventType(); ?>">
                            <?php echo $event->getEventType(); ?>
                        </button>
                    </form>
                </div>
        <?php endforeach; ?>
    </article>
</section>












<?php
    require APPROOT . '/ui/inc/footer.php';
?>

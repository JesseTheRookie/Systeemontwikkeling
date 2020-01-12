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
                            name=""
                            value="submit">
                            <?php echo $event->getEventType(); ?>
                        </button>
                    </form>
                </div>
        <?php endforeach; ?>
    </article>
</section>

<section id="layout-timetable-25">
    <article class="content-timetable-25">
        <article>

        </article>

        <article>
            wrelkjrwelkwre
        </article>

        <article>
            wrelkjrwelkwre
        </article>
    </article>
</section>











<?php
    require APPROOT . '/ui/inc/footer.php';
?>

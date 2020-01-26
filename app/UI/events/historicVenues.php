<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?>


<h1 id="historicHeader">
  <?php echo $data['title']; ?>
</h1>

<div class="venueTimeline">
  <?php echo $this->venueTimeline($data); ?>
</div>

<?php
	require APPROOT . '/UI/inc/footer.php';
?>
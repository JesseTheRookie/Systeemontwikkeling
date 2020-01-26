<?php
    require APPROOT . '/UI/inc/header.php';
?>
<?php
    require APPROOT . '/UI/inc/navigation.php';
?>

<h1 id="historicHeader">
  <?php echo $data['title']; ?>
</h1>

<div class="venueTimeline">
  <?php echo $this->venueTimeline($data); ?>
</div>

<?php
	require APPROOT . '/UI/inc/footer.php';
?>
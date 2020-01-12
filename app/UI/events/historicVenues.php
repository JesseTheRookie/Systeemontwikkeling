<?php
    require APPROOT . '/ui/inc/header.php';
?>
<?php
    require APPROOT . '/ui/inc/navigation.php';
?>

<br><br><br><br><br><br><br>

<h1 id="historicHeader">
  <?php echo $data['title']; ?>
</h1>

<div class="venueTimeline">
  <?php echo $this->venueTimeline($data); ?>
</div>

<?php
	require APPROOT . '/ui/inc/footer.php';
?>
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
  <?php 
    $side = "";
    foreach($data['venues'] as $venue) {
      $side = $this->timelineSideSetter($side);
      echo '
      <div class="container '.$side.'">
        <div class="content">
          <img class="timelineImg" src="'.URLROOT.'/'.$venue->getVenueImg().'"></img>
          <h2 class="contentHeader">'.$venue->getVenueName().'</h2>
          <p class="contentText">'.$venue->getVenueDesc().'</p>
        </div>
      </div>    
      ';
    }
  ?>
 

<?php
	require APPROOT . '/ui/inc/footer.php';
?>
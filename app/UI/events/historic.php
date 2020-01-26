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

		<div class="headerGrid">
			<div class="headerItem">
				<p>
					<a class="crumb" href="<?php echo URLROOT; ?>">Home</a> > <a class="crumb" href="<?php echo URLROOT; ?>/historic">Historic</a>	
				</p>
			</div>
  			<div class="headerItem">  				
  				<h1 id="historicHeader">
				  <?php echo $data['title']; ?>
				</h1>
			</div>
    		<div class="headerItem"></div>
		</div>

		<div class="contentGrid">
			<?php 
				echo $this->gridItem1($data);
				echo $this->gridItem2($data);
				echo $this->gridItem3($data);
				echo $this->gridItem4($data); 
			?>		  	
		</div>


<?php
	require APPROOT . '/UI/inc/footer.php';
?>
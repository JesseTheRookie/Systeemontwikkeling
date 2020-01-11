<?php
    require APPROOT . '/ui/inc/header.php';
?>
<?php
    require APPROOT . '/ui/inc/navigation.php';
?>
		<div class="headerGrid">
			<div class="headerItem">
				<p>
					<a class="crumb" href="~\home.html">Home</a> > <a class="crumb" href="historic.html">Historic</a>	
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
			<?php echo $this->gridItem1($data); ?>
			<?php echo $this->gridItem2($data); ?>
			<?php echo $this->gridItem3($data); ?>
			<?php echo $this->gridItem4($data); ?>		  	
		</div>


<?php
	require APPROOT . '/ui/inc/footer.php';
?>
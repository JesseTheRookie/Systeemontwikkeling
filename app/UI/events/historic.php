<?php
    require APPROOT . '/ui/inc/header.php';
?>
<?php
    require APPROOT . '/ui/inc/navigation.php';
?>

			<br><br><br><br>

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
		  	<div class="contentItem">
		  		<h2 class="gridHeaders">
	    			Take the Tour!
	    		</h2>

	    		<p class="contentText">
	    			This enthralling tour through the old city of Haarlem will take you to 9 unique venues and included a 15-minute break with refreshments at the Jopenkerk!
	    		</p>

	    		<br>

	    		<a href="ticketpagina" class="button">
	    			BOOK NOW
	    		</a>
		  	</div>

		  	<div class="contentItem">
		  		<img class="img" src="../img/vleeshal.jpg">
		  	</div>

		  	<div class="contentItem">
		  		<img class="img" src="../img/molen.jpg">
		  	</div>

		  	<div class="contentItem">
		  		<h2 class="gridHeaders">
	    			Discover the Venues!
	    		</h2>

	    		<p class="contentText">
	    			Old churches, a windmill with a touching story, an former church with a brewery inside, one of the last remaining parts of the old city wall and more!
	    		</p>

	    		<br>

	    		<a href="<?php echo URLROOT; ?>/venues" class="button">
	    			LEARN MORE
	    		</a>

		  	</div>
		</div>


<?php
	require APPROOT . '/ui/inc/footer.php';
?>
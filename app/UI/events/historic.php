<?php
    require APPROOT . '/ui/inc/header.php';
?>
<?php
    require APPROOT . '/ui/inc/navigation.php';
?>

<html> 

	<head> 

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>
			Historic
		</title>

		<link href="reset.css" rel="stylesheet">

		<style type="text/css">

			* 
			{
				margin: 0;
				padding: 0;
				border: 0;
				border-collapse: collapse;
				border-spacing: 0;
			}

			.headerGrid
			{
  				display: grid;
  				grid-template-columns: auto auto auto;
			  	padding: 1em;
			  	grid-template-columns: repeat(3, 1fr);
			}

			.headerItem
			{
  				text-align: center;
				vertical-align: bottom;
			}

			#historicHeader 
			{
				text-align: center;
				font-weight: bold;
				font-size: 3em;

			}

			#breadcrumbs 
			{
				padding: 1em;
			}

			.crumb
			{
				text-decoration: none;
				color: inherit;
				margin: auto;
			}

			.contentGrid
			{
				display: grid;
			  	grid-template-columns: auto auto;
				background-color: #f7f7f7;
				padding: 0px;
			}

			.contentItem
			{
			  	border: 0;
			  	padding: 0px;
			  	font-size: 2em;
			  	text-align: center;
			}

			.gridHeaders 
			{
				font-size: 1.2em;
				padding: 0.5em;
				margin-top: 1em;
			}

			.contentText
			{
				margin: auto;
				width: 60%;
				font-size: 0.75em;
			}

			.button
			{
				background-color: red;
				border-radius: 2px;
				padding: 0.4em;
				text-decoration: none;
				color: inherit;
				font-size: 0.75em;
			}

		</style>

	</head>

	<body> 

			<br><br><br>

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

	    		<a href="ticketpagina" class="button">
	    			LEARN MORE
	    		</a>

		  	</div>
		</div>
	</body>
</html>
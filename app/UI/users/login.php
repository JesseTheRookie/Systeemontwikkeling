
		<title> 
			<?php echo $data['title']; ?>
		</title>

		<link rel="stylesheet" type="text/css" href="style.css"> <!--algemeen stylesheet-->

		<style> 

			#content 
			{
				margin: auto;
				width: 50%;
			}

			#loginHeader 
			{
				text-align: center;	
			}

			#line 
			{
				margin: auto;
				height: 1em; 
				width: 60px;
				display: block;		
			}

			.input	
			{
			    display: block;
			    margin: auto;
			    width: 30em; 
			    height: 2em;
			    border: 1px solid #818181;
			    padding: 5px;
			}

			#submit 
			{
				display: block;
			    margin: auto;
				height: 3em;
				background-color: #000000;
				text-align: center;
				color: white;
				width: 31em;
				border: none;
			}

			.options 
			{
				text-align: center;
			}

			.success
			{
				background: light green;
				border; 1px solid green;
			}

			.invalidFeedback 
			{
				color: red;
				font-weight: normal;				
			}

		</style>


	<?php
    require APPROOT . '/UI/inc/header.php';
	?>
	<?php
		require APPROOT . '/UI/inc/navigation.php';
	?>
		<br><br><br>		<br><br><br>
		<div id="content">

			<?php flash('registerSuccess'); ?>

			<h1 class="center" id="loginHeader">
				Login
			</h1>

			<svg id="line">
				<line class="line" x1="0" y1="0" x2="60" y2="0" style="stroke:rgb(0,0,0);stroke-width:2" />
				Sorry, your browser does not support inline SVG.
			</svg>

			<br>

			<form action="login" id="inlog" method="POST">
				<input class="input" type="email" name="email" placeholder="Email" <?php echo (!empty($data['emailError'])) ? 'is-invalid' : ''; ?> value="<?php echo $data['email']; ?>"> <br>
				<span class="invalidFeedback"><?php echo $data['emailError'] ?></span>
				<input class="input" type="password" name="password" placeholder="Password" <?php echo (!empty($data['passwordError'])) ? 'is-invalid' : ''; ?> value="<?php echo $data['password']; ?>"> <br>
				<span class="invalidFeedback"><?php echo $data['passwordError'] ?></span>
				<input id="submit" type="submit" value="SUBMIT">
			</form>

			<p class="options">
				Not registered yet? <a href="<?php echo URLROOT; ?>/users/register" >Create an account </a> <br>
				<a href="<?php echo URLROOT; ?>/users/forgot">Forgot password?</a>
			</p>			
	
		</div>
		<?php
		    require APPROOT . '/ui/inc/footer.php';
		?>

		<title> 
			Register
		</title>

		<link rel="stylesheet" type="text/css" href="style.css"> <!--algemeen stylesheet-->

		<style> 

			#content 
			{
				margin: auto;
				width: 60%;
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

			#register 
			{
				width: 60%;
				margin: auto;
			}

			.input 
			{
				border: 0px;
			}

			.options 
			{
				text-align: center;
			}

			.cleanForm {
			    width: 60%;
			    margin: auto;
			}

			.inputHeader 
			{
				font-weight: bold;
			}

			fieldset 
			{
			    border: 0;
			    margin: auto;
			    width: 58%;
			    padding: 3em;
			}

			fieldset > label > input {
			    display: block;
			}

			input[type="checkbox"] {
			    display: inline;
			}

			label {
			    margin: 10px;
			    padding: 0px;
			}

			fieldset > label {
			    float: left;
			}

			label:nth-child(2n+1) {
			    clear: both;
			}

			#gender, .tos, button {
			    clear: both;
			}

			.tos {
			    width: 400px;
			}

			#submit 
			{
				display: block;
			    margin: auto;
				height: 3em;
				background-color: #000000;
				text-align: center;
				color: white;
				width: 15em;
				border: none;
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
			<h1 class="center" id="loginHeader">
				Register
			</h1>

			<svg id="line">
				<line class="line" x1="0" y1="0" x2="60" y2="0" style="stroke:rgb(0,0,0);stroke-width:2" />
				Sorry, your browser does not support inline SVG.
			</svg>

			<br>

			<form action="register" class="cleanForm" method="POST">
			    <fieldset id="input">
			    	<div id="gender">
			    		<label class="inputHeader">
			    			Gender *
			    		</label> <br><br>

			            <label>
			            	<input type="radio" name="gender" value="male" checked>
			            	Male
			            </label>

			            <label>
			            	<input type="radio" name="gender" value="female">
			            	Female
			        	</label>
			        </div> <br>

			        <label class="inputHeader">
			        	First name *
			        	<input type="text" name="name" <?php echo (!empty($data['nameError'])) ? 'is-invalid' : ''; ?> value="">
						<span class="invalidFeedback"> <?php echo $data['nameError'] ?> </span>
			        </label>

			        <label class="inputHeader">
			        	Last name *
			        	<input type="text" name="lastName" <?php echo (!empty($data['lastNameError'])) ? 'is-invalid' : ''; ?> value="">
			        	<span class="invalidFeedback"><?php echo $data['lastNameError'] ?></span>
					</label>

			        <label class="inputHeader">
			        	E-email *
			        	<input type="email" name="email" <?php echo (!empty($data['emailError'])) ? 'is-invalid' : ''; ?> value="">
						<span class="invalidFeedback"><?php echo $data['emailError'] ?></span>
			        </label>

			        <label class="inputHeader">
			        	Phone number *
			        	<input type="text" name="phone" <?php echo (!empty($data['phoneError'])) ? 'is-invalid' : ''; ?> value="">
						<span class="invalidFeedback"><?php echo $data['phoneError'] ?></span>
			        </label>

			        <label class="inputHeader">
			        	Street *
			        	<input class="streetInput" type="text" name="street" <?php echo (!empty($data['streetError'])) ? 'is-invalid' : ''; ?> value="">
			        	<span class="invalidFeedback"><?php echo $data['streetError'] ?></span>
					</label>

			        <label class="inputHeader">
			        	House Number *
			        	<input id="houseInput" type="number" name="house" <?php echo (!empty($data['houseError'])) ? 'is-invalid' : ''; ?> value="">
			        	<span class="invalidFeedback"><?php echo $data['houseError'] ?></span>
					</label>

			        <label class="inputHeader"> 
			        	Password *
			        	<input type="password" name="password" <?php echo (!empty($data['passwordError'])) ? 'is-invalid' : ''; ?> value="">
			        	<span class="invalidFeedback"><?php echo $data['passwordError'] ?></span>
					</label>

			        <label class="inputHeader">
			        	Confirm password *
			        	<input type="password" name="passwordConfirm" <?php echo (!empty($data['passwordConfirmError'])) ? 'is-invalid' : ''; ?> value="">
						<span class="invalidFeedback"><?php echo $data['passwordConfirmError'] ?></span>
					</label>

			        <label>
			        	* required
			        </label>

			    </fieldset>

			    <br>

			    <input id="submit" type="submit" value="Register">
			</form>			
		</div>
</div>
<?php
    require APPROOT . '/ui/inc/footer.php';
?>
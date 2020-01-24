<?php
	require APPROOT . '/UI/inc/header.php';
?>

<?php
	require APPROOT . '/UI/inc/navigation.php';
?>

<section id="content">
	<h1 class="center" id="loginHeader">
		Login
	</h1>

	<hr>

	<form
		action="login"
		id="inlog"
		method="POST">

		<input
			class="input"
			type="email"
			name="email"
			placeholder="Email"
			<?php echo (!empty($data['emailError'])) ? 'is-invalid' : ''; ?>
		>

		<span
			class="invalidFeedback">
			<?php echo $data['emailError'] ?>
		</span>

		<input
			class="input"
			type="password"
			name="password"
			placeholder="Password"
			<?php echo (!empty($data['passwordError'])) ? 'is-invalid' : ''; ?>
		>

		<span
			class="invalidFeedback">
			<?php echo $data['passwordError']; ?>
		</span>

		<input
			id="submit"
			type="submit"
			value="SUBMIT"
		>
		</form>

		<p class="options">
			Not registered yet?
				<a href="<?php echo URLROOT; ?>/users/register" >
					Create an account!
				</a>
		</p>

		<p class="options">
				<a href="<?php echo URLROOT; ?>/users/forgot">
					Forgot password?
				</a>
		</p>
	</section>

<?php
	require APPROOT . '/ui/inc/footer.php';
?>

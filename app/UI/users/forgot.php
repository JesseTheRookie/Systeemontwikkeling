<?php
    require APPROOT . '/UI/inc/header.php';
?>

<?php
    require APPROOT . '/UI/inc/navigation.php';
?> 
    <br><br><br><br><br><br>

    <h1 id="formHeader"><?php echo $data['title'] ?></h1>
    <p id="formTutorial">Enter your account's email address and a link to create a new password will be send to you</p>

    <form id="forgotForm" action="forgot" method="POST">
        <input type="email" name="email" placeholder="Email" <?php echo (!empty($data['emailError'])) ? 'is-invalid' : ''; ?>>
        <span class="invalidFeedback"><?php echo $data['emailError'] ?></span>
        <input id="send" type="submit" value="send">
    </form>
    
    <br><br><br><br>

<?php
    require APPROOT . '/ui/inc/footer.php';
?>
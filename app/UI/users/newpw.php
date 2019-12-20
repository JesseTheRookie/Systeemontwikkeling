<?php
    require APPROOT . '/UI/inc/header.php';
?>

<?php
    require APPROOT . '/UI/inc/navigation.php';
?> 
    <br><br><br><br><br><br>

    <h1 id="formHeader"><?php echo $data['title'] ?></h1>

    <form id="forgotForm" action="newpw" method="POST">
        <input type="password" name="password" placeholder="Type new password here">
        <input type="password" name="passwordConfirmation" placeholder="Retype your new password here">
        <input id="send" type="submit" value="submit">
    </form>

<?php
    require APPROOT . '/ui/inc/footer.php';
?>
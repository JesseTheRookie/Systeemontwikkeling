<?php
    require APPROOT . '/UI/inc/header.php';
?>

<?php
    require APPROOT . '/UI/inc/navigation.php';
?> 
    <section id="newPassword">
        <h1 id="formHeader"><?php echo $data['title'] ?></h1>
        <?php        
            echo $this->checkToken($data['token']);
        ?>
        <span class="invalidFeedback"><?php echo $data['error'] ?></span>
    </section>

<?php
    require APPROOT . '/ui/inc/footer.php';
?>
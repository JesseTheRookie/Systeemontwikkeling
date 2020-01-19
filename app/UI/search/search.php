<?php
    require APPROOT . '/ui/inc/header.php';
?>
<?php
    require APPROOT . '/ui/inc/navigation.php';
?>

    <section id="content">
        <h1 id="formHeader"><?php echo $data['title'] ?></h1>
        <form class="cleanForm" action="search" method="POST">
            <input type="text" name="searchValue">
            <input type="submit" value="search"> 
            <span class="invalidFeedback"><?php echo $data['error'] ?></span>
        </form>
        <?php 
            foreach((array)$data['result'] as $result){
               var_dump($result);
            }
        
        ?>
    </section>

<?php
	require APPROOT . '/ui/inc/footer.php';
?>
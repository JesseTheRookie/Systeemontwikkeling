<!DOCTYPE html>

<html data-wf-page="5dd41b797030aa6e3b82fe70" data-wf-site="5dd41b797030aa19e682fe6f">

</html>

<head>
  <meta charset="utf-8">
  <title>Project</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="<?php echo URLROOT; ?>/css/EditContentStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header class="header">
  <form class="dropdown" action="<?php echo URLROOT; ?>/Cms/LogoutUser" method="GET">
    <input type="submit" value="Logout" class="logoutlink"></input>
  </form>
  </header>

  <nav class="nav">
    <div class="usercontainer">
      <img src="<?php echo URLROOT; ?>/img/adminuserimg/userIcon.png" width="125" alt="" class="image">
      <div class="nameAndFunction"><?php echo $data['UserName'] . ' ' . $data['UserLastName'] . ' - ' . $data['UserType']; ?></div>
    </div>
    <ul class="list list-2 w-list-unstyled">
      <li class="list-item"><a href="<?php echo URLROOT; ?>/cms/dashboard" class="link">Dashboard</a></li>
      <li class="list-item"><a href="<?php echo URLROOT; ?>/cms/createuser" class="link">Register User</a></li>
      <li class="list-item"><a href="<?php echo URLROOT; ?>/cms/editcontent" class="link">Edit Content</a></li>
      <li class="list-item"><a href="<?php echo URLROOT; ?>/cms/changeprogram" class="link">Change Program</a></li>
    </ul>
  </nav>

  <div class="section">

    <h1 id="title"><u><?php echo $data['title']; ?></u></h1>
    <h3 id="description"><?php echo $data['explanation'] ?></h3>

    <div class="dropdowns">    
      <form class="dropdown" action="<?php echo URLROOT; ?>/Cms/editcontent" method="GET">
        <select id="event" name="event" data-name="event">
        <?php
          foreach($data['Events'] as $event)
          {
            echo '<option value=' . $event . '>' . $event . '</option>';
          }
        ?>  
        </select><input type="submit" value="Search" id="submitbutton"></form>

        <a id="previewlink" href="<?php echo URLROOT . '/' . $data['ContentEvent'] . '/index'; ?>" class="link" target="_blank"><?php echo "Preview " . $data['ContentEvent'] . " Page"; ?></a>
    </div>
    
    <?php
      require APPROOT . '/UI/CMS/ContentEvents/content' . $data['ContentEvent'] . '.php';
    ?>

</body>

</html>

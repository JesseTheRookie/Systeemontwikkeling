<!DOCTYPE html>

<html data-wf-page="5dd41b797030aa6e3b82fe70" data-wf-site="5dd41b797030aa19e682fe6f">

</html>

<head>
  <meta charset="utf-8">
  <title>Project</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="<?php echo URLROOT; ?>/css/ChangeProgramStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header class="header">
  <a class="logoutlink" href="<?php echo URLROOT; ?>/users/logout" class="link">Logout</a>
  </header>

  <nav class="nav">
    <div class="usercontainer w-container"><img src="images/icon.svg" width="100" alt="" class="image">
      <div class="nameAndFunction">Jelle Spreij - Admin</div>
    </div>
    <ul class="list list-2 w-list-unstyled">
      <li class="list-item"><a href="<?php echo URLROOT; ?>/cms/dashboard" class="link">Dashboard</a></li>
      <li class="list-item"><a href="<?php echo URLROOT; ?>/cms/editcontent" class="link">Edit Content</a></li>
      <li class="list-item"><a href="<?php echo URLROOT; ?>/cms/changeprogram" class="link">Change Program</a></li>
    </ul>
  </nav>

  <div class="section">

    <h1><u><?php echo $data['title'] ?></u></h1>
    <h3><?php echo $data['explanation'] ?></h3>

    <div class="tableblock">
      <div class="tableandfields">
        <div class="table">

        </div>
        <div class="textfields">
          <form action="/action_page.php">
          <span class="starttimetext">tekst1</span>
          <input type="text" name="starttime" value="" class="textfield" id="starttimefield">
          <span class="locationtext">tekst2</span>
          <input type="text" name="location" value="" class="textfield" id="locationfield">
          <span class="halltext">tekst3</span>
          <input type="text" name="hall" value="" class="textfield" id="hallfield">
          <span class="bandtext">tekst4</span>
          <input type="text" name="band" value="" class="textfield" id="bandfield">  
          <span class="extratext">tekst5</span>
          <input type="text" name="extra" value="" class="textfield" id="extrafield">        
          <input type="submit" value="Submit">
          </form>
        </div>
        
      </div>
    </div>
  </div>
</body>

</html>

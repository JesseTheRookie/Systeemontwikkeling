<!DOCTYPE html>

<html data-wf-page="5dd41b797030aa6e3b82fe70" data-wf-site="5dd41b797030aa19e682fe6f">

</html>

<head>
  <meta charset="utf-8">
  <title>Project</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="<?php echo URLROOT; ?>/css/CreateUserStyle.css" rel="stylesheet" type="text/css">
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
    <h1><u><?php echo $data['title'] ?></u></h1>
    <h3 id="explanation"><?php echo $data['explanation'] ?></h3>
    <div class="tableblock">  
        <div class="tableandfields">
            <form id="createuser" action="<?php echo URLROOT; ?>/Cms/createuser" method="POST">
                <h3 id="genderText" class="textfieldText">Gender</h3>
                <select class="dropdowns" name="gender">
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                </select>
                <h3 class="textfieldText">First name</h3>
                <input class="input" type="text" value="" name="firstname">
                <h3 class="textfieldText">Last Name</h3>
                <input class="input" type="text" value="" name="lastname">
                <h3 class="textfieldText">E-mail</h3>
                <input class="input" type="email" value="" name="email">
                <h3 class="textfieldText">Phone Number</h3>
                <input class="input" type="text" value="" name="phonenumber">
                <h3 class="textfieldText">Street</h3>
                <input class="input" type="text" value="" name="street">
                <h3 class="textfieldText">House Number</h3>
                <input class="input" type="text" value="" name="housenumber">
                <h3 class="textfieldText">Password</h3>
                <input class="input" type="password" value="" name="password">
                <h3 class="textfieldText">Confirm Password</h3>
                <input class="input" type="password" value="" name="confirmpassword">
                <h3 class="textfieldText">User Type</h3>
                <select class="dropdowns" name="type">
                <?php
                    foreach($data['UserTypes'] as $key => $type)
                    {
                        echo '<option value=' . $key . '>' . $type . '</option>';
                    }
                ?>  
                </select>
                <input id="submitbutton" type="submit" value="Submit">
                <h3 id="statusmessage"><?php echo $data['StatusMessage']; ?></h3>
            </form>
        </div>
    </div>
  </div>
 </body>
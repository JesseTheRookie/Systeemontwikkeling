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
  <div class="usercontainer">
      <img src="<?php echo URLROOT; ?>/img/adminuserimg/userIcon.png" width="125" alt="" class="image">
      <div class="nameAndFunction"><?php echo $data['UserName'] . ' ' . $data['UserLastName'] . ' - ' . $data['UserType']; ?></div>
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
        <form id="dropdowns" action="<?php echo URLROOT; ?>/Cms/changeprogram" method="GET">
            <select id="Day" name="day" data-name="day">
              <?php
                foreach($data['Dates'] as $date)
                {
                echo '<option value=' . $date->date . '>' . DateTime::createFromFormat('Y-m-d', $date->date)->format('d-m-Y') . '</option>';
                }
              ?>
            </select>
            <select id="event" name="event" data-name="event">
              <?php
                foreach($data['Events'] as $event)
                {
                echo '<option value=' . $event->event . '>' . $event->event . '</option>';
                }
              ?>  
            </select><input type="submit" value="Search" id="submitbutton"></form>
        <table border="1px">
        <?php
          echo "<tr>";
            echo "<th></th>";
            foreach($data['TableColumns'] as $column)
            {
              echo '<th>' . $column . '</th>';  
            }
            echo "<th>Extra</th>";
          echo "</tr>";
        ?>
          <form action="<?php echo URLROOT; ?>/Cms/changeprogram" method="POST">
          <?php
            foreach ($data['TableResult'] as $program)
            {
              echo "<tr>";  
              echo '<td>
                      <div class="radio">
                        <label>
                          <input type="radio" name="radio" value=' . $program->id . '>
                        </label>
                      </div>
                    </td>';
                foreach($data['TableColumns'] as $column)
                {
                  echo '<td>' . $program->$column . '</td>';
                }
              echo '<td>' . $data['extra'] . '</td>';
              echo "</tr>";
            }
          ?>
        </table>
        </div>
        <div class="textfields">
          <?php
            $number = 1;

            foreach($data['TableColumns'] as $column)
            {       
              echo '<span class= text' . $number . '>' . $column . '</span>';
              echo '<input type="text" name=' . $column . ' value="" class="textfield" id= field' . $number . '>';
              $number++;
            }
          ?> 
          <span class="textextra">Extra</span>
          <input type="text" name="extra" value="" class="textfield" id="fieldextra">        
          <input class="submitbutton" type="submit" value="Submit">
          </form>
        </div>
        
      </div>
    </div>
  </div>
</body>

</html>

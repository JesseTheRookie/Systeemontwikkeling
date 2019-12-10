<?php

  if(!isset($_SESSION)) 
  { 
    session_start(); 
  } 

?>

<!DOCTYPE html>

<html data-wf-page="5dd41b797030aa6e3b82fe70" data-wf-site="5dd41b797030aa19e682fe6f">

</html>

<head>
  <meta charset="utf-8">
  <title>Project</title>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="<?php echo URLROOT; ?>/css/DashboardStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header class="header">
    <a class="logoutlink" href="<?php echo URLROOT; ?>/users/logout" class="link">Logout</a>
  </header>

  <nav class="nav">
    <div class="usercontainer w-container"><img src="images/icon.svg" width="100" alt="" class="image">
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
    <div class="datablocks">
      <div class="revenue">
        <h1 class="importantdata"><?php echo $data['TotalRev']; ?></h1>
        <h1 class="importantdata">Revenue</h1>
      </div>
      <div class="reservations">
        <h1 class="importantdata"><?php echo $data['TotalReservations']; ?></h1>
        <h1 class="importantdata">Reservations</h1>
      </div>
      <div class="tickets">
        <h1 class="importantdata"><?php echo $data['TotalTicketSold']; ?></h1>
        <h1 class="importantdata">Tickets sold</h1>
      </div>
      <div class="other">
        <h1 class="importantdata"><?php echo $data['TotalUsers']; ?></h1>
        <h1 class="importantdata">Total users</h1>
      </div>
    </div>
    <div class="generatedblocks">
      <div class="graph">
      <!-- <img src="images/line_graph.png" alt=""> -->
        <h1 class="weekly">Weekly sales: 0</h1>
        <h1 class="monthly">Monthly sales: 0</h1>
        <h1 class="trend">Trend: =</h1>
      </div>
      <div class="circlediagram"></div>
    </div>
    <div class="tableblock">
        <div class="table">
          <form id="dropdowns" action="<?php echo URLROOT; ?>/Cms/dashboard" method="POST" role="form"><select
              id="Day" name="Day" data-name="Day" class="select-field w-select">
              <option value="day1">Day 1</option>
              <option value="day2">Day 2</option>
              <option value="day3">Day 3</option>
              <option value="day4">Day 4</option>
            </select><select id="event" name="event" data-name="event" class="select-field-2 w-select">
              <option value="dance">Dance</option>
              <option value="jazz">Jazz</option>
              <option value="historic">Historic</option>
              <option value="food">Food</option>
            </select><input type="submit" value="Search" class="submit-button w-button"></form>
            <table border="1px">
          <tr>
            <th>Venue</th>
            <th>Tickets sold</th>
            <th>Reservations</th>
            <th>Tickets available</th>
          </tr>
          <?php
          foreach ($data['tableResult'] as $activity)
          {
              echo "<tr>";  
              echo '"<td>"' . $activity['locationorlanguage'] . '"</td>"';
              echo '"<td>"' . $activity['ticketssold'] . '"</td>"';
              echo '"<td>"' . $activity['ticketsleft'] . '"</td>"';
              echo "<td></td>";
              echo "<tr>";
          }
          ?>
        </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

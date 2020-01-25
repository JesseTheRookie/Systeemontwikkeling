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
    <div class="datablocks">
      <div class="revenue">
        <h1 class="importantdata"><?php echo "\xE2\x82\xAc " . $data['TotalRev']; ?></h1>
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
          <form id="dropdowns" action="<?php echo URLROOT; ?>/Cms/dashboard" method="POST">
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
            <h2 id="dateeventtekst"><?php echo ucfirst($data['SelectedEvent']) . ' - ' . DateTime::createFromFormat('Y-m-d', $data['SelectedDate'])->format('D d-m-Y'); ?></h2>
            <table border="1px">
          <tr>
            <th></th>
            <th>Session</th>
            <th>Tickets sold</th>
            <th>Reservations</th>
            <th>Tickets available</th>
          </tr>
          <?php
          foreach ($data['TableResult'] as $activity)
          {
              echo "<tr>";  
              echo '<td>' . $activity->identifier . '</td>';
              echo '<td>' . $activity->identifier2 . '</td>';
              echo '<td>' . $activity->soldtickets . '</td>';
              echo '<td>' . $activity->reservedtickets . '</td>';
              echo '<td>' . $activity->ticketsleft . '</td>';
              echo "</tr>";
          }
          ?>
        </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

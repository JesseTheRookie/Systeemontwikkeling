<?php
    class Cms extends Controller
    {

      public function __construct()
      {
        $this->CmsDao = $this->dal('CmsDAO');
      }

      public function dashboard()
      {
        $data = array();

        $title = 'Dashboard';

        $totalRev = $this->CmsDao->GetTotalRev();
        $totalTicketSold = $this->CmsDao->GetTotalTicketsSold();
        $totalReservations = $this->CmsDao->GetTotalTicketsReserved();
        $totalUsers = $this->CmsDao->GetTotalUniqueUsers();

        $dates = $this->CmsDao->getDates();
        $events = $this->CmsDao->GetEvents();

        $userName = $_SESSION["userName"];
        $userLastName = $_SESSION["userLastName"];
                
        if($_SESSION["userType"] == 3)
        {
          $userType = "Super Admin";
        }
        else
        {
          $userType = "Admin";
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          $tableResult = $this->GetActivityInfo($_POST['day'], $_POST['event']);
          var_dump($tableResult);
          
          $data = [
            'title' => $title,
            'UserName' => $userName,
            'UserLastName' => $userLastName,
            'UserType' => $userType,
            'TotalRev' => $totalRev->totalrev,
            'TotalTicketSold' => $totalTicketSold->totaltickets,
            'TotalReservations' => $totalReservations->totalreserved,
            'TotalUsers' => $totalUsers->totalusers,
            'Dates' => $dates,
            'Events' => $events,
            'SelectedDate' => $_POST['day'],
            'SelectedEvent' => $_POST['event'],
            'TableResult' => $tableResult
          ];  
          
        }
        else
        {
          $tableResult = $this->GetActivityInfo($dates[0]->date, $events[0]->event);

          $data = [
            'title' => $title,
            'UserName' => $userName,
            'UserLastName' => $userLastName,
            'UserType' => $userType,
            'TotalRev' => $totalRev->totalrev,
            'TotalTicketSold' => $totalTicketSold->totaltickets,
            'TotalReservations' =>  $totalReservations->totalreserved,
            'TotalUsers' => $totalUsers->totalusers,
            'Dates' => $dates,
            'Events' => $events,
            'SelectedDate' => $dates[0]->date,
            'SelectedEvent' => $events[0]->event,
            'TableResult' => $tableResult
          ];  
        }
        $this->ui('cms/dashboard', $data);
      }

      public function editcontent()
      {
        $data = array();

        $title = "Edit content";
        $explanation = "Click the checkbox next to the row you wish to change";

        $userName = $_SESSION["userName"];
        $userLastName = $_SESSION["userLastName"];
                
        if($_SESSION["userType"] == 3)
        {
          $userType = "Super Admin";
        }
        else
        {
          $userType = "Admin";
        }

        $data = [
          'title' => $title,
          'explanation' => $explanation,
          'UserName' => $userName,
          'UserLastName' => $userLastName,
          'UserType' => $userType
        ];
        
        $this->ui('cms/editcontent', $data);
      }

      public function changeprogram()
      {
        $data = array();

        $errorInput = '';

        $title = "Change program";
        $explanation = "Click the checkbox next to the row you wish to change";

        $dates = $this->CmsDao->getDates();
        $events = $this->CmsDao->GetEvents();

        $userName = $_SESSION["userName"];
        $userLastName = $_SESSION["userLastName"];
                
        if($_SESSION["userType"] == 3)
        {
          $userType = "Super Admin";
        }
        else
        {
          $userType = "Admin";
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
          $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
          
          if(isset($_GET['day']))
          {
            $returnArray = $this->GetProgramInfo($_GET['day'], $_GET['event']);
            $_SESSION['day'] = $_GET['day'];
            $_SESSION['event'] = $_GET['event'];
          }
          else
          {
            $returnArray = $this->GetProgramInfo($dates[0]->date, $events[0]->event);
            $_SESSION['day'] = $dates[0]->date;
            $_SESSION['event'] = $events[0]->event;
          }

          $tableResult = $returnArray[0];
          $TableColumns = $returnArray[1];

          $data = [
            'title' => $title,
            'explanation' => $explanation,
            'UserName' => $userName,
            'UserLastName' => $userLastName,
            'UserType' => $userType,
            'Starttime' => '',
            'Identifier' => '',
            'Identifier2' => '',
            'Performer' => '',
            'extra' => '',
            'Dates' => $dates,
            'Events' => $events,
            'TableColumns' => $TableColumns,
            'TableResult' => $tableResult
          ];
      
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          $returnArray = $this->GetProgramInfo($_SESSION['day'], $_SESSION['event']);
          $updateFields = [];

          $tableResult = $returnArray[0];
          $TableColumns = $returnArray[1];

          $data = [
            'title' => $title,
            'explanation' => $explanation,
            'UserName' => $userName,
            'UserLastName' => $userLastName,
            'UserType' => $userType,
            'Starttime' => '',
            'Identifier' => '',
            'Identifier2' => '',
            'Performer' => '',
            'extra' => '',
            'Dates' => $dates,
            'Events' => $events,
            'ErrorInput' => $errorInput,
            'TableColumns' => $TableColumns,
            'TableResult' => $tableResult
          ];

          if(!empty($_POST['radio']))
          {
            $id = trim($_POST['radio']);
            $rowInt = array_search($id, array_column($tableResult, 'id'));
          
            for($i = 0; $i < count($TableColumns); $i++)
            {
              $column = $TableColumns[$i];

              if($column == "Time")
              {
                if(!empty(trim($_POST[$column])))
                {
                 array_push($updateFields, $_SESSION['day'] . " " . trim($_POST[$column]));
                }
                else 
                {
                  array_push($updateFields, $_SESSION['day'] . " " . $tableResult[$rowInt]->Time);
                }
              }
              else
              {
                if(!empty(trim($_POST[$column])))
                {
                 array_push($updateFields, trim($_POST[$column]));
                }
                else 
                {
                  array_push($updateFields, $tableResult[$rowInt]->$column);
                }
              }
            }
          
            $this->UpdateProgram($_SESSION['event'], $id, $updateFields);
            $returnArray = $this->GetProgramInfo($_SESSION['day'], $_SESSION['event']);
            $data['TableResult'] = $returnArray[0];
          }
          else
          {
          $data['ErrorInput'] = 'No row selected!';
          $this->ui('cms/changeprogram', $data);
          }
        }
                
        $this->ui('cms/changeprogram', $data);
      }

      public function GetActivityInfo($date, $event)
      {
        $result = array();

        switch ($event)
        {
          case "dance":
            $result = $this->CmsDao->GetDanceActivityInfo($date);
            break;
          case "jazz":
            $result = $this->CmsDao->GetJazzActivityInfo($date);
            break;
          case "food":
            $result = $this->CmsDao->GetHistoricActivityInfo($date);
            break;
          case "historic":
            $result = $this->CmsDao->GetFoodActivityInfo($date);
            break;
          case "kids":
            $result = $this->CmsDao->GetFoodActivityInfo($date);
            break;
          default:
            $result = $this->CmsDao->GetDanceActivityInfo($date);
        }

        return $result;
      }

      public function GetProgramInfo($date, $event)
      {
        $result = array();
        $TableColumns;

        switch ($event)
        {
        case "dance":
          $result = $this->CmsDao->GetDanceProgramInfo($date);
          $TableColumns = ['Time', 'Venue', 'Session', 'Performer'];
          break;
        case "jazz":
          $result = $this->CmsDao->GetJazzProgramInfo($date);
          $TableColumns = ['Time', 'Venue', 'Hall', 'Band'];
          break;
        case "food":
          $result = $this->CmsDao->GetFoodProgramInfo($date);
          $TableColumns = ['Time', 'Restaurant', 'Served', 'Stars'];
          break;
        case "historic":
          $result = $this->CmsDao->GetHistoricProgramInfo($date);
          break;
        case "kids":
          $result = $this->CmsDao->GetKidsProgramInfo($date);
          $TableColumns = ['Time', 'Venue', 'Session', 'Performer'];
          break;
        }

        return $array = [$result, $TableColumns];
      }

      public function UpdateProgram($event, $id, $columns)
      {
        switch ($event)
        {
          case "dance":
            $this->CmsDao->UpdateDanceProgram($event, $id, $columns);
            break;
          case "jazz":
            $this->CmsDao->UpdateJazzProgram($event, $id, $columns);
            break;
          case "food":
            $this->CmsDao->UpdateFoodProgram($event, $id, $columns);
            break;
          case "historic":
            $this->CmsDao->UpdateHistoricProgram($event, $id, $columns);
            break;
          case "kids":
            $this->CmsDao->UpdateKidsProgram($event, $id, $columns);
            break;
        }
      }

    }
?>

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
        $totalReservations = 3;
        $totalUsers = $this->CmsDao->GetTotalUniqueUsers();

        $userName = "";
        $userLastName = "";
                
        if($_SESSION["userType"] == 2)
        {
          $userType = "Super Admin";
        }
        else
        {
          $userType = "Admin";
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
          //var_dump($_POST['Day']);
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          $tableResult = $this->CmsDao->GetActivityInfo($_POST['Day'], $_POST['event']);
          //var_dump($tableResult);

          $data = [
            'title' => $title,
            'UserName' => $userName,
            'UserLastName' => $userLastName,
            'UserType' => $userType,
            'TotalRev' => $totalRev->totalrev,
            'TotalTicketSold' => $totalTicketSold->totaltickets,
            'TotalReservations' => $totalReservations,
            'TotalUsers' => $totalUsers->totalusers
            //'TableResult' => $tableResult;
          ];  
          
        }
        else
        {
          $data = [
            'title' => $title,
            'UserName' => $userName,
            'UserLastName' => $userLastName,
            'UserType' => $userType,
            'TotalRev' => $totalRev->totalrev,
            'TotalTicketSold' => $totalTicketSold->totaltickets,
            'TotalReservations' => $totalReservations,
            'TotalUsers' => $totalUsers->totalusers,
            //'TableResult' => $tableResult;
          ];  
        }
        $this->ui('cms/dashboard', $data);
      }

      public function changeprogram()
      {
        $data = array();

        $title = "Change program";
        $explanation = "Click the checkbox next to the row you wish to edit";

        $data = [
          'title' => $title,
          'explanation' => $explanation,
          'UserName' => $userName,
          'UserLastName' => $userLastName,
          'UserType' => $userType
        ];
        
        $this->ui('cms/changeprogram', $data);
      }

      public function editcontent()
      {
        $data = array();

        $title = "Edit content";

        $data = [
          'title' => $title
        ];
        
        $this->ui('cms/editcontent', $data);
      }

    }
?>

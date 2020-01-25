<?php
    class Cms extends Controller
    {

      public function __construct()
      {
        $this->CmsDao = $this->dal('CmsDAO');
      }

      //Dashboard page
      public function dashboard()
      {
        $data = array();

        $title = 'Dashboard';

        //haal data op uit model
        $totalRev = $this->CmsDao->GetTotalRev();
        $totalTicketSold = $this->CmsDao->GetTotalTicketsSold();
        $totalReservations = $this->CmsDao->GetTotalTicketsReserved();
        $totalUsers = $this->CmsDao->GetTotalUniqueUsers();

        $dates = $this->CmsDao->getDates();
        $events = $this->CmsDao->GetEvents();

        //haal naam en functie gebruiker uit session
        $userName = $_SESSION["userName"];
        $userLastName = $_SESSION["userLastName"];
        
        //checkt functie van gebruiker
        $userType = $this->CheckUserType();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          //haal data uit db per dag en event als op een knop gedrukt wordt
          $tableResult = $this->GetActivityInfo($_POST['day'], $_POST['event']);
          
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
          //eerste keer, haal data van eerste event en eerste dag
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

      //verschillende functies per event in de model
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
            $result = $this->CmsDao->GetFoodActivityInfo($date);
            break;
          case "historic":
            $result = $this->CmsDao->GetHistoricActivityInfo($date);
            break;
          case "kids":
            $result = $this->CmsDao->GetKidsActivityInfo($date);
            break;
          default:
            $result = $this->CmsDao->GetDanceActivityInfo($date);
        }
        return $result;
      }

      //edit content page
      public function editcontent()
      {
        $data = array();

        $title = "Edit content";
        $explanation = "Change content and hit submit to confirm the changes";

        $userName = $_SESSION["userName"];
        $userLastName = $_SESSION["userLastName"];
        
        $userType = $this->CheckUserType();

        //haal events op en haal columns uit de array
        $events = $this->CmsDao->GetEvents();
        $events = array_column($events, 'event');

        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
          $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

          //kijkt of op een search knop gedrukt is of niet
          if(isset($_GET['event']))
          {
            $_SESSION['event'] = $_GET['event']; //zet geselecteerde event in session
            $rowInt = array_search($_GET['event'], $events); //pak key van geselecteerde event
            unset($events[$rowInt]); //haal geselcteerde event uit de array
            $events = array_values($events); //restructure array
            array_unshift($events, $_GET['event']); //zet geselecteerde event als eerste in array
          }
          else
          {
            $_SESSION['event'] = $events[0];
          }

          $data = [
            'title' => $title,
            'explanation' => $explanation,
            'UserName' => $userName,
            'UserLastName' => $userLastName,
            'UserType' => $userType,
            'Events' => $events,
            'TitelElementStatus' => "",
            'ArtistElementStatus' => "",
            'ContentEvent' => $_SESSION['event']
          ];

          $data = $this->GetContentPerEvent($data, $_SESSION['event']);
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          //zet geselecteerde event als eerste in array, maar de van de session
          $rowInt = array_search($_SESSION['event'], $events); 
          unset($events[$rowInt]);  
          $events = array_values($events);
          array_unshift($events, $_SESSION['event']); 

          $data = [
            'title' => $title,
            'explanation' => $explanation,
            'UserName' => $userName,
            'UserLastName' => $userLastName,
            'UserType' => $userType,
            'Events' => $events,
            'TitelElementStatus' => "",
            'ArtistElementStatus' => "",
            'ContentEvent' => $_SESSION['event']
          ];

          //checkt of row geselecteerd is
          if(isset($_POST['contentId']))
          {
            //haalt de geselecteerde row op uit de db
            $toUpdateRow = $this->CmsDao->GetContentSinglePerId($_POST['contentId']); 
            
            //als row een image heeft
            if($toUpdateRow->contentType = "image")
            {
              $statusMessage = "";

              //als een image is ingevuld
              if ($_FILES['content']['name'] != "")
              {
                $file = $_FILES['content'];
                $name = $_FILES['content']['name']; //Find file name
                $tmp_name = $_FILES['content']['tmp_name']; //Temp loc
                $size = $_FILES['content']['size']; //Find file size
                $error = $_FILES['content']['error']; //Find errors

                //Explode from punctuation mark
                $tempExtension = explode('.', $name);

                $fileExtension = strtolower(end($tempExtension));

                //Allowed extensions
                $isAllowed = array('jpg', 'jpeg', 'png', 'pdf');

                // 0 = no error - 1 = error
                if (in_array($fileExtension, $isAllowed)) {
                    if ($error === 0) {
                        if ($size < 100000) {
                            $newFileName = uniqid('', true) . "." . $fileExtension; //maakt unieke file name
                            $fileDestination = "./img/" . $newFileName; //maakt path naar de file
                            $content = $fileDestination; //zet path in content var
                            move_uploaded_file($tmp_name, $fileDestination); //zet file op zijn plek
                            $statusMessage = "Succes! File uploaded";
                        } else {
                            $statusMessage = "file size is too big!";
                        }
                    } else {
                      $statusMessage = "there was an error! Try it again";
                    }
                }
                else
                {
                  $statusMessage = "your file type is not accepted";
                }
              }
              //als geen image meegegeven is
              else
              {
                $content = $toUpdateRow->content; 
              }
              $data['StatusMessage'] = $statusMessage; 
            }
            //als row geen image heeft, zet oude data in veld als post leeg is
            else if(!empty(trim($_POST['content'])))
            {
              $content = $_POST['content'];
            }
            else
            {
              $content = $toUpdateRow->content;
            }

            if(!empty(trim($_POST['contentNaam'])))
            {
              $naam = $_POST['contentNaam'];
            }
            else 
            {
              $naam = $toUpdateRow->naam;
            }

            if(!empty(trim($_POST['contentDescription'])))
            {
              $description = $_POST['contentDescription'];
            }
            else 
            {
              $description = $toUpdateRow->description;
            }
            //update row in de db
            $this->CmsDao->UpdateContentPerId($_POST['contentId'], $naam, $description, $content);
          }
          else
          {
            $statusMessage = "No row selected";
          }
          $data = $this->StatusMessagePerElementType($_POST['contentElementType'], $statusMessage, $data); 
          $data = $this->GetContentPerEvent($data, $_SESSION['event']);
        }
        
        $this->ui('cms/editcontent', $data);
      }

      //zet status message in element
      public function StatusMessagePerElementType($elementType, $statusMessage, $data)
      {
        switch ($elementType)
        {
          case "titelElement":
            $data['TitelElementStatus'] = $statusMessage;
            break;
          case "artistElement":
            $data['ArtistElementStatus'] = $statusMessage;
            break;
        }
        return $data;
      }

      //haalt data op uit content per event en per element
      public function GetContentPerEvent($data, $event)
      {
        switch ($event)
        {
          case "dance":
            $data['PageTitel'] = $this->CmsDao->GetContentSingle($event, "titelElement");
            $data['PageArtists'] = $this->CmsDao->GetContent($event, "artistElement");
            break;
          case "jazz":
            $data['PageTitel'] = $this->CmsDao->GetContent($event, 'titelElement');
            $data['PageArtists'] = $this->CmsDao->GetContent($event, 'artistElement');
            break;
          case "food":
            $data['PageTitel'] = $this->CmsDao->GetContentSingle($event, 'titelElement');
            $data['PageRestaurants'] = $this->CmsDao->GetContent($event, 'restaurantElement');
            if(isset($_GET['restautantSelect']))
            {
              $data['PageSelectedRestaurant'] = $this->CmsDao->GetContentSinglePerId($_GET['restautantSelect']);
            }
            else 
            {
              $data['PageSelectedRestaurant'] = $this->CmsDao->GetContentSinglePerId($data['PageRestaurants'][0]->id);
            }
            break;
          case "historic":
            $data['PageHistoricImages'] = $this->CmsDao->getHistoricImages();
            $data['PageHistoricTexts'] = $this->CmsDao->getHistoricTexts();
            $data['PageLocations'] = $this->CmsDao->GetContent('venues', 'locationElement');
            if(isset($_GET['imageSelect']))
            {
              $data['PageSelectedImage'] = $this->CmsDao->GetContentSinglePerId($_GET['imageSelect']);
            }
            else 
            {
              $data['PageSelectedImage'] = $this->CmsDao->GetContentSinglePerId($data['PageHistoricImages'][0]->id);
            }
            if(isset($_GET['textSelect']))
            {
              $data['PageSelectedText'] = $this->CmsDao->GetContentSinglePerId($_GET['textSelect']);
            }
            else 
            {
              $data['PageSelectedText'] = $this->CmsDao->GetContentSinglePerId($data['PageHistoricTexts'][0]->id);
            }
            if(isset($_GET['locationSelect']))
            {
              $data['PageSelectedlocation'] = $this->CmsDao->GetContentSinglePerId($_GET['locationSelect']);
            }
            else 
            {
              $data['PageSelectedlocation'] = $this->CmsDao->GetContentSinglePerId($data['PageLocations'][0]->id);
            }
            break;
          case "kids":
            $data['PageTitel'] = $this->CmsDao->GetContentSingle($event, 'titelElement');
            $data['PageArtists'] = $this->CmsDao->GetContent($event, 'artistElement');
            break;
          default:
        }

        return $data;
      }

      //change program page
      public function changeprogram()
      {
        $data = array();

        $errorInput = '';

        $title = "Change program";
        $explanation = "Click the checkbox next to the row you wish to change";

        $userType = $this->CheckUserType();

        $dates = $this->CmsDao->getDates();
        $events = $this->CmsDao->GetEvents();

        $userName = $_SESSION["userName"];
        $userLastName = $_SESSION["userLastName"];

        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
          $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
          
          //als op knop gedrukt is
          if(isset($_GET['day']))
          {
            //haal data en columns uit de db per day en event
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

          //zet data in result en columns in columns
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
            'SelectedDate' => $_SESSION['day'],
            'SelectedEvent' => $_SESSION['event'],
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
            'SelectedDate' => $_SESSION['day'],
            'SelectedEvent' => $_SESSION['event'],
            'ErrorInput' => $errorInput,
            'TableColumns' => $TableColumns,
            'TableResult' => $tableResult
          ];

          //als een radio geselecteerd is
          if(!empty($_POST['radio']))
          {
            $id = trim($_POST['radio']);  //haal ticketId uit value van de radio button
            $rowInt = array_search($id, array_column($tableResult, 'id')); //haal row op van verkregen ticketId
          
            for($i = 0; $i < count($TableColumns); $i++)
            {
              $column = $TableColumns[$i];

              //als het de time column is, maakt er datetime van
              if($column == "Time")
              {
                if(!empty(trim($_POST[$column])))
                {
                  //zet value in de updateFields array
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
            //update row van event per ticketId
            $this->UpdateProgram($_SESSION['event'], $id, $updateFields);
            $returnArray = $this->GetProgramInfo($_SESSION['day'], $_SESSION['event']);
            $data['TableResult'] = $returnArray[0];
          }
          //als geen radio button geselecteerd is
          else
          {
          $data['ErrorInput'] = 'No row selected!';
          }
        }
         
        $this->ui('cms/changeprogram', $data);
      }

      public function GetProgramInfo($date, $event)
      {
        $result = array();
        $TableColumns;

        //haal rows en columns op per event
        switch ($event)
        {
        case "dance":
          $result = $this->CmsDao->GetDanceProgramInfo($date);
          
          //zet artistId achter ticketId, dance heeft meerdere artists per ticketId
          foreach($result as $row)
          {
            $row->id = $row->id . '|' . $row->idArtist;
          }
          
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
          $TableColumns = ['id', 'Time', 'Language'];
          break;
        case "kids":
          $result = $this->CmsDao->GetKidsProgramInfo($date);
          $TableColumns = ['Time', 'Session', 'Performer'];
          break;
        }
        //php kan maar 1 ding returnen, daarom wordt het in een array gezet
        return $array = [$result, $TableColumns];
      }

      public function UpdateProgram($event, $id, $columns)
      {
        //kijkt welk event geupdate moet worden per ticketId
        switch ($event)
        {
          case "dance":
            //haalt ticketId en artistId uit elkaar
            $result = explode("|", $id);
            $id = $result[0];
            $idArtist = $result[1];
            $this->CmsDao->UpdateDanceProgram($event, $id, $idArtist, $columns);
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

      public function createuser()
      {
        $data = array();

        $title = 'Register User';
        $explanation = 'Fill in the fields and hit submit';
        $userName = $_SESSION["userName"];
        $userLastName = $_SESSION["userLastName"];
        
        $userType = $this->CheckUserType();

        //zet user type opties in array, admin mag alleen users maken, super admin mag ook admins maken
        if($userType == "Super Admin")
        {
          $userTypes = ['1'=>'user', '2'=>'admin'];
        }
        else
        {
          $userTypes = ['1'=>'user'];
        }       

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          //validation strings
          $passwordValidation = "/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/";
          $phoneValidation = "/^[-0-9]*$/";
          
          $data = [
            'title' => $title,
            'explanation' => $explanation,
            'UserName' => $userName,
            'UserLastName' => $userLastName,
            'UserType' => $userType,
            'UserTypes' => $userTypes,
            'StatusMessage' => ''

          ];  

          //kijkt of geen row leeg is
          foreach($_POST as $field)
          {
            if(empty($field))
            {
              $data['StatusMessage'] = 'Fill out all the fields!';
              break;
            }
          }

          //kijkt of er een error is en of phonenumber overeenkomt met de validation string
          if(!preg_match($phoneValidation, $_POST['phonenumber'] AND $data['StatusMessage'] == ""))
          {
            $data['StatusMessage'] = 'Phone number has only numbers';  
          }

          //kijkt of er een error is en of password overeenkomt met de validation string
          if(!preg_match($passwordValidation, $_POST['password']) AND $data['StatusMessage'] == "")
          {
            $data['StatusMessage'] = '1 uppercase and 1 special character';
          }

          //kijkt of passwords overeenkomen en of er geen error message is
          if($_POST['password'] != $_POST['confirmpassword'] AND $data['StatusMessage'] == "")
            {
              $data['StatusMessage'] = 'Passwords dont match!';
            }

          //als er geen error is, maak user en zet in db
          if($data['StatusMessage'] == "")
          {
            //hash password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $this->CmsDao->registerAsAdmin($_POST['gender'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phonenumber'], $_POST['street'], $_POST['housenumber'], $_POST['type'], $password);
          }
        }
        else
        {
          $data = [
            'title' => $title,
            'explanation' => $explanation,
            'UserName' => $userName,
            'UserLastName' => $userLastName,
            'UserType' => $userType,
            'UserTypes' => $userTypes,
            'StatusMessage' => ''
          ];  
        }
        $this->ui('cms/createuser', $data);
      }

      //checkt userType
      public function CheckUserType()
      {
      if($_SESSION["userType"] == 3)
        {
          $userType = "Super Admin";
        }
        else
        {
          $userType = "Admin";
        }

      return $userType;
      }

      //destroyed session als op de logout knop gedrukt wordt
      public function LogoutUser()
      {
        session_destroy();
        redirect('Pages/index');
      }

    }
?>

<?php
class PersonalTimeTable Extends Controller {

    private $ticketsBoughtByUser = array();
    private $foodTickets = array();
    private $danceTickets = array();
    private $jazzTickets = array();
    private $historicTickets = array();
    private $kidsTickets = array();

    public function __construct() {
        //Sees if the session user id is there to check if you are logged in (in able to only access the page)
       if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->personalTimeTableDal = $this->dal('PersonalTimeTableDAO');
        $this->personalTimeTableModel = $this->model('PersonalTimeTableModel');
        $this->ticketsBoughtByUser = $this->personalTimeTableDal->getTicketsBoughtByUser();
        //$this->danceBll = $this->bll('Dance');
        //$this->kidsBll = $this->bll('Kids');
        $this->jazzBll = $this->bll('Jazz');
        $this->foodBll = $this->bll('Food');
        $this->historicBll = $this->bll('Historic');
        $this->setTimetableData();
    }
    public function setTimetableData(){
        foreach ($this->ticketsBoughtByUser as $ticket){
            $this->jazzTickets[] = $this->jazzBll->getJazzTicketFromTicket($ticket['ticketId'], $ticket['reserved'], $ticket['start'], $ticket['end']);
            $this->historicTickets[] = $this->historicBll->getHistoricTicketFromTicket($ticket['ticketId'], $ticket['reserved'], $ticket['start'], $ticket['end']);
            $this->foodTickets[] = $this->foodBll->getFoodTicketFromTicket($ticket['ticketId'], $ticket['reserved'], $ticket['start'], $ticket['end']);

            $this->jazzTickets = array_filter( $this->jazzTickets);
            $this->foodTickets = array_filter( $this->foodTickets);
            $this->historicTickets = array_filter( $this->historicTickets);
        }
    }
    public function getTicketByDayAndTime($day, $time){
        $this->printJazzTicketsByDayAndTime($day, $time);
        $this->printFoodTicketsByDayAndTime($day, $time);
        $this->printHistoricTicketsByDayAndTime($day, $time);
    }

    public function printJazzTicketsByDayAndTime($day, $time){
        if(!empty($this->jazzTickets)){
            foreach ($this->jazzTickets as $jazzTicket){
                $jazzTicketDayAndTime = explode(" ", $jazzTicket->getStartDateTime());
                $jazzTicketDay = $jazzTicketDayAndTime[0];
                $jazzTicketTime = $jazzTicketDayAndTime[1];

                if(($jazzTicketDay == $day) && ($jazzTicketTime == $time)){
                    $artists = "";
                    foreach($jazzTicket->getArtists() as $artist){
                        $artists .= $artist->getArtistName();
                    }
                    echo "" . $artists . " @ " . $jazzTicket->getJazzTicketLocation() . "";
                }
            }
        }
    }

    public function printHistoricTicketsByDayAndTime($day, $time){
        if(!empty($this->historicTickets)) {
            foreach ($this->historicTickets as $historicTicket) {
                $historicTicketDayAndTime = explode(" ", $historicTicket->getStartDateTime());
                $historicTicketDay = $historicTicketDayAndTime[0];
                $historicTicketTime = $historicTicketDayAndTime[1];

                if (($historicTicketDay == $day) && ($historicTicketTime == $time)) {
                    echo "Tour start @ " . $historicTicket->getHistoricTicketLocation();
                }
            }
        }
    }

    public function printFoodTicketsByDayAndTime($day, $time){
        if(!empty($this->foodTickets)) {
            foreach ($this->foodTickets as $foodTicket) {
                $foodTicketTicketDayAndTime = explode(" ", $foodTicket->getStartDateTime());
                $foodTicketTicketDay = $foodTicketTicketDayAndTime[0];
                $foodTicketTicketTime = $foodTicketTicketDayAndTime[1];

                if (($foodTicketTicketDay == $day) && ($foodTicketTicketTime == $time)) {
                    echo "Diner @ " . $foodTicket->getRestaurantName();
                }
            }
        }
    }


    public function index () {
        //$days = $this->personalTimeTableDal->getDifferentDays();
        //$tickets = $this->personalTimeTableDal->getUserTickets($id = '1');

        $data = [
            'jazzTickets' => $this->jazzTickets,
            'danceTickets' => $this->danceTickets
        ];

      $this->ui('pages/personaltimetable', $data);
    }

}

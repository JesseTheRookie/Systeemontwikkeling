<?php 
    class HistoricTickets EXTENDS Controller{

        public function __construct() {
            $this->historicTicketDAO = $this->dal('HistoricTicketDAO');
            $this->historicTicketModel = $this->model('HistoricTicketModel');
        }

        public function index(){
            $days = $this->getDifferentDays();

            if($_SERVER['REQUEST_METHOD'] == 'GET') {

                // Sanitize GET data
                $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    
                //If GET request, the Date button that is clicked will be saved in a session
                if(isset($_GET['ticketDate'])) {
                    $ticketDate = $_GET['ticketDate'];
                    $_SESSION['ticketDate'] = $_GET['ticketDate'];
                    } else {
                        $ticketDate = $days[0]->startDateTime;
                        $_SESSION['ticketDate'] = $days[0]->startDateTime;
                    }
    
    
                $data = [
                    'title' => 'Historic Tickets',
                    'days' => $this->getDifferentDays(),
                    'tickets' => $this->getAllHistoricTickets($ticketDate),
                    'message' => ''
                ];
            } else {
                //Init Data
                $data = [
                    'title' => 'Historic Tickets',
                    'content' => '',
                    'days' => '',
                    'tickets' => '',
                    'artists' => '',
                    'performers' => ''
                ];
            }
            

            $this->ui('events/historicTickets', $data);
        }

        public function  getDifferentDays(){
            return $this->historicTicketDAO->getDifferentDays();
        }

        public function getAllHistoricTickets($date){
            $tickets = $this->historicTicketDAO->getHistoricTickets($date);
            return $tickets;
        }

        public function getTicketLanguages($ticketId){
            $languages = $this->historicTicketDAO->getTicketLanguages($ticketId);
        }

        public function getDanceTicketFromTicket($ticketId, $reserved, $start, $end){
            $languages = $this->getTicketLanguages($ticketId);
    
            $historicTicket = new HistoricTicketModel();
    
            $historicTicket->setTicketId($ticketId);
            $historicTicket->setReserved($reserved);
            $historicTicket->setStartDateTime($start);
            $historicTicket->setEndDateTime($end);
            $historicTicket->setTicketLanguage($ticketId);
    
            return $historicTicket;
        }
    
    }
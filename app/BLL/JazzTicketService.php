<?php
require('../DAL/JazzTicketDAO.php');

class JazzTicketService extends Controller {
    public function getAllJazzTickets(){
        $jazzTicketDAO = new JazzTicketDAO;
        return $jazzTicketDAO->getAllJazzTickets();
    }

    public function index(){
        $this->view('test', ['title' => 'Welcome']);
    }
}

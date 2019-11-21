<?php
require('../DAL/JazzTicketDAO.php')
class JazzTicketService{
    public function getAllJazzTickets(){
        $jazzTicketDAO = new JazzTicketDAO;
        return $jazzTicketDAO->getAllJazzTickets();
    }
}
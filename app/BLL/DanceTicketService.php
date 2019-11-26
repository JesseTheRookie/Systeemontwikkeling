<?php
require('../DAL/DanceTicketDAO.php')
class DanceTicketService{
    public function getAllDanceTickets(){
        $danceTicketDAO = new DanceTicketDAO;
        return $danceTicketDao->getAllDanceTickets();
    }
}

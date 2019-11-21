<?php
require('../BLL/JazzTicketService.php')
$jazzTicketService = new JazzTicketService;
echo $jazzTicketService->getAllTickets();
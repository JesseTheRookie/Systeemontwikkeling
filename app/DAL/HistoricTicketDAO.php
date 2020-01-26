<?php
class HistoricTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }    

        //Get all Historic tickets based on button click that's passing ticket information
        public function getHistoricTickets($ticketDate){
            $historicTicketArray = array();

            $this->db->query("  SELECT Tickets.ticketId, Tickets.startDateTime, Tickets.endDateTime, Tickets.ticketQuantity, Tickets.price, Language.language
                                FROM Tickets
                                INNER JOIN HistoricTicket
                                ON Tickets.ticketId = HistoricTicket.ticketId
                                INNER JOIN HistoricLanguage
                                ON HistoricTicket.ticketId = HistoricLanguage.historicTicketId
                                INNER JOIN Language
                                ON HistoricLanguage.languageId = Language.languageId
                                WHERE Tickets.startDateTime LIKE '%:ticketDate%'
                                ORDER BY Tickets.startDateTime ASC
                            ");

            $this->db->bind(':ticketDate', $ticketDate);

            //Fetching results
            $historicTickets = $this->db->resultSet();

            foreach ($historicTickets as $historicTicket) {
                $historicTicketModel = new historicTicketModel();

                $historicTicketModel->setTicketId($historicTicket->ticketId);
                $historicTicketModel->setStartDateTime($historicTicket->startDateTime);
                $historicTicketModel->setEndDateTime($historicTicket->endDateTime);
                $historicTicketModel->setTicketQuantity($historicTicket->ticketQuantity);
                $historicTicketModel->setPrice($historicTicket->price);
                $historicTicketModel->sethistoricTicketLanguage($historicTicket->language);

                //Add objects into array
                array_push($historicTicketArray, $historicTicketModel);
            }
            return $historicTicketArray;
        }

        public function getDifferentDays() {
            $this->db->query("  SELECT DISTINCT(DATE(Tickets.startDateTime)) as startDateTime
                                FROM Tickets
                                INNER JOIN HistoricTicket
                                ON HistoricTicket.ticketId = Tickets.ticketId
                                WHERE startDateTime >=  DATE(NOW())
                            ");
            $results = $this->db->resultSet();

            return $results;
        }

        public function getTicketLanguages($ticketId){
            $historicTicketLanguages = array();
    
            $this->db->query("  SELECT HistoricLanguage.languageId, Language.language
                                FROM HistoricLanguage
                                JOIN Language
                                ON HistoricLanguage.languageId = Language.languageId
                                WHERE HistoricLanguage.historicTicketId = :id
                            ");
    
            $this->db->bind(':id', $ticketId);
    
            $result = $this->db->resultSet();
    
            foreach ($result as $language){
                $historicTicketLanguage = array(
                    'language' => $location->language,
                    'ticketId' => $ticketId
                );
                array_push($historicTicketLanguages, $historicTicketLanguage);
            }
            return $historicTicketLanguages;
        }
    }



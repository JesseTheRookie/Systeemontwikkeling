<?php
class HistoricTicketDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }    

        //Get all Historic tickets based on button click that's passing ticket information
        public function getHistoricTickets($ticketDate){
            $historicTicketArray = array();

            $this->db->query("SELECT t.ticketId, t.startDateTime, t.endDateTime, t.ticketQuantity, t.price, l.language
                            FROM Tickets AS t
                            INNER JOIN HistoricTicket AS h
                            ON t.ticketId = h.ticketId
                            INNER JOIN HistoricLanguage AS hl
                            ON h.ticketId = hl.historicTicketId
                            INNER JOIN Language AS l
                            ON hl.languageId = l.languageId
                            WHERE t.startDateTime LIKE '%$ticketDate%'
                            ORDER BY t.startDateTime ASC
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
            $this->db->query("SELECT DISTINCT(DATE(t.startDateTime)) as startDateTime
                            FROM Tickets as t
                            INNER JOIN HistoricTicket as d
                            ON d.ticketId = t.ticketId
                            WHERE startDateTime >=  DATE(NOW())
                            ");
            $results = $this->db->resultSet();

            return $results;
        }

        public function getTicketLanguages($ticketId){
            $historicTicketLanguages = array();
    
            $this->db->query("SELECT h.venue, l.language
                                    FROM HistoricLanguage AS h
                                    JOIN Language AS l
                                    ON h.languageId = l.languageId
                                    WHERE h.ticketId = :id");
    
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



<?php
class SearchDAO {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getTables(){
        // Prepare query
        $this->db->query("SHOW TABLES");

        // Execute query
        $tableArray = $this->db->resultSet();
        
        // Return array
        return $tableArray;
    }

    public function getColumns($table){
        // Prepare query
        $this->db->query('  SELECT * 
                            FROM INFORMATION_SCHEMA.COLUMNS
                            WHERE TABLE_NAME = :table AND TABLE_SCHEMA = "haarlem_festival"
                            ');

        // Bind values
        $this->db->bind(':table', $table);


        // Execute query
        $columnArray = $this->db->resultSet();
        
        // Return array
        return $columnArray;
    }

    public function searchDB($table, $column, $value){
        // Prepare query
        $this->db->query("  SELECT * FROM `:tableName` WHERE `:column` LIKE ':value'
                            "); 
        //die($table . " | " . $column . " | " . $value);
        // Bind values 
        $this->db->bind(':tableName', $table);
        $this->db->bind(':column', $column);
        $this->db->bind(':value', $value); 
        

        //$this->db->returnStatement();
        // Execute query
        $resultArray = $this->db->resultSet();
        //die(var_dump($resultArray)); 
        // Return array
        return $resultArray;
    }
}

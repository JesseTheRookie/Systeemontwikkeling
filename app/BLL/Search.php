<?php 
    class Search EXTENDS Controller{

        // Create object for DAO and Model layer
        public function __construct() {
            $this->searchDAO = $this->dal('SearchDAO');
        }

        public function index(){
            // Init data
            $data = [
                'title' => 'Search Away!',
                'error' => '',
                'result' => 'f'
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(!empty($_POST['searchValue'])){
                    // Init provided search value
                    $searchValue = $_POST['searchValue'];

                    // Get all the tables in the database
                    $tables = $this->searchDAO->getTables();
                    
                    // Loop through the table array
                    foreach($tables as $table){
                        // Cast to array
                        $table = (array)$table;
                        //die(var_dump($tables));

                        // Get all columns in the table
                        $columns = $this->searchDAO->getColumns($table["Tables_in_haarlem_festival"]);
                        //die(var_dump($columns));

                        // Loop through the column array
                        foreach($columns as $column){
                            // Cast to array
                            $column = (array)$column;

                            // Search in column and table with searchValuein DB
                            $result = $this->searchDAO->searchDB($table["Tables_in_haarlem_festival"], $column["COLUMN_NAME"], $searchValue);
                            //die(var_dump($result));
                            $data['result'] = $result;
                        }                        
                    }

                } else {
                    $data['error'] = "Please provide something to look for!";
                }                
            } else {
                
            }
            
            $this->ui('search/search', $data);
        }
    }
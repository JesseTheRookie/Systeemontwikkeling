<?php
class DanceTicketService Extends Controller{

    public function __construct() {
        $this->ticketDal = $this->dal('DanceTicketDAO');
    }

    public function showArtistInfo() {
        $post = $this->ticketDal->
    }

    public function searchByDay() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name'])
            ];
        } else {
            $data = [
                'name' => ''
            ];
            die("Lrreoaded");
            //load UI
            $this->ui('events/dance', $data);
        }
    }
}

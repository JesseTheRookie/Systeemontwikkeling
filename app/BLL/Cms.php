<?php
    class Cms extends Controller  {

        public function dashboard(){
            $data = "lol";
            $this->ui('cms/dashboard', $data);
        }
    }

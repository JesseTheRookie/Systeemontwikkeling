<?php

//To extend the core controller
class Posts extends Controller {

    public function __construct() {
    }

    public function index() {
        //Get all posts

        $data = [
        ];

        $this->ui('posts/index', $data);
    }
}
?>

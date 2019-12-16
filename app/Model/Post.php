<?php
  class Post {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getPerformance(){
      $this->db->query("SELECT * FROM performanceDance");

      return $this->db->resultSet();

    }
  }

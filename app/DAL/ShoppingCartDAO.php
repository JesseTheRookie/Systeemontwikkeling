<?php
class ShoppingCartDAO{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }
}

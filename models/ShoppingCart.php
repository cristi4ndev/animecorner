<?php

class ShoppingCart
{
    private $id;
    
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

}
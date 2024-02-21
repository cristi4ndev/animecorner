<?php

require_once 'models/Category.php';

class SagaController {
    public function index(){
        require_once 'views/saga/index.php';
    }
    public function create(){
        $new_category = new Category();
        
    }
}
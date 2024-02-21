<?php

require_once 'models/Character.php';

class CharacterController {
    public function index(){
        require_once 'views/character/index.php';
    }
    public function create(){
        $new_category = new Category();
        
    }
}
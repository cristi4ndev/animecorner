<?php

require_once 'models/Category.php';

class CategoryController {
    public function index(){
        require_once 'views/category/category.php';
    }
    public function create(){
        $new_category = new Category();
    }
}
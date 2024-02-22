
<?php

require_once 'models/Product.php';

class ProductController {
    public function index(){
        require_once 'views/products/index.php';
    }
    public function create(){
        $new_category = new Product();
        
    }
}
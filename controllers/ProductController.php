
<?php

require_once 'models/Product.php';

class ProductController {
    public function index(){
        require_once 'models/Product.php';
        $product_model = new Product();
        $product_model->setId($_GET['id']);
        $product = $product_model->getOne();
        require_once 'views/product/index.php';
    }
    public function create(){
        $new_category = new Product();
        
    }
}
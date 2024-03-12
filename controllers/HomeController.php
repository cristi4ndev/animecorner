<?php
class HomeController {
    
    public function index(){
        require_once 'models/Product.php';
        $products_model = new Product();
        $products = $products_model->getLastAdded();
        require_once 'views/layout/home.php';
    }
}
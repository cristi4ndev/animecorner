<?php

require_once 'models/Category.php';

class CategoryController {
    public function index(){if (isset($_GET['id'])) {
        $category_model = new Category();
        $category_model->setId($_GET['id']);
        $products = $category_model->getProducts();
        $category_sagas = $category_model->getBaseSagas();
        $category_characters = $category_model->getBaseCharacters();
        require_once 'views/category/index.php';
    } else {
        show_error();
    }
    }
    
}
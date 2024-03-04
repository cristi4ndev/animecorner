<?php

require_once 'models/Category.php';

class SagaController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $saga_model = new Saga();
            $saga_model->setId($_GET['id']);
            $products = $saga_model->getProducts();
            $saga_categories = $saga_model->getBaseCategories();
            $saga_characters = $saga_model->getBaseCharacters();
            require_once 'views/saga/index.php';
        } else {
            show_error();
        }
    }
    public function create()
    {
        $new_category = new Category();
    }
}

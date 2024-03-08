<?php

require_once 'models/Search.php';

class SearchController {
    public function query()
    {
        if (isset($_POST['query'])) {
        $search_model = new Search();
        $search_model->setQuery($_POST['query']);
        $products = $search_model->search();
        
        require_once 'views/search/index.php';
    } else {
        show_error();
    }
    }
    
}
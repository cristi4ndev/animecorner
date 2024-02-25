<?php

require_once 'models/Character.php';

class AjaxController
{
    public function index()
    {
        
    }
    public function getCharacterById()
    {
        $new_character = new Character();
        $new_character->setSagaId($_GET['id']);
        $characters = $new_character->getAllBySagaId();
        

        // Imprime los resultados en formato JSON para que lo pueda usar JS
        header('Content-Type: application/json');
        echo json_encode($characters);
        
        exit();
    }
}

<?php

require_once 'models/Character.php';

class CharacterController
{
    public function index()
    {
        require_once 'views/character/index.php';
    }
    public function getCharacterById()
    {
        $new_character = new Character();
        $new_character->setSagaId($_GET['id']);
        $characters = $new_character->getAllBySagaId();
        // Imprime los resultados en formato JSON para que lo pueda usar JS
        header('Content-Type: application/json');
        echo json_encode($characters);
        
    }
}

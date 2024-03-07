<?php

require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'controllers/ShoppingCartController.php';


// Función para cargar un error 404 en el caso que la solicitud no exista
function show_error()
{
    $error = new errorController();
    $error->index();
}
// Manejo de solicitudes AJAX para trabjar con Javascript en el Front
if(isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
    // Cargar el controlador y la acción específica para manejar la solicitud AJAX
    if(isset($_GET['controller']) && isset($_GET['action'])) {
        $controllerName = $_GET['controller'] . 'Controller';
        $actionName = $_GET['action'];
        
        // Verificar si el controlador y la acción existen
        if(class_exists($controllerName)) {
            $controller = new $controllerName();
            
            if(method_exists($controller, $actionName)) {
                // Ejecutar la acción y devolver los resultados en formato JSON
                $result = $controller->$actionName();
                header('Content-Type: application/json');
                echo json_encode($result);
                exit(); // Salir para evitar que se procese el resto del código
            }
        }
        
        // Si el controlador o la acción no existen, mostrar un error
        show_error();
        exit();
    }
}

// Manejo normal cuando no es una solicitud AJAX
session_start();    
require_once 'views/layout/head.php';
require_once 'views/layout/header.php';
require_once 'views/layout/nav.php';

if (isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'] . 'Controller';
    
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador = controller_default;
} else {
    show_error();
    exit();
}

// Verificar si el controlador existe y asignarlo
if (class_exists($nombre_controlador)) {
    $controlador = new $nombre_controlador();
    
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
        
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action_default = action_default;
        $controlador->$action_default();
        
    } elseif (strlen($_GET['action'])==0) {
        $action_default = action_default;
        
        $controlador->$action_default();
        
        
    } else {
        show_error();
        
    }
} else {
    show_error();
}

require_once 'views/layout/footer.php';

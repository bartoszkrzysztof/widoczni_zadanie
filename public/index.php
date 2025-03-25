<?php
    require_once '../config/database.php';
    require_once __DIR__ . '/../app/Controllers/ClientController.php';
    require_once __DIR__ . '/../app/Controllers/ConsultantController.php';
    require_once __DIR__ . '/../app/Controllers/PackageController.php';

    $controller = 'ClientController';
    $action = 'index';
    $params = [];

    $url = $_SERVER['REQUEST_URI'];
    $url = trim($url, '/');
    $url = explode('/', $url);

    $controller = ucfirst($url[0]) . 'Controller';
    if (isset($url[1])) {
        $action = $url[1];
    }
    if (isset($url[2])) {
        $params = array_slice($url, 2);
    }

    if (class_exists($controller)) {
        $controllerInstance = new $controller($pdo);

        if (method_exists($controllerInstance, $action)) {
            call_user_func_array([$controllerInstance, $action], $params);
        } else {
            echo "Akcja nie istnieje.";
        }
    } else {
        echo "Kontroler nie istnieje.";
    }
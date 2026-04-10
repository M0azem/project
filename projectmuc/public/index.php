<?php


session_start();


require_once "../core/Controller.php";
require_once "../core/Model.php";


$url = $_GET['url'] ?? 'auth/login';
$url = explode('/', $url);


$controllerName = ucfirst($url[0]) . "Controller";


$method = $url[1] ?? 'index';


require_once "../controllers/" . $controllerName . ".php";


$controller = new $controllerName();


if (method_exists($controller, $method)) {
    $controller->$method();
} else {
    echo "Method Not Found";
}
<?php

class Router {

    public function route() {

        session_start();

        $url = $_GET['url'] ?? 'auth/login';
        $url = explode('/', $url);

        $controllerName = ucfirst($url[0]) . "Controller";
        $method = $url[1] ?? 'index';

        // 🔥 التحقق من تسجيل الدخول
        $publicPages = ['auth/login', 'auth/register', 'auth/store', 'auth/check'];

        $currentPage = $url[0] . '/' . ($url[1] ?? 'index');

        if (!isset($_SESSION['user']) && !in_array($currentPage, $publicPages)) {
            header("Location: index.php?url=auth/login");
            exit;
        }

        require_once "../controllers/" . $controllerName . ".php";

        $controller = new $controllerName();

        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            echo "Page Not Found";
        }
    }
}
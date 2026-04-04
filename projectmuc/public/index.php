<?php

// تشغيل الجلسات (مهم لاحقًا للـ login)
session_start();

// استدعاء الملفات الأساسية
require_once "../core/Controller.php";
require_once "../core/Model.php";

// Router
$url = $_GET['url'] ?? 'auth/login';
$url = explode('/', $url);

// تحديد الكنترولر
$controllerName = ucfirst($url[0]) . "Controller";

// تحديد الميثود
$method = $url[1] ?? 'index';

// تحميل الكنترولر
require_once "../controllers/" . $controllerName . ".php";

// إنشاء object
$controller = new $controllerName();

// تنفيذ الميثود
if (method_exists($controller, $method)) {
    $controller->$method();
} else {
    echo "Method Not Found";
}
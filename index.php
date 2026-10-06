<?php

require_once 'config/autoload.php';
require_once 'config/routes.php';
require_once 'config/config.php';
require_once 'helper/url_helper.php';


$url = $_GET['url'] ?? $route['default_controller'] . '/index';

$url = trim($url, '/');

$segment = explode('/', $url);

$controller = $segment[0] ?? $route['default_controller'];
$method = $segment[1] ?? 'index';
$parameter = $segment[2] ?? null;

$controllerName = ucfirst($controller);

$controllerFile = 'controller/' . $controllerName . '.php';

if (!file_exists($controllerFile)) {
    die("Controller tidak ditemukan: " . $controllerFile);
}

require_once $controllerFile;

if (!class_exists($controllerName)) {
    die("Class Controller tidak ditemukan: " . $controllerName);
}

$objController = new $controllerName();

if (!method_exists($objController, $method)) {
    die("Method tidak ditemukan: " . $method);
}

if ($parameter !== null) {
    $objController->$method($parameter);
} else {
    $objController->$method();
}
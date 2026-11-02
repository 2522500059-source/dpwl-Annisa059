
<?php

require_once 'config/autoload.php';
require_once 'config/routes.php';
require_once 'config/config.php';
require_once 'helper/url_helper.php';

// Mengambil URL dari browser
$url = isset($_GET['url']) ? $_GET['url'] : $route['default_controller'] . '/index';

if (empty($url)) {
    $url = $route['default_controller'] . '/index';
}

// Memisahkan URL
$url = trim($url, '/');
$segment = explode('/', $url);

// Menentukan controller, method, dan parameter
if (isset($segment[0]) && $segment[0] == 'c_master') {

    $controller = $segment[1] ?? '';
    $method = $segment[2] ?? 'index';
    $parameter = $segment[3] ?? null;

} else {

    $controller = $segment[0] ?? $route['default_controller'];
    $method = $segment[1] ?? 'index';
    $parameter = $segment[2] ?? null;

}

// Nama controller
$controllerName = $controller;

// Menentukan lokasi file controller
if (
    $controllerName == 'Mobil_C' ||
    $controllerName == 'Penyewa_C059'
) {
    $controllerFile = 'controller/c_master/' . $controllerName . '.php';
} else {
    $controllerFile = 'controller/' . $controllerName . '.php';
}

// Memeriksa apakah file controller tersedia
if (!file_exists($controllerFile)) {

    die("Controller tidak ditemukan: " . $controllerFile);

}

// Memanggil file controller
require_once $controllerFile;

// Memeriksa apakah class controller tersedia
if (!class_exists($controllerName)) {

    die("Class controller tidak ditemukan: " . $controllerName);

}

// Membuat objek controller
$objController = new $controllerName();

// Memeriksa apakah method tersedia
if (!method_exists($objController, $method)) {

    die("Method tidak ditemukan: " . $method);

}

// Menjalankan method controller
if ($parameter !== null) {

    $objController->$method($parameter);

} else {

    $objController->$method();

}

?>

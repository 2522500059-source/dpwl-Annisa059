
<?php
require_once 'config/autoload.php';
require_once 'config/routes.php';
require_once 'config/config.php';
require_once 'helper/url_helper.php';

$url = $_GET['url'] ?? $route['default_controller'] . '/index';

if ($url == '') {
    $url = $route['default_controller'] . '/index';
}

$url = trim($url, '/');
$segment = explode('/', $url);

// Memeriksa URL controller
if (($segment[0] ?? '') == 'c_master') {
    $controller = $segment[1] ?? '';
    $method = $segment[2] ?? 'index';
    $parameter = $segment[3] ?? null;
} else {
    $controller = $segment[0] ?? $route['default_controller'];
    $method = $segment[1] ?? 'index';
    $parameter = $segment[2] ?? null;
}

$controllerName = ucfirst($controller);

// Menentukan lokasi file controller
if ($controllerName == 'Mobil_C') {
    $controllerFile = 'controller/c_master/' . $controllerName . '.php';
} else {
    $controllerFile = 'controller/' . $controllerName . '.php';
}

// Memeriksa file controller
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Membuat objek controller
    if (class_exists($controllerName)) {
        $objController = new $controllerName();

        // Memeriksa method
        if (method_exists($objController, $method)) {
            if ($parameter !== null) {
                $objController->$method($parameter);
            } else {
                $objController->$method();
            }
        } else {
            echo "Method tidak ditemukan.";
        }
    } else {
        echo "Class controller tidak ditemukan.";
    }
} else {
    echo "Controller tidak ditemukan.";
}

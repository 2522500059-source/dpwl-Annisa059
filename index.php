<?php
require_once 'config/autoload.php';
require_once 'config/routes.php';
require_once 'config/config.php';

// TAMBAHAN - BIAR BASEURL BISA DIBACA DI SEMUA VIEW / HEADER
if (!defined('BASEURL')) {
    define('BASEURL', $config['base_url']);
}

require_once 'helper/url_helper.php';

$url = $_GET['url'] ?? $route['default_controller'] . '/index';
if ($url == '') {
    $url = $route['default_controller']. '/index';
}

$url = trim($url, '/');
$segment = explode('/', $url);

// CEK APAKAH SEGMENT PERTAMA ADALAH FOLDER
if (isset($segment[0]) && is_dir('controller/' . $segment[0])) {
    // URL = c_master/Mobil_C/index ATAU m_shop/Sewa_C/simpan/xxx
    $folder = $segment[0]; // c_master / m_shop / c_shop
    $controller = $segment[1] ?? $route['default_controller'];
    $method = $segment[2] ?? 'index';
    $parameter = isset($segment[3]) ? urldecode($segment[3]) : null;
    if ($parameter === '') $parameter = null;

    $controllerName = $controller; // Jangan di ucfirst, biar Mobil_C tetap Mobil_C
    $controllerFile = 'controller/'.$folder.'/'.$controllerName.'.php';
} else {
    // URL = Mobil_C/index ATAU Sewa_C/simpan/xxx
    $controller = $segment[0] ?? $route['default_controller'];
    $method = $segment[1] ?? 'index';
    $parameter = isset($segment[2]) ? urldecode($segment[2]) : null;
    if ($parameter === '') $parameter = null;

    $controllerName = ucfirst($controller);
    // Cek di semua folder controller: root, c_master, m_shop, c_shop
    if (file_exists('controller/'.$controllerName.'.php')) {
        $controllerFile = 'controller/'.$controllerName.'.php';
    } elseif (file_exists('controller/c_master/'.$controllerName.'.php')) {
        $controllerFile = 'controller/c_master/'.$controllerName.'.php';
    } elseif (file_exists('controller/m_shop/'.$controllerName.'.php')) {
        $controllerFile = 'controller/m_shop/'.$controllerName.'.php';
    } elseif (file_exists('controller/c_shop/'.$controllerName.'.php')) {
        $controllerFile = 'controller/c_shop/'.$controllerName.'.php';
    } else {
        $controllerFile = 'controller/c_master/'.$controllerName.'.php';
    }
}

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $objController = new $controllerName();
    if (method_exists($objController, $method)) {
        if ($parameter !== null) {
            $objController->$method($parameter);
        } else {
            $objController->$method();
        }
    } else {
        echo "Method $method tidak ditemukan di $controllerName.";
    }
} else {
    echo "Controller tidak ditemukan: $controllerFile";
}
?>
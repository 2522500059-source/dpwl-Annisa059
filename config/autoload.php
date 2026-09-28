<?php

spl_autoload_register(function ($namaController) {

    $paths = ['controller/', 'model/', 'config/', 'core/'];

    foreach ($paths as $path) {
        $file = $path . $namaController . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    echo "Class $namaController tidak ditemukan.";
});
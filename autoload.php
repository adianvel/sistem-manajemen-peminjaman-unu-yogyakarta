<?php
spl_autoload_register(function ($class) {
    $paths = [
        'controllers',
        'models'
    ];
    
    foreach ($paths as $path) {
        $file = __DIR__ . "/$path/$class.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Include config file
require_once __DIR__ . '/config/config.php';

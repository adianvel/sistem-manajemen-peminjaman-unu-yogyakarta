<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'manajemen_produk');
define('DB_USER', 'root');
define('DB_PASS', '');

// Application Configuration
define('SITE_NAME', 'Manajemen Produk Elektronik UNU Yogyakarta');
define('BASE_URL', 'http://localhost:8000');

// Set timezone and error reporting
date_default_timezone_set('Asia/Jakarta');
ini_set('display_errors', 1);
error_reporting(E_ALL);

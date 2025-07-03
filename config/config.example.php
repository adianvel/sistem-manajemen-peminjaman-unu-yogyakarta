<?php
/**
 * Configuration Example File
 * Copy this file to config.php and update the values according to your environment
 */

// Database Configuration
define('DB_HOST', 'localhost');     // Database host
define('DB_NAME', 'manajemen_produk');  // Database name
define('DB_USER', 'root');         // Database username
define('DB_PASS', '');             // Database password

// Application Configuration
define('SITE_NAME', 'Manajemen Produk Elektronik UNU Yogyakarta');
define('BASE_URL', 'http://localhost:8000');  // Base URL of the application

// Email Configuration
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_USERNAME', 'your-email@unu-jogja.ac.id');
define('MAIL_PASSWORD', 'your-password');
define('MAIL_ENCRYPTION', 'tls');
define('MAIL_FROM_ADDRESS', 'noreply@unu-jogja.ac.id');
define('MAIL_FROM_NAME', 'UNU Yogyakarta');

// File Upload Configuration
define('UPLOAD_MAX_SIZE', 5242880);  // 5MB in bytes
define('ALLOWED_FILE_TYPES', ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']);
define('UPLOAD_PATH', __DIR__ . '/../public/uploads/');

// Session Configuration
define('SESSION_LIFETIME', 7200);  // 2 hours in seconds
define('SESSION_NAME', 'unu_session');
define('SESSION_SECURE', true);
define('SESSION_HTTP_ONLY', true);

// Security Configuration
define('CSRF_TOKEN_NAME', 'csrf_token');
define('PASSWORD_MIN_LENGTH', 8);
define('LOGIN_MAX_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 900);  // 15 minutes in seconds

// Booking Configuration
define('MAX_PRODUCT_BOOKING_DAYS', 7);
define('MAX_ROOM_BOOKING_HOURS', 4);
define('MIN_BOOKING_NOTICE_HOURS', 24);
define('MAX_ACTIVE_BOOKINGS', 3);

// Maintenance Configuration
define('MAINTENANCE_MODE', false);
define('MAINTENANCE_MESSAGE', 'Sistem sedang dalam pemeliharaan. Silakan coba beberapa saat lagi.');
define('ALLOWED_IPS_IN_MAINTENANCE', [
    '127.0.0.1',
    // Add more IP addresses that can access the site during maintenance
]);

// Logging Configuration
define('LOG_PATH', __DIR__ . '/../logs/');
define('LOG_LEVEL', 'debug');  // debug, info, warning, error
define('LOG_MAX_FILES', 30);   // Keep logs for 30 days

// Cache Configuration
define('CACHE_ENABLED', true);
define('CACHE_PATH', __DIR__ . '/../cache/');
define('CACHE_DEFAULT_EXPIRATION', 3600);  // 1 hour in seconds

// API Configuration
define('API_DEBUG', false);
define('API_RATE_LIMIT', 60);  // Requests per minute
define('API_TOKEN_EXPIRATION', 86400);  // 24 hours in seconds

// Timezone Configuration
date_default_timezone_set('Asia/Jakarta');

// Error Reporting
if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
    // Development environment
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    define('DEBUG_MODE', true);
} else {
    // Production environment
    error_reporting(0);
    ini_set('display_errors', 0);
    define('DEBUG_MODE', false);
}

// Custom Functions
function isDebugMode() {
    return DEBUG_MODE === true;
}

function getBaseUrl() {
    return BASE_URL;
}

function getUploadPath() {
    return UPLOAD_PATH;
}

function isMaintenanceMode() {
    if (!MAINTENANCE_MODE) {
        return false;
    }

    // Allow specific IPs during maintenance
    $clientIp = $_SERVER['REMOTE_ADDR'];
    return !in_array($clientIp, ALLOWED_IPS_IN_MAINTENANCE);
}

function getMailConfig() {
    return [
        'host' => MAIL_HOST,
        'port' => MAIL_PORT,
        'username' => MAIL_USERNAME,
        'password' => MAIL_PASSWORD,
        'encryption' => MAIL_ENCRYPTION,
        'from' => [
            'address' => MAIL_FROM_ADDRESS,
            'name' => MAIL_FROM_NAME
        ]
    ];
}

function getBookingLimits() {
    return [
        'product_days' => MAX_PRODUCT_BOOKING_DAYS,
        'room_hours' => MAX_ROOM_BOOKING_HOURS,
        'notice_hours' => MIN_BOOKING_NOTICE_HOURS,
        'active_bookings' => MAX_ACTIVE_BOOKINGS
    ];
}

// Initialize required directories
$directories = [
    LOG_PATH,
    CACHE_PATH,
    UPLOAD_PATH,
    UPLOAD_PATH . 'products/',
    UPLOAD_PATH . 'rooms/',
    UPLOAD_PATH . 'users/'
];

foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
}

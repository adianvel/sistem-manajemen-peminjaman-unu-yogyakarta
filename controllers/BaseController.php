<?php

abstract class BaseController {
    protected $user;

    public function __construct() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (isset($_SESSION['user'])) {
            $this->user = $_SESSION['user'];
        }
    }

    // Render view with data
    protected function render($view, $data = []) {
        // Extract data to make it available in view
        extract($data);

        // Include header
        require_once __DIR__ . "/../views/layout/header.php";

        // Include the view file
        require_once __DIR__ . "/../views/" . $view . ".php";

        // Include footer
        require_once __DIR__ . "/../views/layout/footer.php";
    }

    // Redirect to another page
    protected function redirect($path) {
        header("Location: " . BASE_URL . $path);
        exit;
    }

    // Check if user is logged in
    protected function isLoggedIn() {
        return isset($_SESSION['user']);
    }

    // Check if user is admin
    protected function isAdmin() {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }

    // Require login to access page
    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $_SESSION['error'] = "Please login to access this page.";
            $this->redirect("/login");
        }
    }

    // Require admin role to access page
    protected function requireAdmin() {
        if (!$this->isAdmin()) {
            $_SESSION['error'] = "You don't have permission to access this page.";
            $this->redirect("/");
        }
    }

    // Get POST data
    protected function getPostData() {
        return $_POST;
    }

    // Get GET data
    protected function getQueryData() {
        return $_GET;
    }

    // Validate required fields
    protected function validateRequired($data, $fields) {
        $errors = [];
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                $errors[$field] = ucfirst($field) . " is required";
            }
        }
        return $errors;
    }

    // Set flash message
    protected function setFlash($type, $message) {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    // Get flash message and clear it
    protected function getFlash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    // Sanitize input data
    protected function sanitize($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->sanitize($value);
            }
        } else {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }
        return $data;
    }

    // Handle file upload
    protected function handleFileUpload($file, $allowedTypes = ['jpg', 'jpeg', 'png'], $maxSize = 5242880) {
        try {
            if (!isset($file['error']) || is_array($file['error'])) {
                throw new Exception('Invalid file parameters');
            }

            switch ($file['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('No file uploaded');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new Exception('File size exceeds limit');
                default:
                    throw new Exception('Unknown file upload error');
            }

            if ($file['size'] > $maxSize) {
                throw new Exception('File size exceeds limit');
            }

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($file['tmp_name']);
            
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($extension, $allowedTypes)) {
                throw new Exception('Invalid file type');
            }

            // Generate unique filename
            $filename = uniqid() . '.' . $extension;
            $uploadPath = __DIR__ . "/../public/uploads/" . $filename;

            if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
                throw new Exception('Failed to move uploaded file');
            }

            return $filename;
        } catch (Exception $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            throw $e;
        }
    }

    // Send JSON response
    protected function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    // Handle AJAX request
    protected function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    // Log action
    protected function logAction($action, $details = '') {
        $userId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
        $timestamp = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $logMessage = sprintf(
            "[%s] User ID: %d, Action: %s, IP: %s, Details: %s\n",
            $timestamp,
            $userId,
            $action,
            $ip,
            $details
        );

        error_log($logMessage, 3, __DIR__ . "/../logs/app.log");
    }
}

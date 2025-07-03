<?php

class LandingController extends BaseController {
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new User();
    }

    // Display landing page
    public function index() {
        // Get counts for statistics
        $productModel = new Product();
        $roomModel = new Room();
        $bookingModel = new Booking();

        $data = [
            'totalProducts' => $productModel->count(),
            'totalRooms' => $roomModel->count(),
            'totalBookings' => $bookingModel->count(),
            'flash' => $this->getFlash()
        ];

        $this->render('landing', $data);
    }

    // Display login form
    public function login() {
        // If already logged in, redirect to appropriate dashboard
        if ($this->isLoggedIn()) {
            $this->redirect($this->isAdmin() ? '/admin' : '/user');
        }

        $data = [
            'flash' => $this->getFlash()
        ];

        $this->render('auth/login', $data);
    }

    // Process login
    public function processLogin() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method');
            }

            $postData = $this->sanitize($this->getPostData());

            // Validate required fields
            $errors = $this->validateRequired($postData, ['username', 'password']);
            if (!empty($errors)) {
                throw new Exception('Please fill in all required fields');
            }

            // Attempt login
            $user = $this->userModel->login($postData['username'], $postData['password']);
            if (!$user) {
                throw new Exception('Invalid username or password');
            }

            // Set user session
            $_SESSION['user'] = $user;
            
            // Log successful login
            $this->logAction('login', 'User logged in successfully: ' . $user['username']);

            // Redirect based on role
            $this->redirect($user['role'] === 'admin' ? '/admin' : '/user');

        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/login');
        }
    }

    // Display registration form
    public function register() {
        // If already logged in, redirect to appropriate dashboard
        if ($this->isLoggedIn()) {
            $this->redirect($this->isAdmin() ? '/admin' : '/user');
        }

        $data = [
            'flash' => $this->getFlash()
        ];

        $this->render('auth/register', $data);
    }

    // Process registration
    public function processRegister() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method');
            }

            $postData = $this->sanitize($this->getPostData());

            // Validate required fields
            $errors = $this->validateRequired($postData, [
                'username', 
                'password', 
                'confirm_password',
                'name',
                'email'
            ]);

            if (!empty($errors)) {
                throw new Exception('Please fill in all required fields');
            }

            // Validate password match
            if ($postData['password'] !== $postData['confirm_password']) {
                throw new Exception('Passwords do not match');
            }

            // Validate password strength
            if (strlen($postData['password']) < 6) {
                throw new Exception('Password must be at least 6 characters long');
            }

            // Validate email format
            if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid email format');
            }

            // Remove confirm_password from data
            unset($postData['confirm_password']);

            // Register user
            $userId = $this->userModel->register($postData);
            if (!$userId) {
                throw new Exception('Registration failed');
            }

            // Log successful registration
            $this->logAction('register', 'New user registered: ' . $postData['username']);

            // Set success message
            $this->setFlash('success', 'Registration successful! Please login.');
            
            // Redirect to login page
            $this->redirect('/login');

        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/register');
        }
    }

    // Process logout
    public function logout() {
        // Log the logout action
        if (isset($_SESSION['user'])) {
            $this->logAction('logout', 'User logged out: ' . $_SESSION['user']['username']);
        }

        // Destroy session
        session_destroy();
        
        // Redirect to landing page with success message
        $this->setFlash('success', 'You have been logged out successfully.');
        $this->redirect('/');
    }

    // Display about page
    public function about() {
        $this->render('about', [
            'flash' => $this->getFlash()
        ]);
    }

    // Display contact page
    public function contact() {
        $this->render('contact', [
            'flash' => $this->getFlash()
        ]);
    }

    // Process contact form
    public function processContact() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method');
            }

            $postData = $this->sanitize($this->getPostData());

            // Validate required fields
            $errors = $this->validateRequired($postData, [
                'name',
                'email',
                'subject',
                'message'
            ]);

            if (!empty($errors)) {
                throw new Exception('Please fill in all required fields');
            }

            // Validate email format
            if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid email format');
            }

            // Here you would typically send the email
            // For now, we'll just log it
            $this->logAction('contact', 'Contact form submitted by: ' . $postData['email']);

            $this->setFlash('success', 'Thank you for your message. We will get back to you soon.');
            $this->redirect('/contact');

        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/contact');
        }
    }
}

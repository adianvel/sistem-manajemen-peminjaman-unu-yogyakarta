<?php

class UserController extends BaseController {
    private $productModel;
    private $roomModel;
    private $bookingModel;
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->requireLogin();

        $this->productModel = new Product();
        $this->roomModel = new Room();
        $this->bookingModel = new Booking();
        $this->userModel = new User();
    }

    // Display user dashboard
    public function index() {
        $userId = $_SESSION['user']['id'];
        
        $data = [
            'availableProducts' => $this->productModel->getAvailableProducts(),
            'availableRooms' => $this->roomModel->getAvailableRooms(),
            'userBookings' => $this->userModel->getBookings($userId),
            'flash' => $this->getFlash()
        ];

        $this->render('user/dashboard', $data);
    }

    // Display available products
    public function products() {
        $data = [
            'products' => $this->productModel->getAvailableProducts(),
            'flash' => $this->getFlash()
        ];

        $this->render('user/products', $data);
    }

    // Display available rooms
    public function rooms() {
        $data = [
            'rooms' => $this->roomModel->getAvailableRooms(),
            'flash' => $this->getFlash()
        ];

        $this->render('user/rooms', $data);
    }

    // Display booking form for product
    public function bookProduct($productId) {
        try {
            $product = $this->productModel->find($productId);
            if (!$product) {
                throw new Exception('Product not found');
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->processProductBooking($productId);
            }

            $data = [
                'product' => $product,
                'flash' => $this->getFlash()
            ];

            $this->render('user/book-product', $data);
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/user/products');
        }
    }

    // Process product booking
    private function processProductBooking($productId) {
        try {
            $postData = $this->sanitize($this->getPostData());
            
            // Validate required fields
            $errors = $this->validateRequired($postData, ['start_date', 'end_date', 'purpose']);
            if (!empty($errors)) {
                throw new Exception('Please fill in all required fields');
            }

            // Prepare booking data
            $bookingData = [
                'user_id' => $_SESSION['user']['id'],
                'product_id' => $productId,
                'start_date' => $postData['start_date'],
                'end_date' => $postData['end_date'],
                'purpose' => $postData['purpose'],
                'status' => 'pending'
            ];

            // Create booking
            $bookingId = $this->bookingModel->createBooking($bookingData);
            if (!$bookingId) {
                throw new Exception('Failed to create booking');
            }

            $this->logAction('product_booking', "Created product booking ID: $bookingId");
            $this->setFlash('success', 'Booking request submitted successfully');
            $this->redirect('/user/bookings');

        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect("/user/book-product/$productId");
        }
    }

    // Display booking form for room
    public function bookRoom($roomId) {
        try {
            $room = $this->roomModel->find($roomId);
            if (!$room) {
                throw new Exception('Room not found');
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->processRoomBooking($roomId);
            }

            $data = [
                'room' => $room,
                'flash' => $this->getFlash()
            ];

            $this->render('user/book-room', $data);
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/user/rooms');
        }
    }

    // Process room booking
    private function processRoomBooking($roomId) {
        try {
            $postData = $this->sanitize($this->getPostData());
            
            // Validate required fields
            $errors = $this->validateRequired($postData, ['start_date', 'end_date', 'purpose']);
            if (!empty($errors)) {
                throw new Exception('Please fill in all required fields');
            }

            // Prepare booking data
            $bookingData = [
                'user_id' => $_SESSION['user']['id'],
                'room_id' => $roomId,
                'start_date' => $postData['start_date'],
                'end_date' => $postData['end_date'],
                'purpose' => $postData['purpose'],
                'status' => 'pending'
            ];

            // Create booking
            $bookingId = $this->bookingModel->createBooking($bookingData);
            if (!$bookingId) {
                throw new Exception('Failed to create booking');
            }

            $this->logAction('room_booking', "Created room booking ID: $bookingId");
            $this->setFlash('success', 'Booking request submitted successfully');
            $this->redirect('/user/bookings');

        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect("/user/book-room/$roomId");
        }
    }

    // Display user's bookings
    public function bookings() {
        $userId = $_SESSION['user']['id'];
        
        $data = [
            'bookings' => $this->userModel->getBookings($userId),
            'flash' => $this->getFlash()
        ];

        $this->render('user/bookings', $data);
    }

    // View booking details
    public function viewBooking($id) {
        try {
            $booking = $this->bookingModel->getBookingDetails($id);
            
            // Verify booking belongs to user
            if (!$booking || $booking['user_id'] != $_SESSION['user']['id']) {
                throw new Exception('Booking not found');
            }

            $data = [
                'booking' => $booking,
                'flash' => $this->getFlash()
            ];

            $this->render('user/view-booking', $data);
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/user/bookings');
        }
    }

    // Cancel booking
    public function cancelBooking($id) {
        try {
            if (!$this->bookingModel->cancelBooking($id, $_SESSION['user']['id'])) {
                throw new Exception('Failed to cancel booking');
            }

            $this->logAction('booking_cancel', "Cancelled booking ID: $id");
            $this->setFlash('success', 'Booking cancelled successfully');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/user/bookings');
    }

    // Display user profile
    public function profile() {
        $data = [
            'user' => $this->userModel->find($_SESSION['user']['id']),
            'flash' => $this->getFlash()
        ];

        $this->render('user/profile', $data);
    }

    // Update user profile
    public function updateProfile() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method');
            }

            $postData = $this->sanitize($this->getPostData());
            
            // Validate required fields
            $errors = $this->validateRequired($postData, ['name', 'email']);
            if (!empty($errors)) {
                throw new Exception('Please fill in all required fields');
            }

            // Update profile
            if (!$this->userModel->updateProfile($_SESSION['user']['id'], $postData)) {
                throw new Exception('Failed to update profile');
            }

            // Update session data
            $_SESSION['user']['name'] = $postData['name'];
            $_SESSION['user']['email'] = $postData['email'];

            $this->logAction('profile_update', 'Updated user profile');
            $this->setFlash('success', 'Profile updated successfully');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/user/profile');
    }

    // Change password
    public function changePassword() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method');
            }

            $postData = $this->sanitize($this->getPostData());
            
            // Validate required fields
            $errors = $this->validateRequired($postData, [
                'current_password',
                'new_password',
                'confirm_password'
            ]);
            if (!empty($errors)) {
                throw new Exception('Please fill in all required fields');
            }

            // Verify current password
            if (!$this->userModel->login($_SESSION['user']['username'], $postData['current_password'])) {
                throw new Exception('Current password is incorrect');
            }

            // Validate new password
            if ($postData['new_password'] !== $postData['confirm_password']) {
                throw new Exception('New passwords do not match');
            }

            if (strlen($postData['new_password']) < 6) {
                throw new Exception('Password must be at least 6 characters long');
            }

            // Update password
            if (!$this->userModel->updateProfile($_SESSION['user']['id'], [
                'password' => $postData['new_password']
            ])) {
                throw new Exception('Failed to update password');
            }

            $this->logAction('password_change', 'Changed password');
            $this->setFlash('success', 'Password changed successfully');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/user/profile');
    }
}

<?php

class AdminController extends BaseController {
    private $productModel;
    private $roomModel;
    private $bookingModel;
    private $userModel;

    public function __construct() {
        parent::__construct();
        $this->requireAdmin();

        $this->productModel = new Product();
        $this->roomModel = new Room();
        $this->bookingModel = new Booking();
        $this->userModel = new User();
    }

    // Display admin dashboard
    public function index() {
        $data = [
            'totalProducts' => $this->productModel->count(),
            'totalRooms' => $this->roomModel->count(),
            'totalBookings' => $this->bookingModel->count(),
            'totalUsers' => $this->userModel->count(),
            'pendingBookings' => $this->bookingModel->getByStatus('pending'),
            'lowStockProducts' => $this->productModel->getLowStockProducts(),
            'flash' => $this->getFlash()
        ];

        $this->render('admin/dashboard', $data);
    }

    // Product Management Methods
    public function products() {
        $data = [
            'products' => $this->productModel->all(),
            'flash' => $this->getFlash()
        ];

        $this->render('admin/products/index', $data);
    }

    public function addProduct() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $postData = $this->sanitize($this->getPostData());
                
                // Validate required fields
                $errors = $this->validateRequired($postData, ['name', 'category', 'quantity']);
                if (!empty($errors)) {
                    throw new Exception('Please fill in all required fields');
                }

                // Create product
                $productId = $this->productModel->create($postData);
                if (!$productId) {
                    throw new Exception('Failed to create product');
                }

                $this->logAction('product_create', 'Created product: ' . $postData['name']);
                $this->setFlash('success', 'Product created successfully');
                $this->redirect('/admin/products');
            }

            $this->render('admin/products/add', ['flash' => $this->getFlash()]);
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/admin/products/add');
        }
    }

    public function editProduct($id) {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $postData = $this->sanitize($this->getPostData());
                
                // Validate required fields
                $errors = $this->validateRequired($postData, ['name', 'category', 'quantity']);
                if (!empty($errors)) {
                    throw new Exception('Please fill in all required fields');
                }

                // Update product
                if (!$this->productModel->update($id, $postData)) {
                    throw new Exception('Failed to update product');
                }

                $this->logAction('product_update', 'Updated product ID: ' . $id);
                $this->setFlash('success', 'Product updated successfully');
                $this->redirect('/admin/products');
            }

            $data = [
                'product' => $this->productModel->find($id),
                'flash' => $this->getFlash()
            ];

            $this->render('admin/products/edit', $data);
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/admin/products');
        }
    }

    public function deleteProduct($id) {
        try {
            if (!$this->productModel->delete($id)) {
                throw new Exception('Failed to delete product');
            }

            $this->logAction('product_delete', 'Deleted product ID: ' . $id);
            $this->setFlash('success', 'Product deleted successfully');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/products');
    }

    // Room Management Methods
    public function rooms() {
        $data = [
            'rooms' => $this->roomModel->all(),
            'flash' => $this->getFlash()
        ];

        $this->render('admin/rooms/index', $data);
    }

    public function addRoom() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $postData = $this->sanitize($this->getPostData());
                
                // Validate required fields
                $errors = $this->validateRequired($postData, ['name', 'capacity']);
                if (!empty($errors)) {
                    throw new Exception('Please fill in all required fields');
                }

                // Create room
                $roomId = $this->roomModel->create($postData);
                if (!$roomId) {
                    throw new Exception('Failed to create room');
                }

                $this->logAction('room_create', 'Created room: ' . $postData['name']);
                $this->setFlash('success', 'Room created successfully');
                $this->redirect('/admin/rooms');
            }

            $this->render('admin/rooms/add', ['flash' => $this->getFlash()]);
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/admin/rooms/add');
        }
    }

    public function editRoom($id) {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $postData = $this->sanitize($this->getPostData());
                
                // Validate required fields
                $errors = $this->validateRequired($postData, ['name', 'capacity']);
                if (!empty($errors)) {
                    throw new Exception('Please fill in all required fields');
                }

                // Update room
                if (!$this->roomModel->update($id, $postData)) {
                    throw new Exception('Failed to update room');
                }

                $this->logAction('room_update', 'Updated room ID: ' . $id);
                $this->setFlash('success', 'Room updated successfully');
                $this->redirect('/admin/rooms');
            }

            $data = [
                'room' => $this->roomModel->find($id),
                'flash' => $this->getFlash()
            ];

            $this->render('admin/rooms/edit', $data);
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/admin/rooms');
        }
    }

    public function deleteRoom($id) {
        try {
            if (!$this->roomModel->delete($id)) {
                throw new Exception('Failed to delete room');
            }

            $this->logAction('room_delete', 'Deleted room ID: ' . $id);
            $this->setFlash('success', 'Room deleted successfully');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/rooms');
    }

    // Booking Management Methods
    public function bookings() {
        $data = [
            'bookings' => $this->bookingModel->all(),
            'flash' => $this->getFlash()
        ];

        $this->render('admin/bookings/index', $data);
    }

    public function viewBooking($id) {
        $data = [
            'booking' => $this->bookingModel->getBookingDetails($id),
            'flash' => $this->getFlash()
        ];

        $this->render('admin/bookings/view', $data);
    }

    public function updateBookingStatus($id) {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method');
            }

            $postData = $this->sanitize($this->getPostData());
            if (empty($postData['status'])) {
                throw new Exception('Status is required');
            }

            if (!$this->bookingModel->updateStatus($id, $postData['status'])) {
                throw new Exception('Failed to update booking status');
            }

            $this->logAction('booking_status_update', "Updated booking ID: $id to status: {$postData['status']}");
            $this->setFlash('success', 'Booking status updated successfully');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/bookings');
    }

    // User Management Methods
    public function users() {
        $data = [
            'users' => $this->userModel->all(),
            'flash' => $this->getFlash()
        ];

        $this->render('admin/users/index', $data);
    }

    public function viewUser($id) {
        $data = [
            'user' => $this->userModel->find($id),
            'bookings' => $this->userModel->getBookings($id),
            'flash' => $this->getFlash()
        ];

        $this->render('admin/users/view', $data);
    }

    // Reports
    public function reports() {
        $data = [
            'flash' => $this->getFlash()
        ];

        $this->render('admin/reports/index', $data);
    }

    public function generateReport() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method');
            }

            $postData = $this->sanitize($this->getPostData());
            
            // Validate required fields
            $errors = $this->validateRequired($postData, ['report_type', 'start_date', 'end_date']);
            if (!empty($errors)) {
                throw new Exception('Please fill in all required fields');
            }

            switch ($postData['report_type']) {
                case 'bookings':
                    $data = $this->bookingModel->getBookingsForDateRange(
                        $postData['start_date'],
                        $postData['end_date']
                    );
                    break;
                // Add more report types as needed
                default:
                    throw new Exception('Invalid report type');
            }

            if ($this->isAjax()) {
                $this->jsonResponse(['data' => $data]);
            } else {
                // Handle non-AJAX request (e.g., download CSV)
                $this->downloadReport($data, $postData['report_type']);
            }
        } catch (Exception $e) {
            if ($this->isAjax()) {
                $this->jsonResponse(['error' => $e->getMessage()], 400);
            } else {
                $this->setFlash('error', $e->getMessage());
                $this->redirect('/admin/reports');
            }
        }
    }

    private function downloadReport($data, $type) {
        $filename = $type . '_report_' . date('Y-m-d_H-i-s') . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        
        // Add headers
        fputcsv($output, array_keys($data[0]));
        
        // Add data
        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;
    }
}

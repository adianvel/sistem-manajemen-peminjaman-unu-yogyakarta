<?php

class Booking extends BaseModel {
    protected $table = 'bookings';

    // Properties
    private $id;
    private $user_id;
    private $product_id;
    private $room_id;
    private $start_date;
    private $end_date;
    private $purpose;
    private $status;

    public function __construct() {
        parent::__construct();
    }

    // Create a new booking
    public function createBooking($data) {
        try {
            // Validate booking data
            $this->validateBooking($data);
            
            // Create the booking
            return $this->create($data);
        } catch (Exception $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            throw $e;
        }
    }

    // Validate booking data
    private function validateBooking($data) {
        // Check if dates are valid
        if (strtotime($data['start_date']) >= strtotime($data['end_date'])) {
            throw new Exception("End date must be after start date");
        }

        // Check if dates are in the future
        if (strtotime($data['start_date']) < time()) {
            throw new Exception("Start date must be in the future");
        }

        // Check if either product_id or room_id is provided (not both)
        if (empty($data['product_id']) && empty($data['room_id'])) {
            throw new Exception("Either product or room must be selected");
        }
        if (!empty($data['product_id']) && !empty($data['room_id'])) {
            throw new Exception("Cannot book both product and room simultaneously");
        }

        // Check availability
        if (!empty($data['product_id'])) {
            $product = new Product();
            if (!$product->isAvailable($data['product_id'], $data['start_date'], $data['end_date'])) {
                throw new Exception("Product is not available for the selected time period");
            }
        }

        if (!empty($data['room_id'])) {
            $room = new Room();
            if (!$room->isAvailable($data['room_id'], $data['start_date'], $data['end_date'])) {
                throw new Exception("Room is not available for the selected time period");
            }
        }
    }

    // Update booking status
    public function updateStatus($bookingId, $status) {
        try {
            return $this->update($bookingId, ['status' => $status]);
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Get bookings by status
    public function getByStatus($status) {
        return $this->where('status', $status);
    }

    // Get pending bookings
    public function getPendingBookings() {
        try {
            $sql = "SELECT b.*, u.name as user_name, 
                    p.name as product_name, r.name as room_name 
                    FROM bookings b 
                    JOIN users u ON b.user_id = u.id 
                    LEFT JOIN products p ON b.product_id = p.id 
                    LEFT JOIN rooms r ON b.room_id = r.id 
                    WHERE b.status = 'pending' 
                    ORDER BY b.created_at ASC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Get bookings for a specific date range
    public function getBookingsForDateRange($startDate, $endDate) {
        try {
            $sql = "SELECT b.*, u.name as user_name, 
                    p.name as product_name, r.name as room_name 
                    FROM bookings b 
                    JOIN users u ON b.user_id = u.id 
                    LEFT JOIN products p ON b.product_id = p.id 
                    LEFT JOIN rooms r ON b.room_id = r.id 
                    WHERE b.start_date BETWEEN ? AND ? 
                    OR b.end_date BETWEEN ? AND ? 
                    ORDER BY b.start_date ASC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$startDate, $endDate, $startDate, $endDate]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Get booking details with related information
    public function getBookingDetails($bookingId) {
        try {
            $sql = "SELECT b.*, u.name as user_name, u.email as user_email,
                    p.name as product_name, p.category as product_category,
                    r.name as room_name, r.capacity as room_capacity
                    FROM bookings b 
                    JOIN users u ON b.user_id = u.id 
                    LEFT JOIN products p ON b.product_id = p.id 
                    LEFT JOIN rooms r ON b.room_id = r.id 
                    WHERE b.id = ?";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$bookingId]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Cancel booking
    public function cancelBooking($bookingId, $userId) {
        try {
            $booking = $this->find($bookingId);
            
            // Check if booking exists and belongs to user
            if (!$booking || $booking['user_id'] != $userId) {
                throw new Exception("Invalid booking");
            }

            // Check if booking can be cancelled (not already completed or cancelled)
            if ($booking['status'] == 'completed' || $booking['status'] == 'rejected') {
                throw new Exception("Booking cannot be cancelled");
            }

            return $this->update($bookingId, ['status' => 'rejected']);
        } catch (Exception $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            throw $e;
        }
    }

    // Magic method to get private properties
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    // Magic method to set private properties
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    // Magic method for string representation
    public function __toString() {
        return "Booking #" . ($this->id ?? 'New');
    }
}

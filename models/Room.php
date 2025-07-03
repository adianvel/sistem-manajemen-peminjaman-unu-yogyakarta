<?php

class Room extends BaseModel {
    protected $table = 'rooms';

    // Properties
    private $id;
    private $name;
    private $capacity;
    private $facilities;
    private $status;

    public function __construct() {
        parent::__construct();
    }

    // Get available rooms
    public function getAvailableRooms() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM rooms WHERE status = 'available'");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Check if room is available for booking
    public function isAvailable($roomId, $startDate, $endDate) {
        try {
            // Check if room exists and is available
            $room = $this->find($roomId);
            if (!$room || $room['status'] !== 'available') {
                return false;
            }

            // Check for overlapping bookings
            $sql = "SELECT COUNT(*) as booking_count 
                    FROM bookings 
                    WHERE room_id = ? 
                    AND status IN ('pending', 'approved')
                    AND ((start_date BETWEEN ? AND ?) 
                    OR (end_date BETWEEN ? AND ?)
                    OR (start_date <= ? AND end_date >= ?))";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $roomId, 
                $startDate, $endDate, 
                $startDate, $endDate,
                $startDate, $endDate
            ]);
            $result = $stmt->fetch();

            return $result['booking_count'] == 0;
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Get room schedule for a specific date range
    public function getSchedule($roomId, $startDate, $endDate) {
        try {
            $sql = "SELECT b.*, u.name as user_name 
                    FROM bookings b 
                    JOIN users u ON b.user_id = u.id 
                    WHERE b.room_id = ? 
                    AND b.start_date >= ? 
                    AND b.end_date <= ? 
                    AND b.status = 'approved'
                    ORDER BY b.start_date";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$roomId, $startDate, $endDate]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Update room status
    public function updateStatus($roomId, $status) {
        try {
            $stmt = $this->db->prepare("UPDATE rooms SET status = ? WHERE id = ?");
            return $stmt->execute([$status, $roomId]);
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Get rooms by capacity range
    public function getByCapacityRange($minCapacity, $maxCapacity = null) {
        try {
            if ($maxCapacity === null) {
                $sql = "SELECT * FROM rooms WHERE capacity >= ?";
                $params = [$minCapacity];
            } else {
                $sql = "SELECT * FROM rooms WHERE capacity BETWEEN ? AND ?";
                $params = [$minCapacity, $maxCapacity];
            }

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Search rooms
    public function search($keyword) {
        try {
            $keyword = "%$keyword%";
            $stmt = $this->db->prepare("SELECT * FROM rooms WHERE name LIKE ? OR facilities LIKE ?");
            $stmt->execute([$keyword, $keyword]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Get booking history for a room
    public function getBookingHistory($roomId) {
        try {
            $sql = "SELECT b.*, u.name as user_name 
                    FROM bookings b 
                    JOIN users u ON b.user_id = u.id 
                    WHERE b.room_id = ? 
                    ORDER BY b.created_at DESC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$roomId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
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
        return $this->name ?? 'Room';
    }
}

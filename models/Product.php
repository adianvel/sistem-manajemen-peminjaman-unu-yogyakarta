<?php

class Product extends BaseModel {
    protected $table = 'products';

    // Properties
    private $id;
    private $name;
    private $description;
    private $category;
    private $quantity;
    private $status;

    public function __construct() {
        parent::__construct();
    }

    // Get available products
    public function getAvailableProducts() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE status = 'available' AND quantity > 0");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Check if product is available for booking
    public function isAvailable($productId, $startDate, $endDate) {
        try {
            // Check if product exists and is available
            $product = $this->find($productId);
            if (!$product || $product['status'] !== 'available' || $product['quantity'] <= 0) {
                return false;
            }

            // Count existing bookings for this period
            $sql = "SELECT COUNT(*) as booked_count FROM bookings 
                    WHERE product_id = ? 
                    AND status IN ('pending', 'approved')
                    AND ((start_date BETWEEN ? AND ?) 
                    OR (end_date BETWEEN ? AND ?))";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$productId, $startDate, $endDate, $startDate, $endDate]);
            $result = $stmt->fetch();

            // If booked count is less than quantity, product is available
            return $result['booked_count'] < $product['quantity'];
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Update product quantity
    public function updateQuantity($productId, $quantity) {
        try {
            $stmt = $this->db->prepare("UPDATE products SET quantity = ? WHERE id = ?");
            return $stmt->execute([$quantity, $productId]);
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Update product status
    public function updateStatus($productId, $status) {
        try {
            $stmt = $this->db->prepare("UPDATE products SET status = ? WHERE id = ?");
            return $stmt->execute([$status, $productId]);
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Get products by category
    public function getByCategory($category) {
        return $this->where('category', $category);
    }

    // Get products with low quantity (for admin alerts)
    public function getLowStockProducts($threshold = 5) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE quantity <= ? AND status = 'available'");
            $stmt->execute([$threshold]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Search products
    public function search($keyword) {
        try {
            $keyword = "%$keyword%";
            $stmt = $this->db->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ? OR category LIKE ?");
            $stmt->execute([$keyword, $keyword, $keyword]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Get booking history for a product
    public function getBookingHistory($productId) {
        try {
            $sql = "SELECT b.*, u.name as user_name 
                    FROM bookings b 
                    JOIN users u ON b.user_id = u.id 
                    WHERE b.product_id = ? 
                    ORDER BY b.created_at DESC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$productId]);
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
        return $this->name ?? 'Product';
    }
}

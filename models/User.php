<?php

class User extends BaseModel {
    protected $table = 'users';

    // Properties
    private $id;
    private $username;
    private $name;
    private $email;
    private $role;

    public function __construct() {
        parent::__construct();
    }

    // Login method
    public function login($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Remove password before returning user data
                unset($user['password']);
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Register new user
    public function register($data) {
        try {
            // Hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            
            // Validate unique username and email
            if ($this->isUsernameExists($data['username'])) {
                throw new Exception("Username already exists");
            }
            if ($this->isEmailExists($data['email'])) {
                throw new Exception("Email already exists");
            }

            return $this->create($data);
        } catch (Exception $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            throw $e;
        }
    }

    // Check if username exists
    private function isUsernameExists($username) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result['count'] > 0;
    }

    // Check if email exists
    private function isEmailExists($email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        return $result['count'] > 0;
    }

    // Get user's bookings
    public function getBookings($userId) {
        try {
            $sql = "SELECT b.*, p.name as product_name, r.name as room_name 
                    FROM bookings b 
                    LEFT JOIN products p ON b.product_id = p.id 
                    LEFT JOIN rooms r ON b.room_id = r.id 
                    WHERE b.user_id = ?
                    ORDER BY b.created_at DESC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$userId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Update user profile
    public function updateProfile($userId, $data) {
        try {
            // If updating email, check if new email exists for other users
            if (isset($data['email'])) {
                $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM users WHERE email = ? AND id != ?");
                $stmt->execute([$data['email'], $userId]);
                $result = $stmt->fetch();
                if ($result['count'] > 0) {
                    throw new Exception("Email already exists");
                }
            }

            // If updating password, hash it
            if (isset($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }

            return $this->update($userId, $data);
        } catch (Exception $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            throw $e;
        }
    }

    // Get user by role
    public function getByRole($role) {
        return $this->where('role', $role);
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
        return $this->name ?? $this->username ?? 'User';
    }
}

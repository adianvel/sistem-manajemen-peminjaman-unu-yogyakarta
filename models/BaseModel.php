<?php

abstract class BaseModel {
    protected $db;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct() {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
            $this->db = new PDO($dsn, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }
    }

    // Find record by ID
    public function find($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Get all records
    public function all() {
        try {
            $stmt = $this->db->query("SELECT * FROM {$this->table}");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Create new record
    public function create(array $data) {
        try {
            $fields = implode(', ', array_keys($data));
            $values = implode(', ', array_fill(0, count($data), '?'));
            
            $sql = "INSERT INTO {$this->table} ($fields) VALUES ($values)";
            $stmt = $this->db->prepare($sql);
            
            $stmt->execute(array_values($data));
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Update record
    public function update($id, array $data) {
        try {
            $fields = array_map(function($field) {
                return "$field = ?";
            }, array_keys($data));
            
            $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE {$this->primaryKey} = ?";
            $stmt = $this->db->prepare($sql);
            
            $values = array_values($data);
            $values[] = $id;
            
            return $stmt->execute($values);
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Delete record
    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    // Find records by condition
    public function where($field, $value) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE $field = ?");
            $stmt->execute([$value]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    // Count total records
    public function count() {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) as count FROM {$this->table}");
            $result = $stmt->fetch();
            return $result['count'];
        } catch (PDOException $e) {
            error_log("Error in " . __METHOD__ . ": " . $e->getMessage());
            return 0;
        }
    }
}

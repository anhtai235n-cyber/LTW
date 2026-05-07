<?php
class Contact {
    private $conn;
    private $table_name = "contacts";

    public $id;
    public $customer_name;
    public $customer_email;
    public $message;
    public $status;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Front-end: Thêm liên hệ mới từ khách hàng
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET customer_name=:customer_name, customer_email=:customer_email, message=:message, status='unread'";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":customer_name", $this->customer_name);
        $stmt->bindParam(":customer_email", $this->customer_email);
        $stmt->bindParam(":message", $this->message);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Admin: Lấy danh sách liên hệ (mới nhất lên đầu)
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Admin: Cập nhật trạng thái liên hệ (unread, read, replied)
    public function updateStatus() {
        $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Admin: Xoá liên hệ
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
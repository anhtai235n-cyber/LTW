<?php
class NewsComment {
    private $conn;
    private $table_name = "comments";

    public $id;
    public $post_id;
    public $user_name;
    public $content;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getByNewsId() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE post_id = ? AND status = 1 ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->post_id);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (post_id, user_name, content, status) VALUES (?, ?, ?, 0)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->post_id, $this->user_name, $this->content]);
    }

    public function readAll() {
        $query = "SELECT c.*, n.title as news_title, n.slug as news_slug 
                FROM " . $this->table_name . " c
                LEFT JOIN news n ON c.post_id = n.id
                WHERE c.status = 'pending' OR c.status = '' OR c.status IS NULL
                ORDER BY c.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function approve() {
        $query = "UPDATE " . $this->table_name . " SET status = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->id]);
    }

    public function reject() {
        $query = "UPDATE " . $this->table_name . " SET status = 2 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->id]);
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->id]);
    }
}
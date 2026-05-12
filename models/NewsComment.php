<?php
class NewsComment {
    private $conn;
    private $table_name = "news_comments";

    public $id;
    public $news_id;
    public $user_id;
    public $content;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getByNewsId() {
        $query = "SELECT c.*, u.fullname AS user_name FROM " . $this->table_name . " c " .
                 "LEFT JOIN users u ON c.user_id = u.id " .
                 "WHERE c.news_id = ? AND c.status = 'approved' ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->news_id);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (news_id, user_id, content, status) VALUES (?, ?, ?, 'pending')";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->news_id, $this->user_id, $this->content]);
    }

    public function readAll() {
        $query = "SELECT c.*, n.title as news_title, n.slug as news_slug, u.fullname as user_name
                FROM " . $this->table_name . " c
                LEFT JOIN news n ON c.news_id = n.id
                LEFT JOIN users u ON c.user_id = u.id
                WHERE c.status = 'pending'
                ORDER BY c.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function approve() {
        $query = "UPDATE " . $this->table_name . " SET status = 'approved' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->id]);
    }

    public function reject() {
        $query = "UPDATE " . $this->table_name . " SET status = 'rejected' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->id]);
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->id]);
    }
}
<?php
class NewsComment {
    private $conn;
    private $table_name = "news_comments";

    public $id;
    public $news_id;
    public $user_id;
    public $content;
    public $status;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy bình luận được duyệt theo news_id
    public function getByNewsId() {
        $query = "SELECT c.*, u.fullname as user_name, u.avatar FROM " . $this->table_name . " c
                  LEFT JOIN users u ON c.user_id = u.id
                  WHERE c.news_id = ? AND c.status = 'approved'
                  ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->news_id);
        $stmt->execute();
        return $stmt;
    }

    // Lấy tất cả bình luận (admin)
    public function readAll() {
        $query = "SELECT c.*, n.title as news_title, u.fullname FROM " . $this->table_name . " c
                  LEFT JOIN news n ON c.news_id = n.id
                  LEFT JOIN users u ON c.user_id = u.id
                  ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Thêm bình luận mới
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET news_id=:news_id, user_id=:user_id, content=:content, status='pending'";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":news_id", $this->news_id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":content", $this->content);

        return $stmt->execute();
    }

    // Duyệt bình luận (admin)
    public function approve() {
        $query = "UPDATE " . $this->table_name . " SET status = 'approved' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    // Từ chối bình luận (admin)
    public function reject() {
        $query = "UPDATE " . $this->table_name . " SET status = 'rejected' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    // Xoá bình luận (admin)
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>

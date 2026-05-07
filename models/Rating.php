<?php
class Rating {
    private $conn;
    private $table_name = "tour_ratings";

    public $id;
    public $tour_id;
    public $user_id;
    public $rating;
    public $comment;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy ratings của một tour
    public function getByTourId() {
        $query = "SELECT r.*, u.fullname, u.avatar FROM " . $this->table_name . " r
                  LEFT JOIN users u ON r.user_id = u.id
                  WHERE r.tour_id = ?
                  ORDER BY r.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->tour_id);
        $stmt->execute();
        return $stmt;
    }

    // Lấy thống kê rating của tour (average, count)
    public function getStatsByTourId() {
        $query = "SELECT 
                    COUNT(*) as total_ratings,
                    AVG(rating) as average_rating,
                    SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_star,
                    SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as four_star,
                    SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as three_star,
                    SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as two_star,
                    SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as one_star
                  FROM " . $this->table_name . " 
                  WHERE tour_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->tour_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Kiểm tra user đã rate tour này chưa
    public function checkExist() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE tour_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->tour_id);
        $stmt->bindParam(2, $this->user_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Thêm rating mới
    public function create() {
        // Check if already exists
        if($this->checkExist()) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " 
                  SET tour_id=:tour_id, user_id=:user_id, rating=:rating, comment=:comment";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tour_id", $this->tour_id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":comment", $this->comment);

        return $stmt->execute();
    }

    // Cập nhật rating
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET rating=:rating, comment=:comment
                  WHERE tour_id=:tour_id AND user_id=:user_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":comment", $this->comment);
        $stmt->bindParam(":tour_id", $this->tour_id);
        $stmt->bindParam(":user_id", $this->user_id);

        return $stmt->execute();
    }

    // Xoá rating (admin)
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    // Lấy tất cả ratings (admin)
    public function readAll() {
        $query = "SELECT r.*, t.name as tour_name, u.fullname FROM " . $this->table_name . " r
                  LEFT JOIN tours t ON r.tour_id = t.id
                  LEFT JOIN users u ON r.user_id = u.id
                  ORDER BY r.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>

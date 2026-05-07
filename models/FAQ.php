<?php
class FAQ {
    private $conn;
    private $table_name = "faqs";

    public $id;
    public $question;
    public $answer;
    public $category;
    public $order_by;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả FAQ
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY order_by ASC, id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lấy FAQ theo category
    public function readByCategory() {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE category = ? 
                  ORDER BY order_by ASC, id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->category);
        $stmt->execute();
        return $stmt;
    }

    // Lấy danh sách categories
    public function getCategories() {
        $query = "SELECT DISTINCT category FROM " . $this->table_name . " WHERE category IS NOT NULL ORDER BY category ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lấy FAQ theo ID
    public function readById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->question = $row['question'];
            $this->answer = $row['answer'];
            $this->category = $row['category'];
            $this->order_by = $row['order_by'];
            return true;
        }
        return false;
    }

    // Thêm FAQ mới (admin)
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET question=:question, answer=:answer, category=:category, order_by=:order_by";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":question", $this->question);
        $stmt->bindParam(":answer", $this->answer);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":order_by", $this->order_by);

        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // Cập nhật FAQ (admin)
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET question=:question, answer=:answer, category=:category, order_by=:order_by
                  WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":question", $this->question);
        $stmt->bindParam(":answer", $this->answer);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":order_by", $this->order_by);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Xoá FAQ (admin)
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>

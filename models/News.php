<?php
class News {
    private $conn;
    private $table_name = "news";

    public $id;
    public $title;
    public $slug;
    public $content;
    public $description;
    public $keywords;
    public $image_url;
    public $author_id;
    public $author_name;
    public $status;
    public $views;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả bài viết (published)
    public function readAll() {
        $query = "SELECT n.*, u.fullname as author_name FROM " . $this->table_name . " n 
                  LEFT JOIN users u ON n.author_id = u.id 
                  WHERE n.status = 'published' ORDER BY n.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Tìm kiếm bài viết
    public function search($keyword) {
        $query = "SELECT n.*, u.fullname as author_name FROM " . $this->table_name . " n 
                  LEFT JOIN users u ON n.author_id = u.id
                  WHERE n.status = 'published' AND (
                    n.title LIKE :keyword OR 
                    n.content LIKE :keyword OR 
                    n.keywords LIKE :keyword
                  ) 
                  ORDER BY n.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $keyword = "%".$keyword."%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        return $stmt;
    }

    // Lấy bài viết theo slug
    public function readBySlug() {
        $query = "SELECT n.*, u.fullname as author_name FROM " . $this->table_name . " n 
                  LEFT JOIN users u ON n.author_id = u.id
                  WHERE n.slug = ? AND n.status = 'published' LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->slug);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->id = $row['id'];
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->description = $row['description'];
            $this->keywords = $row['keywords'];
            $this->image_url = $row['image_url'];
            $this->author_id = $row['author_id'];
            $this->author_name = $row['author_name'];
            $this->status = $row['status'];
            $this->views = $row['views'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
            
            // Tăng view count
            $this->incrementViews();
            
            return true;
        }
        return false;
    }

    // Lấy bài viết theo ID
    public function readById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->title = $row['title'];
            $this->slug = $row['slug'];
            $this->content = $row['content'];
            $this->description = $row['description'];
            $this->keywords = $row['keywords'];
            $this->image_url = $row['image_url'];
            $this->author_id = $row['author_id'];
            $this->status = $row['status'];
            $this->views = $row['views'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
            return true;
        }
        return false;
    }

    // Tăng view count
    public function incrementViews() {
        $query = "UPDATE " . $this->table_name . " SET views = views + 1 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    // Thêm bài viết mới (admin)
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET title=:title, slug=:slug, content=:content, description=:description, 
                      keywords=:keywords, image_url=:image_url, author_id=:author_id, status=:status";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":slug", $this->slug);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":keywords", $this->keywords);
        $stmt->bindParam(":image_url", $this->image_url);
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":status", $this->status);

        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // Cập nhật bài viết (admin)
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET title=:title, slug=:slug, content=:content, description=:description, 
                      keywords=:keywords, status=:status";
        
        if($this->image_url != null) {
            $query .= ", image_url=:image_url";
        }
        $query .= " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":slug", $this->slug);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":keywords", $this->keywords);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);
        
        if($this->image_url != null) {
            $stmt->bindParam(":image_url", $this->image_url);
        }

        return $stmt->execute();
    }

    // Xoá bài viết (admin)
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>

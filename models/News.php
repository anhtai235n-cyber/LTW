<?php
class News {
    private $conn;
    private $table_name = "news"; 

    public $id;
    public $title;
    public $slug;
    public $content;
    public $description; 
    public $image_url;   
    public $created_at;
    public $author_name;
    public $keywords; 
    public $views;
    public $status;


    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function search($keyword) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE title LIKE :keyword OR description LIKE :keyword 
                  ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $keyword = "%".$keyword."%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        return $stmt;
    }

    public function readBySlug() {
        $query = "SELECT n.*, u.fullname AS author_name FROM " . $this->table_name . " n " .
                 "LEFT JOIN users u ON n.author_id = u.id " .
                 "WHERE n.slug = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->slug);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->id = $row['id'];
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->description = $row['description'];
            $this->image_url = $row['image_url'];
            $this->created_at = $row['created_at'];
            $this->author_name = $row['author_name'] ?? 'Admin';
            $this->keywords = $row['keywords'];
            $this->views = $row['views'];
            $this->status = $row['status'];
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    public function readbyID() {
        $query = "SELECT * FROM news WHERE id = ? LIMIT 0,1";
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
            $this->status = $row['status'];
            return true;
        }
        return false;
    }
    
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                SET 
                    title = :title,
                    slug = :slug,
                    content = :content,
                    image_url = :image_url,
                    status = :status,
                    author_name = :author_name,
                    keywords = :keywords
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':slug', $this->slug);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':author_name', $this->author_name);
        $stmt->bindParam(':keywords', $this->keywords);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                SET 
                    title = :title,
                    slug = :slug,
                    content = :content,
                    image_url = :image_url,
                    status = :status,
                    keywords = :keywords,
                    author_id = :author_id,
                    created_at = :created_at";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->slug = htmlspecialchars(strip_tags($this->slug));
        $this->keywords = htmlspecialchars(strip_tags($this->keywords ?? ''));
        $this->created_at = date('Y-m-d H:i:s');

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':slug', $this->slug);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':keywords', $this->keywords);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':created_at', $this->created_at);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
<?php
class Tour {
    private $conn;
    private $table_name = "tours";

    public $id;
    public $tour_code;
    public $name;
    public $category;
    public $price;
    public $duration;
    public $location;
    public $status;
    public $image_url;
    public $description;
    public $highlights;
    public $itinerary;
    public $policy;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. Lấy danh sách tất cả tour
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // 2. Lấy thông tin 1 tour cụ thể theo ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->tour_code = $row['tour_code'];
            $this->name = $row['name'];
            $this->category = $row['category'];
            $this->price = $row['price'];
            $this->duration = $row['duration'];
            $this->location = $row['location'];
            $this->status = $row['status'];
            $this->image_url = $row['image_url'];
            $this->description = $row['description'];
            $this->highlights = $row['highlights'];
            $this->itinerary = $row['itinerary'];
            $this->policy = $row['policy'];
            return true;
        }
        return false;
    }

    // 3. Thêm mới 1 tour
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET tour_code=:tour_code, name=:name, category=:category, price=:price, duration=:duration, location=:location, status=:status, image_url=:image_url, description=:description, highlights=:highlights, itinerary=:itinerary, policy=:policy";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tour_code", $this->tour_code);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":duration", $this->duration);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":image_url", $this->image_url);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":highlights", $this->highlights);
        $stmt->bindParam(":itinerary", $this->itinerary);
        $stmt->bindParam(":policy", $this->policy);

        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // 4. Cập nhật thông tin tour
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET tour_code=:tour_code, name=:name, category=:category, price=:price, duration=:duration, location=:location, status=:status, description=:description, highlights=:highlights, itinerary=:itinerary, policy=:policy";
        
        // Chỉ cập nhật ảnh nếu người dùng có upload ảnh mới
        if($this->image_url != null) {
            $query .= ", image_url=:image_url";
        }
        $query .= " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":tour_code", $this->tour_code);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":duration", $this->duration);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":highlights", $this->highlights);
        $stmt->bindParam(":itinerary", $this->itinerary);
        $stmt->bindParam(":policy", $this->policy);
        $stmt->bindParam(":id", $this->id);
        
        if($this->image_url != null) {
            $stmt->bindParam(":image_url", $this->image_url);
        }

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 5. Xoá tour
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 6. Lấy tất cả hình ảnh của một tour
    public function getImages() {
        $query = "SELECT * FROM tour_images WHERE tour_id = ? ORDER BY is_primary DESC, id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 7. Thêm hình ảnh cho tour
    public function addImage($image_url, $is_primary = 0) {
        $query = "INSERT INTO tour_images (tour_id, image_url, is_primary) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->bindParam(2, $image_url);
        $stmt->bindParam(3, $is_primary);
        return $stmt->execute();
    }

    // 8. Tìm kiếm và lọc tour nâng cao
    public function searchAndFilter($filters = []) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE status = 'active'";
        $params = [];

        // Lọc theo location
        if (!empty($filters['location'])) {
            $query .= " AND location LIKE :location";
            $params[':location'] = '%' . $filters['location'] . '%';
        }

        // Lọc theo category
        if (!empty($filters['category']) && $filters['category'] !== 'all') {
            $query .= " AND category = :category";
            $params[':category'] = $filters['category'];
        }

        // Lọc theo khoảng giá
        if (is_numeric($filters['min_price'])) {
            $query .= " AND price >= :min_price";
            $params[':min_price'] = (float)$filters['min_price'];
        }
        if (is_numeric($filters['max_price'])) {
            $query .= " AND price <= :max_price";
            $params[':max_price'] = (float)$filters['max_price'];
        }

        // Sắp xếp (sorting)
        $sortBy = isset($filters['sort']) ? $filters['sort'] : 'latest';
        switch($sortBy) {
            case 'price_asc':
                $query .= " ORDER BY price ASC";
                break;
            case 'price_desc':
                $query .= " ORDER BY price DESC";
                break;
            case 'name_asc':
                $query .= " ORDER BY name ASC";
                break;
            case 'name_desc':
                $query .= " ORDER BY name DESC";
                break;
            default: // latest
                $query .= " ORDER BY created_at DESC";
        }

        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt;
    }

    // 9. Lấy danh sách các danh mục tour (để dropdown)
    public function getCategories() {
        $query = "SELECT DISTINCT category FROM " . $this->table_name . " WHERE status = 'active' ORDER BY category ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 10. Lấy min/max price để hiển thị price range slider
    public function getPriceRange() {
        $query = "SELECT MIN(price) as min_price, MAX(price) as max_price FROM " . $this->table_name . " WHERE status = 'active'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 11. Đếm tổng số tour active (phục vụ phân trang)
    public function countActiveTours() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE status = 'active'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)($row['total'] ?? 0);
    }

    // 12. Lấy danh sách tour active theo LIMIT/OFFSET (phân trang)
    public function readActiveToursPaginated($limit, $offset) {
        $limit = (int)$limit;
        $offset = (int)$offset;

        $query = "SELECT * FROM " . $this->table_name . " WHERE status = 'active' ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

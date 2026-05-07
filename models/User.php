<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;
    public $fullname;
    public $email;
    public $role;
    public $status;
    public $avatar;
    public $phone;
    public $address;
    public $bio;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Kiểm tra đăng nhập
    public function login() {
        $query = "SELECT id, username, password, fullname, email, role, status, avatar 
                  FROM " . $this->table_name . " 
                  WHERE username = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Kiểm tra trạng thái tài khoản
            if ($row['status'] == 'banned') {
                return "banned";
            }

            // Kiểm tra mật khẩu (Sử dụng password_verify vì pass được băm bằng password_hash)
            if (password_verify($this->password, $row['password'])) {
                // Gán dữ liệu vào object
                $this->id = $row['id'];
                $this->fullname = $row['fullname'];
                $this->email = $row['email'];
                $this->role = $row['role'];
                $this->avatar = $row['avatar'];
                return "success";
            } else {
                return "wrong_password";
            }
        }
        return "not_found";
    }

    // Đăng ký tài khoản mới
    public function register() {
        // Kiểm tra username hoặc email đã tồn tại chưa
        $check_query = "SELECT id FROM " . $this->table_name . " WHERE username = ? OR email = ?";
        $check_stmt = $this->conn->prepare($check_query);
        $check_stmt->bindParam(1, $this->username);
        $check_stmt->bindParam(2, $this->email);
        $check_stmt->execute();

        if ($check_stmt->rowCount() > 0) {
            return false; // Đã tồn tại
        }

        // Băm mật khẩu trước khi lưu
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        $query = "INSERT INTO " . $this->table_name . " 
                  SET username=:username, password=:password, fullname=:fullname, email=:email, role='member', status='active'";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":email", $this->email);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Lấy thông tin user theo ID
    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->username = $row['username'];
            $this->fullname = $row['fullname'];
            $this->email = $row['email'];
            $this->role = $row['role'];
            $this->status = $row['status'];
            $this->avatar = $row['avatar'];
            $this->phone = $row['phone'] ?? '';
            $this->address = $row['address'] ?? '';
            $this->bio = $row['bio'] ?? '';
            $this->created_at = $row['created_at'];
            return true;
        }
        return false;
    }

    // Cập nhật thông tin profile
    public function updateProfile() {
        $query = "UPDATE " . $this->table_name . " 
                  SET fullname=:fullname, email=:email, phone=:phone, address=:address, bio=:bio";
        
        if($this->avatar != null) {
            $query .= ", avatar=:avatar";
        }
        
        $query .= " WHERE id=:id";

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":bio", $this->bio);
        $stmt->bindParam(":id", $this->id);
        
        if($this->avatar != null) {
            $stmt->bindParam(":avatar", $this->avatar);
        }

        return $stmt->execute();
    }

    // Đổi mật khẩu
    public function changePassword($old_password, $new_password) {
        // Lấy mật khẩu cũ từ DB
        $query = "SELECT password FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Kiểm tra mật khẩu cũ có đúng không
        if(!password_verify($old_password, $row['password'])) {
            return false;
        }
        
        // Băm mật khẩu mới
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        // Update mật khẩu mới
        $query = "UPDATE " . $this->table_name . " SET password=:password WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":id", $this->id);
        
        return $stmt->execute();
    }

    // Lấy tất cả users (admin)
    public function readAll() {
        $query = "SELECT id, username, fullname, email, role, status, avatar, created_at FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Ban user (admin)
    public function ban() {
        $query = "UPDATE " . $this->table_name . " SET status='banned' WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    // Unban user (admin)
    public function unban() {
        $query = "UPDATE " . $this->table_name . " SET status='active' WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    // Reset password (admin)
    public function resetPassword($new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE " . $this->table_name . " SET password=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $hashed_password);
        $stmt->bindParam(2, $this->id);
        return $stmt->execute();
    }

    // Delete user (admin)
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    // Tạo tài khoản admin mới (admin)
    public function createAdmin() {
        // Kiểm tra username hoặc email đã tồn tại chưa
        $check_query = "SELECT id FROM " . $this->table_name . " WHERE username = ? OR email = ?";
        $check_stmt = $this->conn->prepare($check_query);
        $check_stmt->bindParam(1, $this->username);
        $check_stmt->bindParam(2, $this->email);
        $check_stmt->execute();

        if ($check_stmt->rowCount() > 0) {
            return false; // Đã tồn tại
        }

        // Băm mật khẩu trước khi lưu
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        $query = "INSERT INTO " . $this->table_name . " 
                  SET username=:username, password=:password, fullname=:fullname, email=:email, role='admin', status='active'";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":email", $this->email);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // Nâng cấp user thành admin (admin)
    public function promoteToAdmin() {
        $query = "UPDATE " . $this->table_name . " SET role='admin' WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }

    // Hạ admin xuống member (admin)
    public function demoteToMember() {
        $query = "UPDATE " . $this->table_name . " SET role='member' WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>
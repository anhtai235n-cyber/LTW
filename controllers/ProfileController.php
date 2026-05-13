<?php
require_once 'config/database.php';
require_once 'models/User.php';
require_once 'models/Booking.php';

class ProfileController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        // Kiểm tra user đã đăng nhập chưa
        if(!isset($_SESSION['user_id'])) {
            header("Location: /index.php?url=login");
            exit;
        }

        $userModel = new User($this->db);
        $userModel->id = $_SESSION['user_id'];
        
        if($userModel->getById()) {
            $user = [
                'id' => $userModel->id,
                'username' => $userModel->username,
                'fullname' => $userModel->fullname,
                'email' => $userModel->email,
                'role' => $userModel->role,
                'status' => $userModel->status,
                'avatar' => $userModel->avatar,
                'phone' => $userModel->phone,
                'address' => $userModel->address,
                'bio' => $userModel->bio,
                'created_at' => $userModel->created_at
            ];

            // Lấy lịch sử booking
            $bookingModel = new Booking($this->db);
            $query = "SELECT b.*, t.name as tour_name FROM bookings b
                      LEFT JOIN tours t ON b.tour_id = t.id
                      WHERE b.customer_email = ?
                      ORDER BY b.created_at DESC";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $user['email']);
            $stmt->execute();
            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $action = 'index';
            $pageTitle = "Hồ Sơ Của Tôi";
            require_once 'views/profile/index.php';
        } else {
            header("Location: /index.php?url=home");
            exit;
        }
    }

    public function update() {
        // Kiểm tra user đã đăng nhập chưa
        if(!isset($_SESSION['user_id'])) {
            header("Location: /index.php?url=login");
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new User($this->db);
            $userModel->id = $_SESSION['user_id'];
            $userModel->fullname = $_POST['fullname'];
            $userModel->email = $_POST['email'];
            $userModel->phone = $_POST['phone'] ?? '';
            $userModel->address = $_POST['address'] ?? '';
            $userModel->bio = $_POST['bio'] ?? '';
            $userModel->avatar = null;

            // Xử lý upload avatar
            if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                $target_dir = "uploads/";
                if(!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $target_file = $target_dir . "avatar_" . $userModel->id . "_" . time() . "_" . basename($_FILES["avatar"]["name"]);
                if(move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    $userModel->avatar = $target_file;
                }
            }

            if($userModel->updateProfile()) {
                $_SESSION['fullname'] = $userModel->fullname;
                $_SESSION['profile_success'] = "Cập nhật hồ sơ thành công!";
            } else {
                $_SESSION['profile_error'] = "Lỗi khi cập nhật hồ sơ!";
            }

            header("Location: /index.php?url=profile");
            exit;
        } else {
            // GET request - hiển thị form
            $userModel = new User($this->db);
            $userModel->id = $_SESSION['user_id'];
            
            if($userModel->getById()) {
                $user = [
                    'id' => $userModel->id,
                    'username' => $userModel->username,
                    'fullname' => $userModel->fullname,
                    'email' => $userModel->email,
                    'role' => $userModel->role,
                    'status' => $userModel->status,
                    'avatar' => $userModel->avatar,
                    'phone' => $userModel->phone,
                    'address' => $userModel->address,
                    'bio' => $userModel->bio,
                    'created_at' => $userModel->created_at
                ];

                $action = 'update';
                $pageTitle = "Chỉnh Sửa Hồ Sơ";
                require_once 'views/profile/update.php';
            } else {
                header("Location: /index.php?url=home");
                exit;
            }
        }
    }

    public function changePassword() {
        // Kiểm tra user đã đăng nhập chưa
        if(!isset($_SESSION['user_id'])) {
            header("Location: /index.php?url=login");
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new User($this->db);
            $userModel->id = $_SESSION['user_id'];
            
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // Kiểm tra mật khẩu mới
            if($new_password !== $confirm_password) {
                $_SESSION['password_error'] = "Mật khẩu xác nhận không khớp!";
            } else if(strlen($new_password) < 6) {
                $_SESSION['password_error'] = "Mật khẩu phải có ít nhất 6 ký tự!";
            } else if($userModel->changePassword($old_password, $new_password)) {
                $_SESSION['password_success'] = "Đổi mật khẩu thành công!";
            } else {
                $_SESSION['password_error'] = "Mật khẩu cũ không chính xác!";
            }

            header("Location: /index.php?url=profile");
            exit;
        } else {
            // GET request - hiển thị form
            $userModel = new User($this->db);
            $userModel->id = $_SESSION['user_id'];
            
            if($userModel->getById()) {
                $user = [
                    'id' => $userModel->id,
                    'username' => $userModel->username,
                    'fullname' => $userModel->fullname,
                    'email' => $userModel->email,
                    'role' => $userModel->role,
                    'status' => $userModel->status,
                    'avatar' => $userModel->avatar,
                    'phone' => $userModel->phone,
                    'address' => $userModel->address,
                    'bio' => $userModel->bio,
                    'created_at' => $userModel->created_at
                ];

                $action = 'changePassword';
                $pageTitle = "Đổi Mật Khẩu";
                require_once 'views/profile/changePassword.php';
            } else {
                header("Location: /index.php?url=home");
                exit;
            }
        }
    }

    public function paymentInfo() {
        // Kiểm tra user đã đăng nhập chưa
        if(!isset($_SESSION['user_id'])) {
            header("Location: /index.php?url=login");
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new User($this->db);
            $userModel->id = $_SESSION['user_id'];
            // Lưu thông tin thanh toán - có thể cần thêm fields vào database
            // Ví dụ: card_number, expiry_date, card_holder, etc.
            // Hiện tại chỉ lưu placeholder
            $_SESSION['payment_success'] = "Thông tin thanh toán đã được cập nhật!";
            header("Location: /index.php?url=profile/paymentInfo");
            exit;
        } else {
            $userModel = new User($this->db);
            $userModel->id = $_SESSION['user_id'];
            
            if($userModel->getById()) {
                $user = [
                    'id' => $userModel->id,
                    'username' => $userModel->username,
                    'fullname' => $userModel->fullname,
                    'email' => $userModel->email,
                    'role' => $userModel->role,
                    'status' => $userModel->status,
                    'avatar' => $userModel->avatar,
                    'phone' => $userModel->phone,
                    'address' => $userModel->address,
                    'bio' => $userModel->bio,
                    'created_at' => $userModel->created_at
                ];

                $action = 'paymentInfo';
                $pageTitle = "Thông Tin Thanh Toán";
                require_once 'views/profile/paymentInfo.php';
            } else {
                header("Location: /index.php?url=home");
                exit;
            }
        }
    }
}
?>

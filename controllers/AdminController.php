<?php
require_once 'config/database.php';
require_once 'config/Validator.php';
require_once 'config/CsrfToken.php';
require_once 'models/User.php';
require_once 'models/Tour.php';
require_once 'models/Contact.php';
require_once 'models/Setting.php';
require_once 'models/Booking.php';
require_once 'models/News.php';
require_once 'models/NewsComment.php';
require_once 'models/FAQ.php';
require_once 'models/Rating.php';

class AdminController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    public function index() {
        // Dashboard
        $userModel = new User($this->db);
        $newsModel = new News($this->db);
        $commentModel = new NewsComment($this->db);
        
        $stmtUsers = $userModel->readAll();
        $allUsers = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
        
        $stmtNews = $newsModel->readAll();
        $recent_news = $stmtNews->fetchAll(PDO::FETCH_ASSOC);
        
        $stmtComments = $commentModel->readAll();
        $recent_comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);
        
        $tourModel = new Tour($this->db);
        $stmtTours = $tourModel->readAll();
        $allTours = $stmtTours->fetchAll(PDO::FETCH_ASSOC);

        $stats = [
            'total_users' => count($allUsers),
            'total_news' => count($recent_news),
            'pending_comments' => count(array_filter($recent_comments, function($c) { return $c['status'] === 'pending'; })),
            'total_tours' => count($allTours)
        ];

        require_once 'views/admin/index.php';
    }

    // ===================== QUẢN LÝ TOUR =====================
    public function tours() {
        $tourModel = new Tour($this->db);
        $stmt = $tourModel->readAll();
        $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $totalTours = count($tours);
        $activeTours = 0;
        $hiddenTours = 0;
        foreach($tours as $t) {
            if ($t['status'] == 'active') $activeTours++;
            else $hiddenTours++;
        }

        $pageTitle = "Quản lý Tour";
        $contentView = "views/admin/tours/index.php";
        require_once 'views/admin/layout.php';
    }

    // Giao diện Thêm mới
    public function tours_create() {
        $pageTitle = "Thêm Tour mới";
        $contentView = "views/admin/tours/create.php";
        require_once 'views/admin/layout.php';
    }

    // Xử lý lưu Thêm mới
    public function tours_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tourModel = new Tour($this->db);
            $tourModel->tour_code = $_POST['tour_code'];
            $tourModel->name = $_POST['name'];
            $tourModel->category = $_POST['category'];
            $tourModel->price = $_POST['price'];
            $tourModel->duration = $_POST['duration'];
            $tourModel->location = $_POST['location'];
            $tourModel->status = $_POST['status'];
            $tourModel->description = $_POST['description'];
            $tourModel->highlights = $_POST['highlights'];
            $tourModel->itinerary = $_POST['itinerary'];
            $tourModel->policy = $_POST['policy'];

            // Xử lý upload ảnh chính
            $tourModel->image_url = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "uploads/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $tourModel->image_url = $target_file;
                }
            }

            if ($tourModel->create()) {
                // Xử lý upload nhiều ảnh phụ (nếu có)
                if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                    $target_dir = "uploads/";
                    $total = count($_FILES['gallery']['name']);
                    for ($i = 0; $i < $total; $i++) {
                        if ($_FILES['gallery']['error'][$i] == 0) {
                            $target_file = $target_dir . basename($_FILES["gallery"]["name"][$i]);
                            if (move_uploaded_file($_FILES["gallery"]["tmp_name"][$i], $target_file)) {
                                $tourModel->addImage($target_file, 0);
                            }
                        }
                    }
                }

                header("Location: /admin/tours");
                exit;
            } else {
                echo "Lỗi khi thêm tour!";
            }
        }
    }

    // Giao diện Cập nhật
    public function tours_edit() {
        if (isset($_GET['id'])) {
            $tourModel = new Tour($this->db);
            $tourModel->id = $_GET['id'];
            
            if ($tourModel->readOne()) {
                $tour = [
                    'id' => $tourModel->id,
                    'tour_code' => $tourModel->tour_code,
                    'name' => $tourModel->name,
                    'category' => $tourModel->category,
                    'price' => $tourModel->price,
                    'duration' => $tourModel->duration,
                    'location' => $tourModel->location,
                    'status' => $tourModel->status,
                    'image_url' => $tourModel->image_url,
                    'description' => $tourModel->description,
                    'highlights' => $tourModel->highlights,
                    'itinerary' => $tourModel->itinerary,
                    'policy' => $tourModel->policy,
                ];
                $pageTitle = "Cập nhật Tour";
                $contentView = "views/admin/tours/edit.php";
                require_once 'views/admin/layout.php';
            } else {
                echo "Không tìm thấy tour!";
            }
        }
    }

    // Xử lý lưu Cập nhật
    public function tours_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $tourModel = new Tour($this->db);
            $tourModel->id = $_POST['id'];
            $tourModel->tour_code = $_POST['tour_code'];
            $tourModel->name = $_POST['name'];
            $tourModel->category = $_POST['category'];
            $tourModel->price = $_POST['price'];
            $tourModel->duration = $_POST['duration'];
            $tourModel->location = $_POST['location'];
            $tourModel->status = $_POST['status'];
            $tourModel->description = $_POST['description'];
            $tourModel->highlights = $_POST['highlights'];
            $tourModel->itinerary = $_POST['itinerary'];
            $tourModel->policy = $_POST['policy'];

            // Xử lý upload ảnh (nếu có up ảnh mới)
            $tourModel->image_url = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "uploads/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $tourModel->image_url = $target_file;
                }
            }

            if ($tourModel->update()) {
                // Xử lý upload nhiều ảnh phụ (nếu có)
                if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                    $target_dir = "uploads/";
                    $total = count($_FILES['gallery']['name']);
                    for ($i = 0; $i < $total; $i++) {
                        if ($_FILES['gallery']['error'][$i] == 0) {
                            $target_file = $target_dir . basename($_FILES["gallery"]["name"][$i]);
                            if (move_uploaded_file($_FILES["gallery"]["tmp_name"][$i], $target_file)) {
                                $tourModel->addImage($target_file, 0);
                            }
                        }
                    }
                }

                header("Location: /admin/tours");
                exit;
            } else {
                echo "Lỗi khi cập nhật tour!";
            }
        }
    }

    // Xử lý xoá
    public function tours_delete() {
        if (isset($_GET['id'])) {
            $tourModel = new Tour($this->db);
            $tourModel->id = $_GET['id'];
            if ($tourModel->delete()) {
                header("Location: /admin/tours");
                exit;
            } else {
                echo "Lỗi khi xoá tour!";
            }
        }
    }

    // ===================== QUẢN LÝ LIÊN HỆ =====================
    public function contact() {
        $contactModel = new Contact($this->db);
        $stmt = $contactModel->readAll();
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalContacts = count($contacts);
        $unreadContacts = 0;
        foreach($contacts as $c) {
            if ($c['status'] == 'unread') $unreadContacts++;
        }

        $pageTitle = "Quản lý Liên hệ";
        $contentView = "views/admin/contact.php";
        require_once 'views/admin/layout.php';
    }

    public function contact_status() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
            $contactModel = new Contact($this->db);
            $contactModel->id = $_POST['id'];
            $contactModel->status = $_POST['status'];
            
            if ($contactModel->updateStatus()) {
                header("Location: /admin/contact");
                exit;
            } else {
                echo "Lỗi cập nhật trạng thái liên hệ!";
            }
        }
    }

    public function contact_delete() {
        if (isset($_GET['id'])) {
            $contactModel = new Contact($this->db);
            $contactModel->id = $_GET['id'];
            
            if ($contactModel->delete()) {
                header("Location: /admin/contact");
                exit;
            } else {
                echo "Lỗi khi xoá liên hệ!";
            }
        }
    }

    // ===================== CÀI ĐẶT CHUNG =====================
    public function setting() {
        $settingModel = new Setting($this->db);
        $settings = $settingModel->getAll();

        $pageTitle = "Cài đặt Chung";
        $contentView = "views/admin/setting.php";
        require_once 'views/admin/layout.php';
    }

    public function setting_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $settingModel = new Setting($this->db);
            $settings_data = [
                'site_name' => $_POST['site_name'],
                'hero_title' => $_POST['hero_title'],
                'company_phone' => $_POST['company_phone'],
                'company_email' => $_POST['company_email'],
                'company_address' => $_POST['company_address']
            ];

            // Handle hero image upload separately if provided
            if (isset($_FILES['hero_image']) && $_FILES['hero_image']['error'] == 0) {
                $target_dir = "uploads/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $target_file = $target_dir . basename($_FILES["hero_image"]["name"]);
                if (move_uploaded_file($_FILES["hero_image"]["tmp_name"], $target_file)) {
                    $settings_data['hero_image'] = $target_file;
                }
            }

            if ($settingModel->updateMultiple($settings_data)) {
                // Pass success flag to view
                $_SESSION['setting_success'] = "Cập nhật cấu hình thành công!";
            } else {
                $_SESSION['setting_error'] = "Đã có lỗi xảy ra khi cập nhật!";
            }
            
            header("Location: /admin/setting");
            exit;
        }
    }

    // ===================== QUẢN LÝ ĐẶT TOUR =====================
    public function bookings() {
        $bookingModel = new Booking($this->db);
        $stmt = $bookingModel->readAll();
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pageTitle = "Quản lý Đặt Tour";
        $contentView = "views/admin/bookings/index.php";
        require_once 'views/admin/layout.php';
    }

    public function booking_status() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
            $bookingModel = new Booking($this->db);
            $bookingModel->id = $_POST['id'];
            $bookingModel->status = $_POST['status'];
            
            if ($bookingModel->updateStatus()) {
                header("Location: /admin/bookings");
                exit;
            } else {
                echo "Lỗi cập nhật trạng thái đơn đặt tour!";
            }
        }
    }
    // ===================== QUẢN LÝ NGƯỜI DÙNG =====================
    public function users() {
        $userModel = new User($this->db);
        $stmtUsers = $userModel->readAll();
        $users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
        
        $pageTitle = "Quản lý Người dùng";
        $contentView = "views/admin/users/index.php";
        require_once 'views/admin/layout.php';
    }

    // Hiển thị form tạo admin mới
    public function users_create() {
        $pageTitle = "Tạo Admin mới";
        $contentView = "views/admin/users/create.php";
        require_once 'views/admin/layout.php';
    }

    // Xử lý lưu admin mới
    public function users_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate input
            Validator::reset();
            Validator::username($_POST['username'] ?? '');
            Validator::email($_POST['email'] ?? '');
            Validator::password($_POST['password'] ?? '');
            Validator::required($_POST['fullname'] ?? '', 'Họ và tên');
            Validator::passwordMatch($_POST['password'] ?? '', $_POST['confirm_password'] ?? '', 'Mật khẩu');

            if (Validator::fails()) {
                $error = implode(', ', Validator::getErrors());
                $pageTitle = "Tạo Admin mới";
                $contentView = "views/admin/users/create.php";
                require_once 'views/admin/layout.php';
                return;
            }

            $userModel = new User($this->db);
            $userModel->username = Validator::sanitize($_POST['username']);
            $userModel->password = $_POST['password'];
            $userModel->fullname = Validator::sanitize($_POST['fullname']);
            $userModel->email = Validator::sanitize($_POST['email']);

            if ($userModel->createAdmin()) {
                $_SESSION['success'] = "Tạo tài khoản admin thành công!";
                header("Location: /admin/users");
                exit;
            } else {
                $error = "Tên đăng nhập hoặc email đã tồn tại!";
                $pageTitle = "Tạo Admin mới";
                $contentView = "views/admin/users/create.php";
                require_once 'views/admin/layout.php';
            }
        }
    }

    // Nâng cấp user thành admin
    public function users_promote() {
        if (isset($_GET['id']) && $_GET['id'] != 0) {
            $userModel = new User($this->db);
            $userModel->id = $_GET['id'];
            
            if ($userModel->promoteToAdmin()) {
                $_SESSION['success'] = "Nâng cấp thành admin thành công!";
            }
        }
        header("Location: /admin/users");
        exit;
    }

    // Hạ admin xuống member
    public function users_demote() {
        if (isset($_GET['id']) && $_GET['id'] != 0) {
            $userModel = new User($this->db);
            $userModel->id = $_GET['id'];
            
            if ($userModel->demoteToMember()) {
                $_SESSION['success'] = "Hạ xuống member thành công!";
            }
        }
        header("Location: /admin/users");
        exit;
    }

    // Khóa user
    public function users_ban() {
        if (isset($_GET['id']) && $_GET['id'] != 0) {
            $userModel = new User($this->db);
            $userModel->id = $_GET['id'];
            
            if ($userModel->ban()) {
                $_SESSION['success'] = "Khóa tài khoản thành công!";
            }
        }
        header("Location: /admin/users");
        exit;
    }

    // Mở khóa user
    public function users_unban() {
        if (isset($_GET['id']) && $_GET['id'] != 0) {
            $userModel = new User($this->db);
            $userModel->id = $_GET['id'];
            
            if ($userModel->unban()) {
                $_SESSION['success'] = "Mở khóa tài khoản thành công!";
            }
        }
        header("Location: /admin/users");
        exit;
    }

    // Xóa user
    public function users_delete() {
        if (isset($_GET['id']) && $_GET['id'] != 0) {
            $userModel = new User($this->db);
            $userModel->id = $_GET['id'];
            
            if ($userModel->delete()) {
                $_SESSION['success'] = "Xóa tài khoản thành công!";
            }
        }
        header("Location: /admin/users");
        exit;
    }

    // ===================== QUẢN LÝ TIN TỨC =====================
    public function news() {
        $newsModel = new News($this->db);
        $query = "SELECT n.*, u.fullname as author_name FROM news n 
                  LEFT JOIN users u ON n.author_id = u.id 
                  ORDER BY n.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $pageTitle = "Quản lý Tin tức";
        $contentView = "views/admin/news/index.php";
        require_once 'views/admin/layout.php';
    }

    // ===================== QUẢN LÝ FAQ =====================
    public function faqs() {
        $faqModel = new FAQ($this->db);
        $stmtFaqs = $faqModel->readAll();
        $faqs = $stmtFaqs->fetchAll(PDO::FETCH_ASSOC);
        
        $pageTitle = "Quản lý FAQ";
        $contentView = "views/admin/faqs/index.php";
        require_once 'views/admin/layout.php';
    }

    // ===================== DUYỆT BÌNH LUẬN =====================
    public function comments() {
        $commentModel = new NewsComment($this->db);
        $stmtComments = $commentModel->readAll();
        $comments = $stmtComments->fetchAll(PDO::FETCH_ASSOC);
        
        $pageTitle = "Duyệt Bình luận";
        $contentView = "views/admin/comments/index.php";
        require_once 'views/admin/layout.php';
    }

    // ===================== QUẢN LÝ ĐÁNH GIÁ =====================
    public function ratings() {
        $ratingModel = new Rating($this->db);
        $stmtRatings = $ratingModel->readAll();
        $ratings = $stmtRatings->fetchAll(PDO::FETCH_ASSOC);
        
        $pageTitle = "Quản lý Đánh giá";
        $contentView = "views/admin/ratings/index.php";
        require_once 'views/admin/layout.php';
    }
}
?>
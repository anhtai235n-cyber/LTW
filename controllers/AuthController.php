<?php
require_once 'models/User.php';
require_once 'config/database.php';
require_once 'config/Validator.php';
require_once 'config/CsrfToken.php';
require_once 'config/Logger.php';

class AuthController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Hiển thị form đăng nhập
    public function index() {
        // Nếu đã đăng nhập thì đẩy về trang chủ hoặc admin tùy role
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['user_role'] == 'admin') {
                header("Location: /index.php?url=admin");
            } else {
                header("Location: /index.php?url=home");
            }
            exit;
        }
        $pageTitle = "Đăng nhập";
        require_once 'views/login/index.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Verify CSRF token
            if (!CsrfToken::verifyPost()) {
                $error = "Yêu cầu không hợp lệ!";
                require_once 'views/login/index.php';
                return;
            }

            Validator::reset();
            Validator::required($_POST['username'] ?? '', 'Tên đăng nhập');
            Validator::required($_POST['password'] ?? '', 'Mật khẩu');

            if (Validator::fails()) {
                $error = implode(', ', Validator::getErrors());
                require_once 'views/login/index.php';
                return;
            }

            $userModel = new User($this->db);
            $userModel->username = Validator::sanitize($_POST['username']);
            $userModel->password = $_POST['password'];

            $result = $userModel->login();

            if ($result == "success") {
                $_SESSION['user_id'] = $userModel->id;
                $_SESSION['username'] = $userModel->username;
                $_SESSION['email'] = $userModel->email;
                $_SESSION['fullname'] = $userModel->fullname;
                $_SESSION['user_role'] = $userModel->role;
                $_SESSION['avatar'] = $userModel->avatar;
                CsrfToken::destroy();

                if ($userModel->role == 'admin') {
                    Logger::info("Admin logged in: {$userModel->username}");
                    header("Location: /index.php?url=admin");
                } else {
                    Logger::info("User logged in: {$userModel->username}");
                    header("Location: /index.php?url=home");
                }
                exit;
            } elseif ($result == "banned") {
                $error = "Tài khoản của bạn đã bị khóa!";
            } elseif ($result == "wrong_password" || $result == "not_found") {
                $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
            } else {
                $error = "Đã xảy ra lỗi, vui lòng thử lại!";
            }

            require_once 'views/login/index.php'; // Load lại trang kèm biến $error
        } else {
            $this->index(); // Nếu không phải POST, gọi hàm index hiển thị form
        }
    }

    // Hiển thị form đăng ký
    public function register_form() {
        if (isset($_SESSION['user_id'])) {
            header("Location: /index.php?url=home");
            exit;
        }
        $pageTitle = "Đăng ký";
        require_once 'views/register/index.php';
    }

    // Xử lý đăng ký
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Verify CSRF token
            if (!CsrfToken::verifyPost()) {
                $error = "Yêu cầu không hợp lệ!";
                require_once 'views/register/index.php';
                return;
            }

            // Validate input
            Validator::reset();
            Validator::username($_POST['username'] ?? '');
            Validator::email($_POST['email'] ?? '');
            Validator::password($_POST['password'] ?? '');
            Validator::required($_POST['fullname'] ?? '', 'Họ và tên');
            Validator::passwordMatch($_POST['password'] ?? '', $_POST['confirm_password'] ?? '', 'Mật khẩu');

            if (Validator::fails()) {
                $error = implode(', ', Validator::getErrors());
                require_once 'views/register/index.php';
                return;
            }

            $userModel = new User($this->db);
            $userModel->username = Validator::sanitize($_POST['username']);
            $userModel->password = $_POST['password'];
            $userModel->fullname = Validator::sanitize($_POST['fullname']);
            $userModel->email = Validator::sanitize($_POST['email']);

            if ($userModel->register()) {
                $success = "Đăng ký thành công! Vui lòng đăng nhập.";
                CsrfToken::destroy();
                // Có thể chuyển ngay sang view đăng nhập kèm thông báo
                require_once 'views/login/index.php';
            } else {
                $error = "Tên đăng nhập hoặc email đã tồn tại!";
                require_once 'views/register/index.php';
            }
        } else {
            $this->register_form();
        }
    }

    // Đăng xuất
    public function logout() {
        // Hủy toàn bộ session
        Logger::info("User logged out: " . ($_SESSION['username'] ?? 'guest'));
        session_unset();
        session_destroy();
        header("Location: /index.php?url=home");
        exit;
    }
}
?>
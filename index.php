<?php
// 1. Khởi tạo session và kết nối database [cite: 11, 73]
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'config/database.php';
require_once 'config/Logger.php';

// 2. Lấy URL để biết người dùng muốn vào trang nào [cite: 17]
// Ví dụ: localhost:4545/contact -> trang liên hệ
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
Logger::info("Request route: {$url} | Remote IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));

// 3. Gọi Controller tương ứng
$urlParts = explode('/', rtrim($url, '/'));

// --- ROUTES AUTH ---
if ($url == 'login') {
    require_once 'controllers/AuthController.php';
    $auth = new AuthController();
    $auth->login();
} elseif ($url == 'register') {
    require_once 'controllers/AuthController.php';
    $auth = new AuthController();
    $auth->register();
} elseif ($url == 'logout') {
    require_once 'controllers/AuthController.php';
    $auth = new AuthController();
    $auth->logout();
}
// --- ROUTES ADMIN ---
elseif ($urlParts[0] == 'admin') {
    // Bảo vệ Admin: Nếu chưa đăng nhập hoặc không phải admin thì đẩy về trang login
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
        header("Location: /login");
        exit;
    }

    require_once 'controllers/AdminController.php';
    $adminController = new AdminController();
    
    // Xây dựng action name từ URL
    // /admin/users/create -> users_create
    // /admin/users/store -> users_store
    if (isset($urlParts[1])) {
        if (isset($urlParts[2])) {
            $action = $urlParts[1] . '_' . $urlParts[2];
        } else {
            $action = $urlParts[1];
        }
    } else {
        $action = 'index';
    }
    
    if (method_exists($adminController, $action)) {
        $adminController->$action();
    } else {
        echo "404 - Không tìm thấy trang Admin";
    }
}
// --- ROUTES FRONT-END ---
elseif ($url == 'home') {
    require_once 'controllers/HomeController.php';
    $homeController = new HomeController();
    $homeController->index();
} elseif ($url == 'contact') {
    require_once 'controllers/ContactController.php';
    $contactController = new ContactController();
    $contactController->index();
} elseif ($url == 'contact/submit') {
    require_once 'controllers/ContactController.php';
    $contactController = new ContactController();
    $contactController->submit();
} elseif ($url == 'tour') {
    require_once 'controllers/TourController.php';
    $tourController = new TourController();
    $tourController->detail();
} elseif ($url == 'tour_all') {
    require_once 'controllers/TourController.php';
    $tourController = new TourController();
    $tourController->all();
} elseif ($url == 'tour/rate') {
    require_once 'controllers/TourController.php';
    $tourController = new TourController();
    $tourController->rate();
} elseif ($url == 'search') {
    require_once 'controllers/SearchController.php';
    $searchController = new SearchController();
    $searchController->index();
} elseif ($url == 'payment') {
    include 'views/payment/index.php';
} elseif ($url == 'booking_submit') {
    require_once 'controllers/BookingController.php';
    $bookingController = new BookingController();
    $bookingController->submit();
} elseif ($url == 'about') {
    require_once 'controllers/AboutController.php';
    $aboutController = new AboutController();
    $aboutController->index();
} elseif ($url == 'pricing') {
    require_once 'controllers/PricingController.php';
    $pricingController = new PricingController();
    $pricingController->index();
} elseif ($url == 'news') {
    require_once 'controllers/NewsController.php';
    $newsController = new NewsController();
    $newsController->index();
} elseif (strpos($url, 'news/') === 0 && $url != 'news/submit_comment') {
    // For news/<slug> - treat as detail page
    $slug = substr($url, 5); // Remove 'news/' prefix
    $_GET['slug'] = $slug;
    require_once 'controllers/NewsController.php';
    $newsController = new NewsController();
    $newsController->detail();
} elseif ($url == 'news/submit_comment') {
    require_once 'controllers/NewsController.php';
    $newsController = new NewsController();
    $newsController->submitComment();
} elseif ($url == 'faq') {
    require_once 'controllers/FAQController.php';
    $faqController = new FAQController();
    $faqController->index();
} elseif ($urlParts[0] == 'profile') {
    require_once 'controllers/ProfileController.php';
    $profileController = new ProfileController();
    $action = isset($urlParts[1]) ? $urlParts[1] : 'index';
    
    if(method_exists($profileController, $action)) {
        $profileController->$action();
    } else {
        $profileController->index();
    }
} else {
    echo "404 - Không tìm thấy trang";
}
?>
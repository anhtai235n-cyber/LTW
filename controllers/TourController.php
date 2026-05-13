<?php
require_once 'config/database.php';
require_once 'models/Tour.php';

class TourController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function all() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        require_once 'models/Tour.php';
        $tourModel = new Tour($this->db);

        $tours = $tourModel->readActiveToursPaginated($perPage, $offset);
        $totalTours = $tourModel->countActiveTours();

        $totalPages = (int)ceil($totalTours / $perPage);
        if ($totalPages < 1) $totalPages = 1;
        if ($page > $totalPages) $page = $totalPages;

        $pageTitle = 'Tất cả tour';
        require_once 'views/tour/all.php';
    }

    public function detail() {
        if (!isset($_GET['id'])) {
            header("Location: /index.php?url=home");
            exit;
        }

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
                'policy' => $tourModel->policy
            ];
            $tourImages = $tourModel->getImages();

            // Lấy ratings
            require_once 'models/Rating.php';
            $ratingModel = new Rating($this->db);
            $stmtRatings = $ratingModel->getByTourId($tourModel->id);
            $ratings = $stmtRatings->fetchAll(PDO::FETCH_ASSOC);
            
            $ratingStats = $ratingModel->getStatsByTourId($tourModel->id);
            
            require_once 'views/tour/detail.php';
        } else {
            // Tour not found
            echo "<!DOCTYPE html>
<html lang='vi'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Không tìm thấy Tour | CloudJourney</title>
    <script src='https://cdn.tailwindcss.com'></script>
</head>
<body class='bg-[#faf8ff]'>
    <div class='max-w-7xl mx-auto px-6 py-24 text-center'>
        <h1 class='text-4xl font-bold text-slate-900 mb-4'>404 - Không tìm thấy tour</h1>
        <p class='text-slate-600 mb-8'>Tour bạn tìm kiếm không tồn tại hoặc đã bị xóa.</p>
        <a href='index.php?url=home' class='inline-block bg-blue-700 hover:bg-blue-800 text-white font-bold px-6 py-3 rounded-xl transition'>
            ← Quay lại trang chủ
        </a>
    </div>
</body>
</html>";
        }
    }

    public function rate() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!isset($_SESSION['user_id'])) {
                header("Location: ?url=login");
                exit;
            }

            require_once 'models/Rating.php';
            $ratingModel = new Rating($this->db);
            
            $ratingModel->tour_id = $_POST['tour_id'];
            $ratingModel->user_id = $_SESSION['user_id'];
            $ratingModel->rating = $_POST['rating'];
            $ratingModel->comment = $_POST['comment'] ?? '';

            if($ratingModel->create()) {
                $_SESSION['rating_success'] = "Cảm ơn bạn đã đánh giá!";
            } else {
                $_SESSION['rating_error'] = "Lỗi khi gửi đánh giá!";
            }

            header("Location: /index.php?url=tour&id=" . $_POST['tour_id']);
            exit;
        }
    }
}
?>
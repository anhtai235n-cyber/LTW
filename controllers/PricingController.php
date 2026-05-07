<?php
require_once 'config/database.php';
require_once 'models/Tour.php';

class PricingController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        $tourModel = new Tour($this->db);
        $stmt = $tourModel->readAll();
        $allTours = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Lọc chỉ tour active
        $tours = [];
        foreach($allTours as $tour) {
            if($tour['status'] == 'active') {
                $tours[] = $tour;
            }
        }

        // Lấy danh sách categories
        $categories = $tourModel->getCategories();

        $pageTitle = "Bảng Giá Tour";
        require_once 'views/pricing/index.php';
    }
}
?>

<?php
require_once 'models/Tour.php';
require_once 'config/database.php';

class SearchController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    public function index() {
        $tourModel = new Tour($this->db);
        
        // Lấy danh mục và khoảng giá để hiển thị filter
        $categories = $tourModel->getCategories();
        $priceRange = $tourModel->getPriceRange();
        
        // Lấy các tham số filter từ REQUEST
        $filters = [
            'location' => $_GET['location'] ?? '',
            'category' => $_GET['category'] ?? 'all',
            'min_price' => $_GET['min_price'] ?? ($priceRange['min_price'] ?? 0),
            'max_price' => $_GET['max_price'] ?? ($priceRange['max_price'] ?? 9999999),
            'sort' => $_GET['sort'] ?? 'latest'
        ];
        
        // Thực hiện tìm kiếm và lọc
        $stmt = $tourModel->searchAndFilter($filters);
        $filteredTours = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Đếm kết quả
        $totalResults = count($filteredTours);
        
        // Lưu lại giá trị filter để dùng lại trong form
        $selectedFilters = $filters;
        
        require_once 'views/search/index.php';
    }
}
?>
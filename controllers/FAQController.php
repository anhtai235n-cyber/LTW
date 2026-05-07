<?php
require_once 'config/database.php';
require_once 'models/FAQ.php';

class FAQController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        $faqModel = new FAQ($this->db);
        
        // Lấy danh sách categories
        $stmtCategories = $faqModel->getCategories();
        $categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);
        
        // Lấy tất cả FAQs
        $stmt = $faqModel->readAll();
        $faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Group by category
        $faq_grouped = [];
        foreach($faqs as $faq) {
            $cat = $faq['category'] ?? 'Khác';
            if(!isset($faq_grouped[$cat])) {
                $faq_grouped[$cat] = [];
            }
            $faq_grouped[$cat][] = $faq;
        }

        $pageTitle = "Hỏi/Đáp";
        require_once 'views/faq/index.php';
    }
}
?>

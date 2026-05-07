<?php
require_once 'config/database.php';
require_once 'models/Setting.php';
require_once 'models/Tour.php';

class HomeController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        // Fetch site settings
        $settingModel = new Setting($this->db);
        $settings = $settingModel->getAll();

        // Fetch active tours (limited to 6)
        $tourModel = new Tour($this->db);
        $stmt = $tourModel->readAll();
        $allTours = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $activeTours = [];
        foreach($allTours as $t) {
            if ($t['status'] == 'active') {
                $activeTours[] = $t;
                if(count($activeTours) >= 6) break;
            }
        }

        // Fetch categories for search form
        $categories = $tourModel->getCategories();
        
        // Fetch price range for search form
        $priceRange = $tourModel->getPriceRange();

        $pageTitle = $settings['site_name'] ?? 'CloudJourney';
        require_once 'views/home/index.php';
    }
}
?>
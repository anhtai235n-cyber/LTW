<?php
require_once 'config/database.php';
require_once 'models/Setting.php';
require_once 'models/Tour.php';
require_once 'models/Booking.php';

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

        $bookings = [];
        if (isset($_SESSION['user_id']) && !empty($_SESSION['email'])) {
            $bookingModel = new Booking($this->db);
            $query = "SELECT b.*, t.name as tour_name FROM bookings b
                      LEFT JOIN tours t ON b.tour_id = t.id
                      WHERE b.customer_email = ?
                      ORDER BY b.created_at DESC
                      LIMIT 5";
            $stmtBooking = $this->db->prepare($query);
            $stmtBooking->bindParam(1, $_SESSION['email']);
            $stmtBooking->execute();
            $bookings = $stmtBooking->fetchAll(PDO::FETCH_ASSOC);
        }

        $pageTitle = $settings['site_name'] ?? 'CloudJourney';
        require_once 'views/home/index.php';
    }
}
?>
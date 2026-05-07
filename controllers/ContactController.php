<?php
require_once 'models/Contact.php';
require_once 'config/database.php';

class ContactController {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        $pageTitle = "Liên hệ với chúng tôi";
        require_once 'views/contact/index.php';
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $contactModel = new Contact($this->db);
            $contactModel->customer_name = $_POST['customer_name'];
            $contactModel->customer_email = $_POST['customer_email'];
            $contactModel->message = $_POST['message'];

            if ($contactModel->create()) {
                $success = "Cảm ơn bạn! Lời nhắn của bạn đã được gửi đi thành công. Chúng tôi sẽ phản hồi sớm nhất.";
            } else {
                $error = "Rất tiếc, đã có lỗi xảy ra trong quá trình gửi lời nhắn. Vui lòng thử lại sau.";
            }
            
            $pageTitle = "Liên hệ với chúng tôi";
            require_once 'views/contact/index.php';
        } else {
            // Chuyển hướng nếu không phải là POST request
            header("Location: /contact");
            exit;
        }
    }
}
?>
<?php
require_once 'config/database.php';
require_once 'models/Setting.php';

class AboutController {
    public function index() {
        $db = (new Database())->getConnection();
        $settingModel = new Setting($db);
        $settings = $settingModel->getAll();
        
        require_once 'views/about/index.php';
    }
}
?>
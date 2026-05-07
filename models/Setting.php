<?php
class Setting {
    private $conn;
    private $table_name = "site_settings";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả cài đặt dưới dạng mảng key => value
    public function getAll() {
        $query = "SELECT setting_key, setting_value FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $settings = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }

    // Cập nhật nhiều cài đặt cùng lúc
    public function updateMultiple($settings_data) {
        $query = "INSERT INTO " . $this->table_name . " (setting_key, setting_value) VALUES (:setting_key, :setting_value) ON DUPLICATE KEY UPDATE setting_value = :setting_value";
        $stmt = $this->conn->prepare($query);

        $success = true;
        foreach ($settings_data as $key => $value) {
            $stmt->bindParam(":setting_value", $value);
            $stmt->bindParam(":setting_key", $key);
            if (!$stmt->execute()) {
                $success = false;
            }
        }
        return $success;
    }
}
?>
<?php
require_once 'config/database.php';

$db = new Database();
$conn = $db->getConnection();

if ($conn) {
    echo "Kết nối PDO thành công!\n";
    
    // Test count tours
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM users");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Số lượng users: " . $result['count'] . "\n";
} else {
    echo "Kết nối PDO thất bại.\n";
}
?>
<?php
$host = "127.0.0.1";
$db_name = "cloudjourney_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
    echo "Kết nối PDO với 127.0.0.1 thành công!\n";
} catch(PDOException $exception) {
    echo "Lỗi 127.0.0.1: " . $exception->getMessage() . "\n";
}

$host2 = "localhost";
try {
    $conn2 = new PDO("mysql:host=" . $host2 . ";dbname=" . $db_name, $username, $password);
    echo "Kết nối PDO với localhost thành công!\n";
} catch(PDOException $exception) {
    echo "Lỗi localhost: " . $exception->getMessage() . "\n";
}
?>
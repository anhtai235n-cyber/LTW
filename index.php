<?php
// 1. Khởi tạo session và kết nối database [cite: 11, 73]
session_start();
require_once 'config/database.php';

// 2. Lấy URL để biết người dùng muốn vào trang nào [cite: 17]
// Ví dụ: localhost:4545/contact -> trang liên hệ
$url = isset($_GET['url']) ? $_GET['url'] : 'home';

// 3. Gọi Controller tương ứng (Tạm thời gọi thẳng View để bạn check giao diện)
if ($url == 'home') {
    include 'views/home/index.php'; // Load giao diện trang chủ bạn đã làm
} elseif ($url == 'contact') {
    include 'views/contact/index.php'; // Load giao diện trang liên hệ 
} else {
    echo "404 - Không tìm thấy trang";
}
?>
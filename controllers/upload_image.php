<?php
// Controller xử lý upload ảnh cho CKEditor
$upload_dir = "uploads/news/";
$url_path = "/uploads/news/";

// Tạo thư mục nếu chưa tồn tại
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (isset($_FILES['upload'])) {
    $file = $_FILES['upload'];
    $file_name = time() . '_' . basename($file['name']);
    $file_tmp = $file['tmp_name'];

    // Kiểm tra loại file
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (in_array($file['type'], $allowed_types)) {
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            echo json_encode([
                "url" => $url_path . $file_name
            ]);
        } else {
            echo json_encode(['error' => ['message' => 'Lỗi khi tải tệp']]);
        }
    } else {
        echo json_encode(['error' => ['message' => 'Chỉ hỗ trợ ảnh']]);
    }
}
?>
-- Bảng lưu trữ cấu hình trang web
-- 1. Tạo database mới nếu nó chưa tồn tại
CREATE DATABASE IF NOT EXISTS cloudjourney_db;

-- 2. Chỉ định cho MySQL rằng các lệnh bên dưới sẽ tác động vào db này
USE cloudjourney_db;
CREATE TABLE site_settings (
    setting_key VARCHAR(50) PRIMARY KEY,
    setting_value TEXT,
    description VARCHAR(255)
);

-- Bảng lưu trữ tin nhắn liên hệ từ khách
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert dữ liệu mặc định để Trang chủ có cái hiển thị
INSERT INTO site_settings (setting_key, setting_value, description) VALUES
('site_name', 'CloudJourney', 'Tên website'),
('hero_title', 'Khám phá hành trình tuyệt vời của bạn', 'Tiêu đề banner'),
('hero_image', 'uploads/hero_bg.jpg', 'Ảnh nền banner (phải upload)'),
('company_phone', '0901234567', 'Số điện thoại'),
('company_email', 'support@cloudjourney.vn', 'Email liên hệ'),
('company_address', 'Đại học Bách Khoa, TP.HCM', 'Địa chỉ');
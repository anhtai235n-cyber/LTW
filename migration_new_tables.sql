-- ========================================
-- MIGRATION: Thêm bảng cho tính năng mới
-- Date: 2026-04-20
-- Purpose: Thêm News, FAQ, Ratings, Comments
-- ========================================

-- 1. Bảng NEWS (Tin tức / Blog)
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    content LONGTEXT NOT NULL,
    description VARCHAR(255),
    keywords VARCHAR(255),
    image_url VARCHAR(255),
    author_id INT,
    status ENUM('published', 'draft') DEFAULT 'draft',
    views INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_created (created_at),
    FULLTEXT idx_search (title, content)
);

-- 2. Bảng NEWS_COMMENTS (Bình luận trên bài viết)
CREATE TABLE IF NOT EXISTS news_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    news_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (news_id) REFERENCES news(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_news (news_id),
    INDEX idx_status (status)
);

-- 3. Bảng FAQS (Hỏi/Đáp)
CREATE TABLE IF NOT EXISTS faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    answer TEXT NOT NULL,
    category VARCHAR(100),
    order_by INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_order (order_by)
);

-- 4. Bảng TOUR_RATINGS (Đánh giá/Review Tour)
CREATE TABLE IF NOT EXISTS tour_ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,
    user_id INT NOT NULL,
    rating DECIMAL(3,1) NOT NULL, -- 1.0 đến 5.0
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_tour (tour_id),
    INDEX idx_user (user_id),
    INDEX idx_rating (rating),
    UNIQUE KEY unique_rating (tour_id, user_id)
);

-- ========================================
-- Thêm cột mới cho bảng users (nếu chưa có)
-- ========================================
ALTER TABLE users ADD COLUMN IF NOT EXISTS phone VARCHAR(20);
ALTER TABLE users ADD COLUMN IF NOT EXISTS address TEXT;
ALTER TABLE users ADD COLUMN IF NOT EXISTS bio TEXT;

-- ========================================
-- Thêm dữ liệu mẫu
-- ========================================

-- Thêm FAQ mẫu
INSERT IGNORE INTO faqs (question, answer, category, order_by) VALUES
('CloudJourney là gì?', 'CloudJourney là nền tảng đặt tour trực tuyến hàng đầu ở Việt Nam, cung cấp các gói tour du lịch chất lượng cao với giá tốt nhất.', 'Giới thiệu', 1),
('Làm sao để đặt tour?', 'Bạn chỉ cần vào trang chi tiết tour, chọn ngày đi, số lượng khách, và tiến hành thanh toán. Sau đó đội ngũ của chúng tôi sẽ liên hệ xác nhận.', 'Đặt tour', 1),
('Có thể hủy tour không?', 'Bạn có thể hủy tour theo chính sách hủy của tour đó. Thông thường hủy trước 7-10 ngày sẽ hoàn 100% tiền.', 'Hủy tour', 2),
('Hỗ trợ bao lâu?', 'Đội hỗ trợ của CloudJourney luôn sẵn sàng 24/7 để trả lời mọi câu hỏi của bạn.', 'Hỗ trợ', 1),
('Tour có bao gồm ăn uống không?', 'Tùy vào tour. Hầu hết tour đều bao gồm ăn sáng, trưa, tối. Xem phần "Bao gồm" trong chi tiết tour.', 'Chi tiết tour', 3),
('Có giảm giá cho nhóm lớn không?', 'Có. Nhóm từ 10 người trở lên sẽ nhận được giảm giá đặc biệt. Liên hệ 0901234567 để được báo giá.', 'Giá tiền', 2);

-- Thêm bài viết tin tức mẫu
INSERT IGNORE INTO news (title, slug, content, description, keywords, image_url, author_id, status) VALUES
('Top 5 điểm đến không nên bỏ lỡ ở Việt Nam', 'top-5-diem-den-khong-nen-bo-lo-o-viet-nam', 
'Việt Nam có rất nhiều điểm đến tuyệt vời. Trong bài viết này, chúng tôi sẽ gợi ý 5 điểm đến mà bạn không nên bỏ lỡ: 1. Vịnh Hạ Long - Di sản thiên nhiên thế giới...',
'Khám phá 5 điểm đến đẹp nhất Việt Nam mà bạn nên ghé thăm',
'du lịch, Việt Nam, điểm đến, vịnh Hạ Long, Sapa',
'uploads/picture1.jfif', 1, 'published'),
('Hướng dẫn chuẩn bị cho chuyến du lịch dài ngày', 'huong-dan-chuan-bi-cho-chuyen-du-lich-dai-ngay',
'Đi du lịch lâu ngày cần chuẩn bị kỹ lưỡng. Dưới đây là những điều bạn cần chuẩn bị: 1. Giấy tờ và tài liệu... 2. Hành lý...',
'Những thứ cần chuẩn bị trước khi đi du lịch dài ngày',
'du lịch, chuẩn bị, hành lý, giấy tờ',
'uploads/picture2.jfif', 1, 'published'),
('CloudJourney ký hợp tác với 50 khách sạn 5 sao trên toàn quốc', 'cloudjourney-ky-hop-tac-voi-50-khach-san-5-sao',
'CloudJourney vui mừng thông báo đã ký hợp tác với 50 khách sạn 5 sao trên toàn quốc. Điều này sẽ giúp khách hàng...',
'CloudJourney mở rộng hợp tác khách sạn 5 sao',
'CloudJourney, khách sạn, hợp tác, du lịch',
'uploads/picture3.jfif', 1, 'published');

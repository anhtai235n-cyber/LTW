--
-- Cấu trúc cơ sở dữ liệu cho `cloudjourney_db`
-- Phiên bản hoàn thiện với dữ liệu mẫu
--

-- Bảng `users`: Lưu thông tin người dùng và admin
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role ENUM('admin', 'member') DEFAULT 'member',
    status ENUM('active', 'banned') DEFAULT 'active',
    avatar VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng `site_settings`: Lưu các cấu hình chung của website
CREATE TABLE IF NOT EXISTS site_settings (
    setting_key VARCHAR(50) PRIMARY KEY,
    setting_value TEXT,
    description VARCHAR(255)
);

-- Bảng `contacts`: Lưu tin nhắn liên hệ từ khách
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng `tours`: Lưu thông tin các tour du lịch (cấu trúc đã cập nhật)
CREATE TABLE IF NOT EXISTS tours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_code VARCHAR(20) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    duration VARCHAR(50) NULL,
    location VARCHAR(100) NULL,
    status ENUM('active', 'hidden') DEFAULT 'active',
    image_url VARCHAR(255) DEFAULT NULL,
    description TEXT,
    highlights TEXT,
    itinerary TEXT,
    policy TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng `tour_images`: Lưu thư viện ảnh cho mỗi tour
CREATE TABLE IF NOT EXISTS tour_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    is_primary BOOLEAN DEFAULT 0,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

-- Bảng `bookings`: Lưu thông tin các đơn đặt tour
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NULL,
    customer_name VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    booking_date DATE NOT NULL,
    guests INT NOT NULL DEFAULT 1,
    total_price DECIMAL(12,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE SET NULL
);

--
-- CHÈN DỮ LIỆU MẶC ĐỊNH VÀ DỮ LIỆU MẪU
--

-- Dữ liệu mặc định cho user admin và cài đặt
INSERT IGNORE INTO users (username, password, fullname, email, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@cloudjourney.vn', 'admin'); -- Mật khẩu: password

INSERT IGNORE INTO site_settings (setting_key, setting_value, description) VALUES
('site_name', 'CloudJourney', 'Tên website'),
('hero_title', 'Khám phá hành trình tuyệt vời của bạn', 'Tiêu đề banner'),
('hero_image', 'uploads/picture1.jfif', 'Ảnh nền banner'),
('company_phone', '0901234567', 'Số điện thoại'),
('company_email', 'support@cloudjourney.vn', 'Email liên hệ'),
('company_address', 'Đại học Bách Khoa, TP.HCM', 'Địa chỉ');

-- Dữ liệu mẫu cho 10 tour
INSERT INTO tours (tour_code, name, category, price, duration, location, status, image_url, description, highlights, itinerary, policy) VALUES
('CJ-VN-001', 'Khám Phá Vịnh Hạ Long - Du Thuyền 5 Sao', 'Nghỉ dưỡng', 2500000.00, '2 Ngày 1 Đêm', 'Hạ Long, Việt Nam', 'active', 'uploads/halong.jpg', 'Trải nghiệm một đêm trên du thuyền sang trọng tại Vịnh Hạ Long, di sản thiên nhiên thế giới. Thưởng thức hải sản tươi ngon, chèo kayak và khám phá hang Sửng Sốt.', 'Ngủ đêm trên du thuyền 5 sao\nTham quan hang Sửng Sốt\nChèo thuyền kayak tại khu vực Hang Luồn\nLớp học nấu ăn và tiệc Sunset Party', 'Ngày 1: Hà Nội - Hạ Long, nhận phòng du thuyền, ăn trưa, chèo kayak.\nNgày 2: Thăm hang Sửng Sốt, ăn sáng, trả phòng, về Hà Nội.', 'Hủy trước 7 ngày hoàn 100%. Hủy trong vòng 7 ngày không hoàn tiền.'),
('CJ-VN-002', 'Chinh Phục Fansipan - Sapa Mùa Mây', 'Khám phá', 3200000.00, '3 Ngày 2 Đêm', 'Sapa, Việt Nam', 'active', 'uploads/sapa.jpg', 'Hành trình chinh phục nóc nhà Đông Dương và khám phá vẻ đẹp hùng vĩ của Sapa. Tham quan bản Cát Cát, thưởng thức đặc sản núi rừng và săn mây.', 'Chinh phục đỉnh Fansipan bằng cáp treo\nTham quan bản Cát Cát của người H''Mông\nCheck-in tại Cổng Trời Ô Quy Hồ\nThưởng thức lẩu cá tầm', 'Ngày 1: Hà Nội - Sapa, check-in khách sạn.\nNgày 2: Chinh phục Fansipan, thăm nhà thờ Đá.\nNgày 3: Tham quan bản Cát Cát, mua sắm, về Hà Nội.', 'Hủy trước 10 ngày hoàn 100%. Hủy trong vòng 10 ngày phạt 50%.'),
('CJ-VN-003', 'Đà Nẵng - Hội An - Bà Nà Hills', 'Giải trí', 4500000.00, '4 Ngày 3 Đêm', 'Đà Nẵng, Việt Nam', 'active', 'uploads/danang.jpg', 'Khám phá thành phố đáng sống nhất Việt Nam với bãi biển Mỹ Khê, Cầu Vàng, và phố cổ Hội An lung linh về đêm.', 'Vui chơi tại Bà Nà Hills và Cầu Vàng\nĐi dạo phố cổ Hội An\nTắm biển Mỹ Khê\nThưởng thức ẩm thực Đà Nẵng', 'Ngày 1: Đến Đà Nẵng, tắm biển.\nNgày 2: Khám phá Bà Nà Hills.\nNgày 3: Ngũ Hành Sơn, Phố cổ Hội An.\nNgày 4: Mua sắm, ra sân bay.', 'Chính sách hủy linh hoạt, vui lòng liên hệ để biết chi tiết.'),
('CJ-VN-004', 'Đà Lạt - Thành Phố Ngàn Hoa', 'Nghỉ dưỡng', 2800000.00, '3 Ngày 2 Đêm', 'Đà Lạt, Việt Nam', 'active', 'uploads/dalat.jpg', 'Tận hưởng không khí se lạnh và vẻ đẹp lãng mạn của Đà Lạt. Tham quan các vườn hoa, thác nước và thưởng thức cà phê phố núi.', 'Săn mây tại Đồi chè Cầu Đất\nTham quan vườn hoa thành phố\nCheck-in tại quảng trường Lâm Viên\nThưởng thức ẩm thực chợ đêm Đà Lạt', 'Ngày 1: Đến Đà Lạt, nhận phòng, tự do khám phá.\nNgày 2: Tham quan các điểm nổi tiếng: Thác Datanla, Vườn hoa, Dinh Bảo Đại.\nNgày 3: Mua sắm đặc sản, ra sân bay.', 'Hủy trước 5 ngày hoàn 100%.'),
('CJ-VN-005', 'Phú Quốc - Thiên Đường Biển Đảo', 'Nghỉ dưỡng', 5500000.00, '4 Ngày 3 Đêm', 'Phú Quốc, Việt Nam', 'active', 'uploads/phuquoc.jpg', 'Thư giãn trên những bãi biển cát trắng mịn, lặn ngắm san hô và khám phá các hòn đảo hoang sơ tại Phú Quốc.', 'Lặn ngắm san hô tại Hòn Thơm\nTham quan nhà tù Phú Quốc\nThư giãn tại Bãi Sao\nVui chơi tại VinWonders', 'Ngày 1: Đến Phú Quốc, nhận phòng.\nNgày 2: Tour 4 đảo, lặn ngắm san hô.\nNgày 3: Khám phá Bắc đảo: VinWonders, Safari.\nNgày 4: Tự do, ra sân bay.', 'Hủy trước 15 ngày hoàn 100%. Hủy trong vòng 15 ngày phạt 30%.'),
('CJ-QT-001', 'Hàn Quốc Mùa Thu: Seoul - Nami - Everland', 'Văn hóa', 15990000.00, '5 Ngày 4 Đêm', 'Hàn Quốc', 'active', 'uploads/korea.jpg', 'Đắm chìm trong sắc lá đỏ lãng mạn của mùa thu Hàn Quốc. Khám phá cung điện Gyeongbok, đảo Nami và công viên giải trí Everland.', 'Mặc Hanbok chụp ảnh tại cung điện Gyeongbok\nĐi dạo trên đảo Nami lãng mạn\nThỏa sức vui chơi tại Everland\nShopping tại Myeongdong', 'Ngày 1: Bay đến Seoul.\nNgày 2: Tham quan cung điện, làng cổ Bukchon.\nNgày 3: Khám phá đảo Nami.\nNgày 4: Vui chơi tại Everland, mua sắm.\nNgày 5: Ra sân bay về Việt Nam.', 'Yêu cầu có visa Hàn Quốc. Không hoàn hủy sau khi đã đặt.'),
('CJ-QT-002', 'Nhật Bản Mùa Hoa Anh Đào: Tokyo - Kyoto - Osaka', 'Văn hóa', 35500000.00, '7 Ngày 6 Đêm', 'Nhật Bản', 'active', 'uploads/japan.jpg', 'Hành trình ngắm hoa anh đào nở rộ trên khắp các thành phố nổi tiếng của Nhật Bản. Trải nghiệm văn hóa độc đáo và ẩm thực tinh tế.', 'Ngắm hoa anh đào tại công viên Ueno\nTham quan chùa Vàng Kinkaku-ji ở Kyoto\nTrải nghiệm tàu Shinkansen\nKhám phá khu Dotonbori ở Osaka', 'Ngày 1-2: Tokyo, núi Phú Sĩ.\nNgày 3-4: Di chuyển đến Kyoto, tham quan chùa chiền.\nNgày 5-6: Khám phá Osaka, Nara.\nNgày 7: Bay về Việt Nam.', 'Yêu cầu có visa Nhật Bản. Không hoàn hủy sau khi đã đặt.'),
('CJ-QT-003', 'Thái Lan: Bangkok - Pattaya - Chợ Nổi', 'Giải trí', 6990000.00, '5 Ngày 4 Đêm', 'Thái Lan', 'active', 'uploads/thailand.jpg', 'Khám phá sự sôi động của Bangkok và vẻ đẹp của thành phố biển Pattaya. Thưởng thức show diễn, mua sắm và các món ăn đường phố.', 'Tham quan Cung điện Hoàng Gia Thái Lan\nĐi thuyền trên sông Chao Phraya\nXem Alcazar Show tại Pattaya\nKhám phá chợ nổi Damnoen Saduak', 'Ngày 1: Đến Bangkok, di chuyển đến Pattaya.\nNgày 2: Đảo san hô Coral, xem show.\nNgày 3: Về Bangkok, tham quan chùa.\nNgày 4: Chợ nổi, tự do mua sắm.\nNgày 5: Ra sân bay về Việt Nam.', 'Giá tour không bao gồm chi phí cá nhân. Hủy trước 10 ngày hoàn 70%.'),
('CJ-VN-006', 'Hà Giang - Cung Đường Hạnh Phúc', 'Khám phá', 3800000.00, '4 Ngày 3 Đêm', 'Hà Giang, Việt Nam', 'hidden', 'uploads/hagiang.jpg', 'Chinh phục những cung đường đèo hiểm trở và hùng vĩ nhất Việt Nam. Ngắm nhìn sông Nho Quế và cột cờ Lũng Cú.', 'Chinh phục đèo Mã Pí Lèng\nĐi thuyền trên sông Nho Quế\nCheck-in Cột cờ Lũng Cú\nTham quan Dinh thự họ Vương', 'Ngày 1: Hà Nội - Hà Giang.\nNgày 2: Quản Bạ - Yên Minh - Đồng Văn.\nNgày 3: Lũng Cú - Mã Pí Lèng - Mèo Vạc.\nNgày 4: Mèo Vạc - Hà Nội.', 'Tour mạo hiểm, yêu cầu sức khỏe tốt.'),
('CJ-VN-007', 'Miền Tây Sông Nước: Cần Thơ - Châu Đốc', 'Văn hóa', 2200000.00, '2 Ngày 1 Đêm', 'Miền Tây, Việt Nam', 'active', 'uploads/mientay.jpg', 'Trải nghiệm cuộc sống sông nước đặc trưng của miền Tây. Đi chợ nổi, nghe đờn ca tài tử và thưởng thức trái cây tại vườn.', 'Đi chợ nổi Cái Răng\nTham quan miếu Bà Chúa Xứ\nThưởng thức trái cây tại vườn\nNghe đờn ca tài tử trên sông', 'Ngày 1: Sài Gòn - Cần Thơ, tham quan nhà cổ, bến Ninh Kiều.\nNgày 2: Đi chợ nổi Cái Răng, đến Châu Đốc, về lại Sài Gòn.', 'Tour khởi hành cuối tuần.');


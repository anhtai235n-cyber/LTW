<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Tour.php';

$db = (new Database())->getConnection();
$tourModel = new Tour($db);

$tour_id = isset($_GET['tour_id']) ? (int)$_GET['tour_id'] : 0;
$date = $_GET['date'] ?? date('Y-m-d');
$guests = isset($_GET['guests']) ? max(1, (int)$_GET['guests']) : 1;

if ($tour_id <= 0) {
    header('Location: /index.php?url=home');
    exit;
}

$tourModel->id = $tour_id;
if (!$tourModel->readOne()) {
    header('Location: /index.php?url=home');
    exit;
}

$total_price = $tourModel->price * $guests;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán & Đặt Tour | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="/public/css/scrollAnimations.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 1; }
    </style>
    <link rel="stylesheet" href="/public/css/scrollAnimations.css">
</head>
<body class="text-slate-800 antialiased">

<div class="max-w-6xl mx-auto px-4 py-12 scroll-reveal reveal-from-bottom reveal-delay-150">
    <div class="mb-8">
        <a href="/index.php?url=tour&id=<?= $tour_id ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition">
            <span class="material-symbols-outlined text-sm mr-1">arrow_back</span> Quay lại chi tiết tour
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 mt-4">Hoàn tất đặt tour của bạn</h1>
        <p class="text-slate-500 mt-2">Vui lòng điền thông tin để xác nhận giữ chỗ.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Form thông tin -->
        <div class="lg:col-span-7 space-y-8">
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-blue-600">person</span> Thông tin liên hệ
                </h2>
                <form action="/index.php?url=booking_submit" method="POST" class="space-y-5">
                    <input type="hidden" name="tour_id" value="<?= $tour_id ?>">
                    <input type="hidden" name="booking_date" value="<?= htmlspecialchars($date) ?>">
                    <input type="hidden" name="guests" value="<?= (int)$guests ?>">
                    <input type="hidden" name="total_price" value="<?= $total_price ?>">
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Họ và tên người đặt *</label>
                        <input type="text" name="customer_name" required value="<?= $_SESSION['fullname'] ?? '' ?>" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600/50 outline-none" placeholder="Nhập họ và tên...">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Số điện thoại *</label>
                            <input type="tel" name="customer_phone" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600/50 outline-none" placeholder="0901234567">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Email *</label>
                            <input type="email" name="customer_email" required value="<?= $_SESSION['email'] ?? '' ?>" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600/50 outline-none" placeholder="email@example.com">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-5 mt-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Địa điểm khởi hành *</label>
                            <input type="text" name="departure_location" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600/50 outline-none" placeholder="Ví dụ: Hà Nội, Sài Gòn, Đà Nẵng...">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Phương thức di chuyển *</label>
                            <select name="transport_method" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600/50 outline-none bg-white">
                                <option value="">Chọn phương thức</option>
                                <option value="Ô tô">Ô tô</option>
                                <option value="Máy bay">Máy bay</option>
                                <option value="Tàu hỏa">Tàu hỏa</option>
                                <option value="Xe buýt">Xe buýt</option>
                                <option value="Tự túc">Tự túc</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Yêu cầu đặc biệt</label>
                            <textarea name="special_requests" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600/50 outline-none" placeholder="Nhập yêu cầu đặc biệt, thực đơn, chỗ ngồi, hỗ trợ hành lý..."></textarea>
                        </div>
                    </div>
                    
                    <h2 class="text-xl font-bold text-slate-900 mt-10 mb-6 flex items-center gap-2 pt-6 border-t border-slate-100">
                        <span class="material-symbols-outlined text-blue-600">payments</span> Phương thức thanh toán
                    </h2>
                    <div class="space-y-4">
                        <label class="flex items-center gap-4 p-4 border border-blue-600 bg-blue-50 rounded-xl cursor-pointer">
                            <input type="radio" name="payment_method" value="transfer" checked class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                            <div>
                                <p class="font-bold text-slate-900">Chuyển khoản ngân hàng</p>
                                <p class="text-sm text-slate-500">Thanh toán an toàn qua tài khoản công ty.</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-4 p-4 border border-slate-200 hover:bg-slate-50 rounded-xl cursor-pointer transition">
                            <input type="radio" name="payment_method" value="office" class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                            <div>
                                <p class="font-bold text-slate-900">Thanh toán tại văn phòng</p>
                                <p class="text-sm text-slate-500">Đến trực tiếp văn phòng CloudJourney để thanh toán.</p>
                            </div>
                        </label>
                    </div>
                    
                    <button type="submit" class="w-full mt-8 py-4 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-2xl shadow-lg shadow-orange-500/30 transition hover:-translate-y-1 text-lg">Xác nhận Đặt Tour</button>
                </form>
            </div>
        </div>

        <!-- Tóm tắt Tour -->
        <div class="lg:col-span-5">
            <div class="bg-white rounded-[2rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-200 sticky top-10">
                <h3 class="text-xl font-bold text-slate-900 mb-6">Tóm tắt chuyến đi</h3>
                <img src="/<?= htmlspecialchars($tourModel->image_url ?? 'uploads/picture1.jfif') ?>" class="w-full h-48 object-cover rounded-2xl mb-6" alt="Tour">
                
                <h4 class="text-lg font-bold text-slate-900 mb-2"><?= htmlspecialchars($tourModel->name) ?></h4>
                <p class="text-sm text-slate-500 mb-6 flex items-center gap-1"><span class="material-symbols-outlined text-sm">location_on</span> <?= htmlspecialchars($tourModel->location ?? 'Đang cập nhật') ?></p>
                
                <div class="space-y-4 text-sm text-slate-600 border-t border-slate-100 pt-6">
                    <div class="flex justify-between"><span>Ngày khởi hành:</span> <span class="font-semibold text-slate-900"><?= date('d/m/Y', strtotime($date)) ?></span></div>
                    <div class="flex justify-between"><span>Thời gian:</span> <span class="font-semibold text-slate-900"><?= htmlspecialchars($tourModel->duration ?? 'Đang cập nhật') ?></span></div>
                    <div class="flex justify-between"><span>Số hành khách:</span> <span class="font-semibold text-slate-900"><?= htmlspecialchars($guests) ?> Người</span></div>
                    <div class="flex justify-between"><span>Địa điểm khởi hành:</span> <span class="font-semibold text-slate-900">Chọn tại trang đặt</span></div>
                    <div class="flex justify-between"><span>Phương thức:</span> <span class="font-semibold text-slate-900">Chọn tại trang đặt</span></div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-slate-100 flex justify-between items-end">
                    <span class="text-slate-500">Tổng tiền</span>
                    <span class="text-3xl font-extrabold text-blue-700"><?= number_format((float)$total_price, 0, ',', '.') ?>đ</span>
                </div>
            </div>
        </div>
    </div>
</div>

    <script defer src="/public/js/scrollAnimations.js"></script>
</body>
</html>
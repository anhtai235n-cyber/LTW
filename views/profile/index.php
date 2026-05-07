<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Cá Nhân | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>
</head>
<body class="bg-[#faf8ff] text-slate-800 font-sans">
    <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="index.php?url=home" class="text-2xl font-bold text-slate-900">CloudJourney</a>
            <a href="index.php?url=home" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                <span class="material-symbols-outlined text-sm mr-1">arrow_back</span> Quay lại
            </a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-12">
        <?php if(isset($user) && isset($action)): ?>
            <?php if($action === 'index'): ?>
                <!-- View Profile -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left: Profile Info -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden sticky top-24">
                            <!-- Cover Image -->
                            <div class="h-32 bg-gradient-to-r from-blue-500 to-blue-700"></div>

                            <!-- Profile Content -->
                            <div class="relative px-6 pb-6">
                                <!-- Avatar -->
                                <div class="flex justify-center -mt-16 mb-4">
                                    <?php if(!empty($user['avatar'])): ?>
                                        <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="<?= htmlspecialchars($user['fullname'] ?? $user['name']) ?>"
                                             class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover">
                                    <?php else: ?>
                                        <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg bg-slate-300 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-6xl text-slate-500">person</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- User Info -->
                                <h1 class="text-2xl font-bold text-center text-slate-900 mb-1">
                                    <?= htmlspecialchars($user['fullname'] ?? $user['name']) ?>
                                </h1>
                                <p class="text-center text-slate-500 mb-6">
                                    <?= htmlspecialchars($user['email']) ?>
                                </p>

                                <!-- Info Items -->
                                <div class="space-y-4 mb-6 pb-6 border-b border-slate-200">
                                    <div class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-blue-700 text-sm">phone</span>
                                        <div>
                                            <p class="text-xs text-slate-500 uppercase">Điện thoại</p>
                                            <p class="font-semibold text-slate-900"><?= htmlspecialchars($user['phone'] ?? 'Chưa cập nhật') ?></p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-blue-700 text-sm">location_on</span>
                                        <div>
                                            <p class="text-xs text-slate-500 uppercase">Địa chỉ</p>
                                            <p class="font-semibold text-slate-900"><?= htmlspecialchars($user['address'] ?? 'Chưa cập nhật') ?></p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <span class="material-symbols-outlined text-blue-700 text-sm">calendar_today</span>
                                        <div>
                                            <p class="text-xs text-slate-500 uppercase">Tham gia</p>
                                            <p class="font-semibold text-slate-900"><?= date('d/m/Y', strtotime($user['created_at'] ?? 'now')) ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="space-y-2">
                                    <a href="index.php?url=profile/update" 
                                       class="block w-full text-center bg-blue-700 hover:bg-blue-800 text-white font-semibold px-4 py-2 rounded-lg transition">
                                        <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">edit</span> Chỉnh Sửa Thông Tin
                                    </a>
                                    <a href="index.php?url=profile/changePassword" 
                                       class="block w-full text-center bg-slate-700 hover:bg-slate-800 text-white font-semibold px-4 py-2 rounded-lg transition">
                                        <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">lock</span> Đổi Mật Khẩu
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Booking History -->
                    <div class="lg:col-span-2">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined">receipt_long</span>
                            Lịch Sử Đặt Tour (<?= isset($bookings) ? count($bookings) : 0 ?>)
                        </h2>

                        <?php if(isset($bookings) && count($bookings) > 0): ?>
                            <div class="space-y-4">
                                <?php foreach($bookings as $booking): ?>
                                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition border border-slate-200 overflow-hidden">
                                        <div class="p-6">
                                            <div class="flex items-start justify-between mb-4">
                                                <div>
                                                    <h3 class="text-lg font-bold text-slate-900">
                                                        <?= htmlspecialchars($booking['tour_name']) ?>
                                                    </h3>
                                                    <p class="text-sm text-slate-500">
                                                        Mã đặt tour: <?= htmlspecialchars($booking['booking_code'] ?? 'N/A') ?>
                                                    </p>
                                                </div>
                                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                                    <?php 
                                                    switch($booking['status'] ?? '') {
                                                        case 'confirmed': echo 'bg-green-100 text-green-700'; break;
                                                        case 'pending': echo 'bg-yellow-100 text-yellow-700'; break;
                                                        case 'cancelled': echo 'bg-red-100 text-red-700'; break;
                                                        default: echo 'bg-slate-100 text-slate-700';
                                                    }
                                                    ?>">
                                                    <?php 
                                                    $status_map = [
                                                        'confirmed' => 'Đã xác nhận',
                                                        'pending' => 'Chờ xác nhận',
                                                        'cancelled' => 'Đã hủy'
                                                    ];
                                                    echo htmlspecialchars($status_map[$booking['status'] ?? ''] ?? 'Không rõ');
                                                    ?>
                                                </span>
                                            </div>

                                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                                <div>
                                                    <p class="text-xs text-slate-500 uppercase">Ngày khởi hành</p>
                                                    <p class="font-semibold text-slate-900">
                                                        <?= date('d/m/Y', strtotime($booking['departure_date'] ?? 'now')) ?>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-slate-500 uppercase">Số người</p>
                                                    <p class="font-semibold text-slate-900">
                                                        <?= htmlspecialchars($booking['number_of_people'] ?? '0') ?> người
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-slate-500 uppercase">Tổng tiền</p>
                                                    <p class="font-bold text-orange-600">
                                                        <?= number_format((float)($booking['total_price'] ?? 0), 0, ',', '.') ?>đ
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-slate-500 uppercase">Ngày đặt</p>
                                                    <p class="font-semibold text-slate-900">
                                                        <?= date('d/m/Y', strtotime($booking['booking_date'] ?? 'now')) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-12 bg-white rounded-xl border border-slate-200">
                                <span class="material-symbols-outlined text-6xl text-slate-300 block mb-4">card_travel</span>
                                <p class="text-slate-500 text-lg">Bạn chưa đặt tour nào.</p>
                                <a href="index.php?url=search" class="inline-block mt-4 bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-2 rounded-lg transition">
                                    Khám Phá Tour
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            <?php elseif($action === 'update'): ?>
                <!-- Edit Profile Form -->
                <div class="max-w-2xl mx-auto">
                    <h1 class="text-3xl font-bold text-slate-900 mb-8">Chỉnh Sửa Hồ Sơ</h1>

                    <form method="POST" action="index.php?url=profile/update" enctype="multipart/form-data" 
                          class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 space-y-6">

                        <!-- Avatar -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3">Ảnh Đại Diện</label>
                            <div class="flex gap-6 items-end">
                                <div class="w-32 h-32 rounded-full bg-slate-200 border-4 border-white shadow-lg overflow-hidden flex-shrink-0">
                                    <?php if(!empty($user['avatar'])): ?>
                                        <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-slate-300">
                                            <span class="material-symbols-outlined text-4xl text-slate-500">person</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <input type="file" name="avatar" accept="image/*" class="flex-1 px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Họ và Tên</label>
                            <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname'] ?? $user['name']) ?>" required
                                   class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Email (Read-only) -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                            <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled
                                   class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-slate-50 text-slate-500">
                            <p class="text-xs text-slate-500 mt-1">Không thể thay đổi email. Liên hệ admin nếu cần.</p>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Số Điện Thoại</label>
                            <input type="tel" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" 
                                   class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="0901234567">
                        </div>

                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Địa Chỉ</label>
                            <input type="text" name="address" value="<?= htmlspecialchars($user['address'] ?? '') ?>"
                                   class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="123 Đường ABC, Quận XYZ, TP HCM">
                        </div>

                        <!-- Bio -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Giới Thiệu</label>
                            <textarea name="bio" rows="4"
                                      class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Chia sẻ một chút về bản thân..."><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 pt-4 border-t border-slate-200">
                            <button type="submit" class="flex-1 bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                                <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">check</span> Lưu Thay Đổi
                            </button>
                            <a href="index.php?url=profile" class="flex-1 text-center bg-slate-200 hover:bg-slate-300 text-slate-900 font-semibold px-6 py-3 rounded-lg transition">
                                <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">close</span> Hủy Bỏ
                            </a>
                        </div>
                    </form>
                </div>

            <?php elseif($action === 'changePassword'): ?>
                <!-- Change Password Form -->
                <div class="max-w-2xl mx-auto">
                    <h1 class="text-3xl font-bold text-slate-900 mb-8">Đổi Mật Khẩu</h1>

                    <form method="POST" action="index.php?url=profile/changePassword"
                          class="bg-white rounded-2xl shadow-lg border border-slate-200 p-8 space-y-6">

                        <!-- Old Password -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Mật Khẩu Hiện Tại</label>
                            <input type="password" name="old_password" required
                                   class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Nhập mật khẩu hiện tại">
                        </div>

                        <!-- New Password -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Mật Khẩu Mới</label>
                            <input type="password" name="new_password" required
                                   class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Nhập mật khẩu mới (tối thiểu 8 ký tự)">
                            <p class="text-xs text-slate-500 mt-1">Mật khẩu phải có ít nhất 8 ký tự</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Xác Nhận Mật Khẩu</label>
                            <input type="password" name="confirm_password" required
                                   class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Xác nhận mật khẩu mới">
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 pt-4 border-t border-slate-200">
                            <button type="submit" class="flex-1 bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                                <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">check</span> Đổi Mật Khẩu
                            </button>
                            <a href="index.php?url=profile" class="flex-1 text-center bg-slate-200 hover:bg-slate-300 text-slate-900 font-semibold px-6 py-3 rounded-lg transition">
                                <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">close</span> Hủy Bỏ
                            </a>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <!-- Not logged in or error -->
            <div class="text-center py-20">
                <span class="material-symbols-outlined text-8xl text-slate-300 block mb-4">lock</span>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Truy Cập Bị Từ Chối</h2>
                <p class="text-slate-600 mb-6">Vui lòng đăng nhập để xem hồ sơ cá nhân.</p>
                <a href="index.php?url=login" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                    <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">login</span> Đăng Nhập
                </a>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Hồ Sơ | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>
    <link rel="stylesheet" href="/public/css/scrollAnimations.css">
</head>
<body class="bg-[#faf8ff] text-slate-800 font-sans">
    <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="index.php?url=profile" class="text-2xl font-bold text-slate-900">CloudJourney</a>
            <a href="index.php?url=profile" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                <span class="material-symbols-outlined text-sm mr-1">arrow_back</span> Quay lại hồ sơ
            </a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12 scroll-reveal reveal-from-bottom reveal-delay-150">
        <?php if(isset($user) && isset($action)): ?>
            <?php if($action === 'update'): ?>
                <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-700 px-8 py-6">
                        <h1 class="text-2xl font-bold text-white">Chỉnh Sửa Hồ Sơ</h1>
                        <p class="text-blue-100 mt-1">Cập nhật thông tin cá nhân của bạn</p>
                    </div>

                    <form action="index.php?url=profile/update" method="POST" enctype="multipart/form-data" class="p-8">
                        <?php if(isset($_SESSION['profile_error'])): ?>
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-red-700 font-semibold">Lỗi!</p>
                                <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($_SESSION['profile_error']) ?></p>
                            </div>
                            <?php unset($_SESSION['profile_error']); ?>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['profile_success'])): ?>
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <p class="text-green-700 font-semibold">Thành công!</p>
                                <p class="text-green-600 text-sm mt-1"><?= htmlspecialchars($_SESSION['profile_success']) ?></p>
                            </div>
                            <?php unset($_SESSION['profile_success']); ?>
                        <?php endif; ?>

                        <!-- Avatar Section -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-slate-700 mb-4">Ảnh Đại Diện</label>
                            <div class="flex items-center gap-6">
                                <div class="relative">
                                    <?php if(!empty($user['avatar'])): ?>
                                        <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar"
                                             class="w-24 h-24 rounded-full border-4 border-slate-200 object-cover">
                                    <?php else: ?>
                                        <div class="w-24 h-24 rounded-full border-4 border-slate-200 bg-slate-300 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-4xl text-slate-500">person</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="avatar" accept="image/*"
                                           class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p class="text-xs text-slate-500 mt-2">Chọn ảnh JPG, PNG hoặc GIF. Kích thước tối đa 5MB.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="fullname" class="block text-sm font-semibold text-slate-700 mb-2">Họ và Tên *</label>
                                <input type="text" id="fullname" name="fullname" required
                                       value="<?= htmlspecialchars($user['fullname'] ?? '') ?>"
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email *</label>
                                <input type="email" id="email" name="email" required
                                       value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-slate-700 mb-2">Số Điện Thoại</label>
                                <input type="tel" id="phone" name="phone"
                                       value="<?= htmlspecialchars($user['phone'] ?? '') ?>"
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label for="username" class="block text-sm font-semibold text-slate-700 mb-2">Tên Đăng Nhập</label>
                                <input type="text" id="username" readonly
                                       value="<?= htmlspecialchars($user['username'] ?? '') ?>"
                                       class="w-full px-4 py-3 border border-slate-300 rounded-lg bg-slate-50 text-slate-500 cursor-not-allowed">
                                <p class="text-xs text-slate-500 mt-1">Không thể thay đổi tên đăng nhập</p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-8">
                            <label for="address" class="block text-sm font-semibold text-slate-700 mb-2">Địa Chỉ</label>
                            <textarea id="address" name="address" rows="3"
                                      class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                      placeholder="Nhập địa chỉ của bạn..."><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                        </div>

                        <!-- Bio -->
                        <div class="mb-8">
                            <label for="bio" class="block text-sm font-semibold text-slate-700 mb-2">Giới Thiệu Bản Thân</label>
                            <textarea id="bio" name="bio" rows="4"
                                      class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                      placeholder="Hãy cho mọi người biết về bạn..."><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                                <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">save</span>
                                Lưu Thay Đổi
                            </button>
                            <a href="index.php?url=profile" class="px-6 py-3 border border-slate-300 text-slate-700 font-semibold rounded-lg hover:bg-slate-50 transition">
                                Hủy
                            </a>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </main>
    <script defer src="/public/js/scrollAnimations.js"></script>
</body>
</html>
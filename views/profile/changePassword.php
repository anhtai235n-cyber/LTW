<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu | CloudJourney</title>
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

    <main class="max-w-2xl mx-auto px-6 py-12 scroll-reveal reveal-from-bottom reveal-delay-150">
        <?php if(isset($user) && isset($action)): ?>
            <?php if($action === 'changePassword'): ?>
                <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-700 to-slate-900 px-8 py-6">
                        <h1 class="text-2xl font-bold text-white">Đổi Mật Khẩu</h1>
                        <p class="text-slate-300 mt-1">Cập nhật mật khẩu bảo mật tài khoản của bạn</p>
                    </div>

                    <form action="index.php?url=profile/changePassword" method="POST" class="p-8">
                        <?php if(isset($_SESSION['password_error'])): ?>
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-red-700 font-semibold">Lỗi!</p>
                                <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($_SESSION['password_error']) ?></p>
                            </div>
                            <?php unset($_SESSION['password_error']); ?>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['password_success'])): ?>
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <p class="text-green-700 font-semibold">Thành công!</p>
                                <p class="text-green-600 text-sm mt-1"><?= htmlspecialchars($_SESSION['password_success']) ?></p>
                            </div>
                            <?php unset($_SESSION['password_success']); ?>
                        <?php endif; ?>

                        <!-- Current Password -->
                        <div class="mb-6">
                            <label for="current_password" class="block text-sm font-semibold text-slate-700 mb-2">Mật Khẩu Hiện Tại *</label>
                            <input type="password" id="current_password" name="current_password" required
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition"
                                   placeholder="Nhập mật khẩu hiện tại">
                        </div>

                        <!-- New Password -->
                        <div class="mb-6">
                            <label for="new_password" class="block text-sm font-semibold text-slate-700 mb-2">Mật Khẩu Mới *</label>
                            <input type="password" id="new_password" name="new_password" required
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition"
                                   placeholder="Nhập mật khẩu mới (tối thiểu 6 ký tự)"
                                   minlength="6">
                            <p class="text-xs text-slate-500 mt-1">Mật khẩu phải có ít nhất 6 ký tự</p>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-8">
                            <label for="confirm_password" class="block text-sm font-semibold text-slate-700 mb-2">Xác Nhận Mật Khẩu Mới *</label>
                            <input type="password" id="confirm_password" name="confirm_password" required
                                   class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition"
                                   placeholder="Nhập lại mật khẩu mới">
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-slate-700 hover:bg-slate-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                                <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">lock</span>
                                Đổi Mật Khẩu
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
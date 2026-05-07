<?php require_once 'config/CsrfToken.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= isset($pageTitle) ? $pageTitle : 'Đăng nhập' ?> - CloudJourney</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-blue-900">CloudJourney</h1>
            <p class="text-gray-500 mt-2">Chào mừng bạn quay trở lại</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= htmlspecialchars($error) ?></span>
            </div>
        <?php endif; ?>

        <?php if(isset($success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?= htmlspecialchars($success) ?></span>
            </div>
        <?php endif; ?>

        <form action="/login" method="POST" class="space-y-6">
            <?php echo CsrfToken::field(); ?>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Tên đăng nhập</label>
                <input type="text" name="username" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="Nhập username">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Mật khẩu</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="••••••••">
            </div>
            <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition-colors shadow-md">Đăng nhập</button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Chưa có tài khoản? <a href="/register" class="text-blue-600 font-bold hover:underline">Đăng ký ngay</a>
        </p>
    </div>
</body>
</html>
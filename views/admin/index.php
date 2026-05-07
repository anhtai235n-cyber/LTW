<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans">
    <!-- Admin Header -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-slate-900">Admin Dashboard</h1>
            <a href="index.php?url=home" class="flex items-center text-slate-600 hover:text-slate-900">
                <span class="material-symbols-outlined text-sm mr-2">home</span> Trang chủ
            </a>
        </div>
    </nav>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-900 text-white p-6 overflow-y-auto">
            <h2 class="text-xl font-bold mb-8">CloudJourney Admin</h2>
            <nav class="space-y-2">
                <a href="index.php?url=admin" class="block px-4 py-3 rounded-lg text-sm font-semibold bg-slate-700 text-white">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">dashboard</span> Dashboard
                </a>
                <a href="index.php?url=admin/users" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">people</span> Quản Lý User
                </a>
                <a href="index.php?url=admin/news" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">article</span> Quản Lý Tin Tức
                </a>
                <a href="index.php?url=admin/faqs" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">help</span> Quản Lý FAQ
                </a>
                <a href="index.php?url=admin/comments" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">comment</span> Duyệt Bình Luận
                </a>
                <a href="index.php?url=admin/ratings" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">star</span> Quản Lý Đánh Giá
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="mb-12">
                <h2 class="text-4xl font-bold text-slate-900 mb-2">Xin chào, Admin!</h2>
                <p class="text-slate-600">Tổng quan về hoạt động của trang web</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <!-- Users Stat -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 font-semibold">Tổng Người Dùng</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2"><?= $stats['total_users'] ?? 0 ?></p>
                        </div>
                        <div class="p-4 bg-blue-100 rounded-lg">
                            <span class="material-symbols-outlined text-3xl text-blue-700">people</span>
                        </div>
                    </div>
                </div>

                <!-- News Stat -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 font-semibold">Bài Viết Tin Tức</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2"><?= $stats['total_news'] ?? 0 ?></p>
                        </div>
                        <div class="p-4 bg-amber-100 rounded-lg">
                            <span class="material-symbols-outlined text-3xl text-amber-700">article</span>
                        </div>
                    </div>
                </div>

                <!-- Comments Stat -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 font-semibold">Bình Luận Chờ Duyệt</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2"><?= $stats['pending_comments'] ?? 0 ?></p>
                        </div>
                        <div class="p-4 bg-orange-100 rounded-lg">
                            <span class="material-symbols-outlined text-3xl text-orange-700">comment</span>
                        </div>
                    </div>
                </div>

                <!-- Tours Stat -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 font-semibold">Tổng Tour</p>
                            <p class="text-3xl font-bold text-slate-900 mt-2"><?= $stats['total_tours'] ?? 0 ?></p>
                        </div>
                        <div class="p-4 bg-green-100 rounded-lg">
                            <span class="material-symbols-outlined text-3xl text-green-700">location_on</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Comments -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-slate-200">
                    <h3 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined">comment</span>
                        Bình Luận Gần Đây
                    </h3>
                    <div class="space-y-4">
                        <?php if(isset($recent_comments) && count($recent_comments) > 0): ?>
                            <?php foreach(array_slice($recent_comments, 0, 5) as $comment): ?>
                                <div class="pb-4 border-b border-slate-200 last:border-0">
                                    <p class="text-sm text-slate-600"><?= htmlspecialchars($comment['fullname'] ?? 'Ẩn danh') ?></p>
                                    <p class="text-sm text-slate-700 mt-1">
                                        <?= htmlspecialchars(substr($comment['content'], 0, 80)) ?>...
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        <?= date('H:i d/m/Y', strtotime($comment['created_at'])) ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-slate-500 text-sm">Không có bình luận mới</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Recent News -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-slate-200">
                    <h3 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined">article</span>
                        Bài Viết Gần Đây
                    </h3>
                    <div class="space-y-4">
                        <?php if(isset($recent_news) && count($recent_news) > 0): ?>
                            <?php foreach(array_slice($recent_news, 0, 5) as $article): ?>
                                <div class="pb-4 border-b border-slate-200 last:border-0">
                                    <p class="text-sm font-semibold text-slate-900">
                                        <?= htmlspecialchars(substr($article['title'], 0, 60)) ?>...
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1 flex items-center gap-2">
                                        <span class="material-symbols-outlined text-xs">visibility</span>
                                        <?= number_format($article['views'] ?? 0) ?> lượt xem
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-slate-500 text-sm">Không có bài viết mới</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

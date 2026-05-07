<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đánh Giá | Admin CloudJourney</title>
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
            <a href="index.php?url=admin" class="flex items-center text-slate-600 hover:text-slate-900">
                <span class="material-symbols-outlined text-sm mr-2">arrow_back</span> Quay lại
            </a>
        </div>
    </nav>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-900 text-white p-6 overflow-y-auto">
            <h2 class="text-xl font-bold mb-8">CloudJourney Admin</h2>
            <nav class="space-y-2">
                <a href="index.php?url=admin" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
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
                <a href="index.php?url=admin/ratings" class="block px-4 py-3 rounded-lg text-sm font-semibold bg-slate-700 text-white">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">star</span> Quản Lý Đánh Giá
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <h2 class="text-3xl font-bold text-slate-900 mb-8">Quản Lý Đánh Giá</h2>

            <!-- Ratings Table -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-100 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold text-slate-900">Tour</th>
                                <th class="px-6 py-4 text-left font-semibold text-slate-900">Người Dùng</th>
                                <th class="px-6 py-4 text-left font-semibold text-slate-900">Đánh Giá</th>
                                <th class="px-6 py-4 text-left font-semibold text-slate-900">Nhận Xét</th>
                                <th class="px-6 py-4 text-left font-semibold text-slate-900">Ngày</th>
                                <th class="px-6 py-4 text-center font-semibold text-slate-900">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($ratings) && count($ratings) > 0): ?>
                                <?php foreach($ratings as $rating): ?>
                                    <tr class="border-b border-slate-200 hover:bg-slate-50 transition">
                                        <td class="px-6 py-4">
                                            <p class="font-semibold text-slate-900"><?= htmlspecialchars($rating['tour_name'] ?? 'N/A') ?></p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-slate-600"><?= htmlspecialchars($rating['user_name'] ?? 'Ẩn danh') ?></p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-1">
                                                <?php for($i = 0; $i < $rating['rating']; $i++): ?>
                                                    <span class="material-symbols-outlined text-amber-500 text-sm">star</span>
                                                <?php endfor; ?>
                                                <?php for($i = $rating['rating']; $i < 5; $i++): ?>
                                                    <span class="material-symbols-outlined text-slate-300 text-sm">star</span>
                                                <?php endfor; ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-slate-600 max-w-xs truncate"><?= htmlspecialchars($rating['comment'] ?? '(Không có nhận xét)') ?></p>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600">
                                            <?= date('d/m/Y', strtotime($rating['created_at'] ?? 'now')) ?>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <form method="POST" action="index.php?url=admin/ratings/delete" style="display:inline;">
                                                    <input type="hidden" name="rating_id" value="<?= $rating['id'] ?>">
                                                    <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa đánh giá này?')"
                                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                                        <span class="material-symbols-outlined text-sm">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                        Chưa có đánh giá nào
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

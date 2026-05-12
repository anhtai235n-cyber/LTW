<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Admin' ?> | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 text-slate-800 font-sans">
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-slate-900">Admin Dashboard</h1>
            <a href="index.php?url=home" class="flex items-center text-slate-600 hover:text-slate-900">
                <span class="material-symbols-outlined text-sm mr-2">home</span> Trang chủ
            </a>
        </div>
    </nav>

    <div class="flex h-screen">
        <div class="w-64 bg-slate-900 text-white p-6 overflow-y-auto flex-shrink-0">
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

        <div class="flex-1 overflow-y-auto p-8">
            <?php include $contentView; ?>
        </div>
    </div>
</body>
</html>
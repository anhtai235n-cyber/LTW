<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức | CloudJourney</title>
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
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-3">Tin Tức & Blog</h1>
            <p class="text-lg text-slate-600">Cập nhật những bài viết mới nhất về du lịch và các địa điểm thú vị</p>
        </div>

        <!-- Search Bar -->
        <div class="mb-10">
            <form method="GET" action="index.php" class="flex gap-2">
                <input type="hidden" name="url" value="news">
                <input type="text" name="search" placeholder="Tìm kiếm tin tức..." 
                       value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                       class="flex-1 px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                    <span class="material-symbols-outlined">search</span>
                </button>
            </form>
        </div>

        <!-- News Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if(isset($news) && count($news) > 0): ?>
                <?php foreach($news as $article): ?>
                    <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-slate-200">
                        <!-- Image -->
                        <?php if(!empty($article['image_url'])): ?>
                            <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-700 overflow-hidden">
                                <img src="<?= htmlspecialchars($article['image_url']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" 
                                     class="w-full h-full object-cover hover:scale-110 transition transform">
                            </div>
                        <?php else: ?>
                            <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-6xl">landscape</span>
                            </div>
                        <?php endif; ?>

                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-xs font-bold text-blue-700 bg-blue-100 px-3 py-1 rounded-full">
                                    <?= $article['status'] === 'published' ? 'Công khai' : 'Nháp' ?>
                                </span>
                                <span class="text-xs text-slate-500">
                                    <span class="material-symbols-outlined text-xs">visibility</span>
                                    <?= number_format($article['views'] ?? 0) ?> lượt xem
                                </span>
                            </div>

                            <h2 class="text-xl font-bold text-slate-900 mb-2 line-clamp-2">
                                <?= htmlspecialchars($article['title']) ?>
                            </h2>

                            <p class="text-slate-600 mb-4 line-clamp-3">
                                <?= htmlspecialchars($article['description'] ?? substr(strip_tags($article['content']), 0, 150)) ?>
                            </p>

                            <!-- Metadata -->
                            <div class="flex items-center justify-between text-xs text-slate-500 mb-4 pb-4 border-b border-slate-200">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">calendar_today</span>
                                    <?= date('d/m/Y', strtotime($article['created_at'] ?? 'now')) ?>
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                    <?= htmlspecialchars($article['author_name'] ?? 'Admin') ?>
                                </span>
                            </div>

                            <!-- Read More -->
                            <a href="index.php?url=news/<?= htmlspecialchars($article['slug']) ?>" 
                               class="inline-flex items-center text-blue-700 font-semibold hover:text-blue-900 transition">
                                Đọc tiếp
                                <span class="material-symbols-outlined text-sm ml-2">arrow_forward</span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12">
                    <span class="material-symbols-outlined text-6xl text-slate-300 block mx-auto mb-4">article</span>
                    <p class="text-slate-500 text-lg">
                        <?php 
                        if(isset($_GET['search']) && !empty($_GET['search'])) {
                            echo "Không tìm thấy bài viết nào phù hợp với từ khóa \"" . htmlspecialchars($_GET['search']) . "\"";
                        } else {
                            echo "Chưa có bài viết nào.";
                        }
                        ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>

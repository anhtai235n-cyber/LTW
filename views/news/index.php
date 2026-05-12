<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'Tin Tức' ?> | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
        .hover-shadow:hover { transform: translateY(-5px); transition: 0.3s; }
    </style>
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

    <section class="py-16 bg-blue-700 text-white text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h1 class="text-4xl font-extrabold mb-4 text-white">Tin tức & Cẩm nang du lịch</h1>
            <p class="text-blue-100 text-lg mb-8">Cập nhật những xu hướng và kinh nghiệm du lịch mới nhất</p>
            
            <form action="index.php" method="GET" class="relative max-w-2xl mx-auto">
                <input type="hidden" name="url" value="news">
                <input type="text" name="search" 
                       class="w-full pl-6 pr-16 py-4 rounded-full text-slate-900 focus:outline-none focus:ring-4 focus:ring-blue-500/30" 
                       placeholder="Tìm kiếm bài viết..." 
                       value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button type="submit" class="absolute right-2 top-2 bg-orange-500 hover:bg-orange-600 text-white p-3 rounded-full transition">
                    <span class="material-symbols-outlined">search</span>
                </button>
            </form>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-16">
        <div class="flex flex-col gap-8">
            <?php if (empty($news)): ?>
                <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300">
                    <span class="material-symbols-outlined text-6xl text-slate-300 mb-4">search_off</span>
                    <p class="text-slate-500 text-xl">Không tìm thấy bài viết nào phù hợp.</p>
                    <a href="index.php?url=news" class="mt-4 inline-block text-blue-600 font-bold hover:underline">Xem tất cả bài viết</a>
                </div>
            <?php else: ?>
                <?php foreach ($news as $post): ?>
                    <div class="group bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-xl hover-shadow transition-all duration-300">
                        <div class="flex flex-col md:flex-row">
                            <!-- Image -->
                            <div class="md:w-1/3 h-64 md:h-auto overflow-hidden">
                                <a href="index.php?url=news/<?= $post['slug'] ?>">
                                    <?php if(!empty($post['image'])): ?>
                                        <img src="public/uploads/news/<?= $post['image'] ?>" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500" 
                                             alt="<?= htmlspecialchars($post['title']) ?>">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-slate-300 text-5xl">image</span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>

                            <div class="md:w-2/3 p-8 flex flex-col justify-center">
                                <div class="flex items-center gap-3 text-sm text-slate-500 mb-3">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">calendar_today</span>
                                        <?= date('d/m/Y', strtotime($post['created_at'])) ?>
                                    </span>
                                </div>
                                
                                <h3 class="text-2xl font-bold text-slate-900 mb-3 group-hover:text-blue-700 transition">
                                    <a href="index.php?url=news/<?= $post['slug'] ?>">
                                        <?= htmlspecialchars($post['title']) ?>
                                    </a>
                                </h3>
                                
                                <p class="text-slate-600 mb-6 line-clamp-3 leading-relaxed">
                                    <?= htmlspecialchars($post['description']) ?>
                                </p>
                                
                                <a href="index.php?url=news/<?= $post['slug'] ?>" 
                                   class="inline-flex items-center font-bold text-blue-600 hover:text-blue-800 transition">
                                    Đọc tiếp 
                                    <span class="material-symbols-outlined ml-1 text-sm">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
<?php
// Expected variables from controller:
// $tours (array), $totalTours (int), $page (int), $totalPages (int)
$baseUrl = defined('BASE_URL') ? BASE_URL : '';
$currentPage = $page ?? 1;
$totalPagesLocal = $totalPages ?? 1;
?>
<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Tất cả tour') ?> | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .fade-in { animation: fadeIn 0.6s ease-out both; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
        .tour-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .tour-card:hover { transform: translateY(-8px); box-shadow: 0 24px 90px rgba(15, 23, 42, 0.15); }
    </style>
</head>
<body class="bg-gradient-to-b from-[#faf8ff] to-white text-slate-800 font-sans">
    <!-- Navigation -->
    <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm fade-in">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="<?= $baseUrl ?>index.php?url=home" class="text-2xl font-bold text-slate-900">CloudJourney</a>
            <a href="<?= $baseUrl ?>index.php?url=home" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-blue-50 text-blue-700 hover:bg-blue-100 font-semibold transition-all">
                <span class="material-symbols-outlined text-base">arrow_back</span>
                <span>Trang chủ</span>
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 via-blue-500 to-purple-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-6 text-center fade-in">
            <span class="inline-block bg-white/20 backdrop-blur-md px-6 py-2 rounded-full text-sm font-semibold mb-4">
                Khám phá
            </span>
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4 leading-tight">
                Tất cả tour du lịch
            </h1>
            <p class="text-xl text-blue-50 max-w-2xl mx-auto">
                Khám phá những trải nghiệm du lịch tuyệt vời. Chọn từ hàng chục tour hấp dẫn trên toàn quốc
            </p>
            <div class="mt-8 flex items-center justify-center gap-2 text-blue-100">
                <span class="material-symbols-outlined">info</span>
                <span>Tổng <?= isset($totalTours) ? $totalTours : 0 ?> tour • Trang <?= $currentPage ?>/<?= $totalPagesLocal ?></span>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-24">

        <?php if (isset($tours) && count($tours) > 0): ?>
            <!-- Tours Grid -->
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 mb-12" style="animation-delay: 0.2s;" class="fade-in">
                <?php foreach ($tours as $index => $tour): ?>
                    <article class="tour-card group overflow-hidden rounded-2xl bg-white shadow-[0_8px_40px_rgba(15,23,42,0.08)] border border-slate-200 fade-in" style="animation-delay: <?= $index * 0.05 ?>s;">
                        <!-- Image Container -->
                        <div class="relative h-64 overflow-hidden bg-slate-200">
                            <img
                                src="<?= !empty($tour['image_url']) ? $baseUrl . htmlspecialchars($tour['image_url']) : $baseUrl . 'uploads/picture1.jfif' ?>"
                                alt="<?= htmlspecialchars($tour['name'] ?? '') ?>"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                            />
                            <!-- Category Badge -->
                            <div class="absolute left-4 top-4 flex items-center gap-2">
                                <span class="rounded-full bg-white/95 backdrop-blur-sm px-4 py-2 text-xs font-bold text-slate-900 shadow-lg">
                                    <?= htmlspecialchars($tour['category'] ?? 'Tour') ?>
                                </span>
                            </div>
                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col h-full">
                            <!-- Title -->
                            <h3 class="text-xl font-bold text-slate-900 mb-3 line-clamp-2 group-hover:text-blue-700 transition-colors">
                                <?= htmlspecialchars($tour['name'] ?? '') ?>
                            </h3>

                            <!-- Info Row -->
                            <div class="space-y-3 mb-5 text-sm text-slate-600">
                                <!-- Location -->
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base text-blue-600">location_on</span>
                                    <span class="truncate"><?= htmlspecialchars($tour['location'] ?? 'Chưa xác định') ?></span>
                                </div>
                                <!-- Duration -->
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-base text-blue-600">schedule</span>
                                    <span><?= htmlspecialchars($tour['duration'] ?? 'Chưa xác định') ?></span>
                                </div>
                            </div>

                            <!-- Divider -->
                            <div class="flex-grow border-t border-slate-200 my-4"></div>

                            <!-- Footer -->
                            <div class="flex items-center justify-between gap-3">
                                <!-- Price -->
                                <div class="flex flex-col">
                                    <span class="text-xs text-slate-500 font-medium">Từ</span>
                                    <span class="text-2xl font-bold text-orange-600">
                                        <?= number_format((float)($tour['price'] ?? 0), 0, ',', '.') ?>đ
                                    </span>
                                </div>
                                <!-- View Button -->
                                <a href="<?= $baseUrl ?>index.php?url=tour&id=<?= (int)($tour['id'] ?? 0) ?>" class="flex-1 inline-flex items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-3 text-sm font-bold text-white shadow-md hover:shadow-lg hover:scale-105 transition-all">
                                    <span>Xem</span>
                                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($totalPagesLocal > 1): ?>
            <div class="mt-16 fade-in">
                <nav class="flex items-center justify-center gap-2 flex-wrap">
                    <!-- Previous Button -->
                    <?php if ($currentPage > 1): ?>
                        <a href="<?= $baseUrl ?>index.php?url=tour_all&page=<?= $currentPage - 1 ?>" 
                           class="inline-flex items-center gap-2 px-4 py-3 rounded-lg border border-slate-300 bg-white text-slate-700 font-semibold hover:bg-blue-50 hover:border-blue-400 hover:text-blue-700 transition-all">
                            <span class="material-symbols-outlined text-base">chevron_left</span>
                            <span>Trước</span>
                        </a>
                    <?php else: ?>
                        <span class="inline-flex items-center gap-2 px-4 py-3 rounded-lg border border-slate-200 bg-slate-50 text-slate-400 font-semibold cursor-not-allowed">
                            <span class="material-symbols-outlined text-base">chevron_left</span>
                            <span>Trước</span>
                        </span>
                    <?php endif; ?>

                    <!-- Page Numbers -->
                    <div class="flex items-center gap-1">
                        <?php
                        $start = max(1, $currentPage - 2);
                        $end = min($totalPagesLocal, $currentPage + 2);
                        
                        if ($start > 1): ?>
                            <a href="<?= $baseUrl ?>index.php?url=tour_all&page=1" 
                               class="w-11 h-11 rounded-lg border border-slate-300 bg-white text-slate-700 font-semibold hover:bg-slate-50 transition-all flex items-center justify-center">
                                1
                            </a>
                            <?php if ($start > 2): ?>
                                <span class="px-2 text-slate-400">...</span>
                            <?php endif;
                        endif;

                        for ($p = $start; $p <= $end; $p++): ?>
                            <?php if ($p == $currentPage): ?>
                                <span class="w-11 h-11 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold flex items-center justify-center shadow-md">
                                    <?= $p ?>
                                </span>
                            <?php else: ?>
                                <a href="<?= $baseUrl ?>index.php?url=tour_all&page=<?= $p ?>" 
                                   class="w-11 h-11 rounded-lg border border-slate-300 bg-white text-slate-700 font-semibold hover:bg-blue-50 hover:border-blue-400 transition-all flex items-center justify-center">
                                    <?= $p ?>
                                </a>
                            <?php endif;
                        endfor;

                        if ($end < $totalPagesLocal): ?>
                            <?php if ($end < $totalPagesLocal - 1): ?>
                                <span class="px-2 text-slate-400">...</span>
                            <?php endif; ?>
                            <a href="<?= $baseUrl ?>index.php?url=tour_all&page=<?= $totalPagesLocal ?>" 
                               class="w-11 h-11 rounded-lg border border-slate-300 bg-white text-slate-700 font-semibold hover:bg-slate-50 transition-all flex items-center justify-center">
                                <?= $totalPagesLocal ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Next Button -->
                    <?php if ($currentPage < $totalPagesLocal): ?>
                        <a href="<?= $baseUrl ?>index.php?url=tour_all&page=<?= $currentPage + 1 ?>" 
                           class="inline-flex items-center gap-2 px-4 py-3 rounded-lg border border-slate-300 bg-white text-slate-700 font-semibold hover:bg-blue-50 hover:border-blue-400 hover:text-blue-700 transition-all">
                            <span>Sau</span>
                            <span class="material-symbols-outlined text-base">chevron_right</span>
                        </a>
                    <?php else: ?>
                        <span class="inline-flex items-center gap-2 px-4 py-3 rounded-lg border border-slate-200 bg-slate-50 text-slate-400 font-semibold cursor-not-allowed">
                            <span>Sau</span>
                            <span class="material-symbols-outlined text-base">chevron_right</span>
                        </span>
                    <?php endif; ?>
                </nav>
            </div>
            <?php endif; ?>

        <?php else: ?>
            <!-- Empty State -->
            <div class="py-24 text-center fade-in">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-100 mb-6">
                    <span class="material-symbols-outlined text-4xl text-slate-400">info</span>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Chưa có tour nào</h2>
                <p class="text-slate-600 mb-8">Hãy quay lại sau để tìm những tour mới</p>
                <a href="<?= $baseUrl ?>index.php?url=home" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-blue-600 text-white font-semibold hover:bg-blue-700 transition-all">
                    <span>Quay lại trang chủ</span>
                    <span class="material-symbols-outlined text-base">home</span>
                </a>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-200 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">CloudJourney</h3>
                    <p class="text-slate-400">Khám phá những điểm đến tuyệt vời cùng chúng tôi</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Liên kết</h4>
                    <ul class="space-y-2">
                        <li><a href="<?= $baseUrl ?>index.php?url=home" class="text-slate-400 hover:text-white transition-colors">Trang chủ</a></li>
                        <li><a href="<?= $baseUrl ?>index.php?url=contact" class="text-slate-400 hover:text-white transition-colors">Liên hệ</a></li>
                        <li><a href="<?= $baseUrl ?>index.php?url=faq" class="text-slate-400 hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Thông tin</h4>
                    <ul class="space-y-2 text-slate-400 text-sm">
                        <li>📞 Hotline: 1900-xxxx</li>
                        <li>✉️ Email: info@cloudjourney.vn</li>
                        <li>📍 Hà Nội, Việt Nam</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-8 pt-8 text-center text-slate-400">
                <p>&copy; 2024 CloudJourney. Tất cả các quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>
</body>
</html>
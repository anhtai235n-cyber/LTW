<?php
// Expected variables from controller:
// $tours (array), $totalTours (int), $page (int), $totalPages (int)
// $pageTitle (string)
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
    </style>
</head>
<body class="bg-[#faf8ff] text-[#191b23] font-sans">
    <main class="max-w-7xl mx-auto px-6 md:px-8 py-24">
        <div class="mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900">Tất cả tour</h1>
            <p class="mt-3 text-slate-600">Hiển thị danh sách tour đang hoạt động. Mỗi trang 10 tour.</p>
        </div>

        <?php if (isset($tours) && count($tours) > 0): ?>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($tours as $tour): ?>
                    <article class="tour-card overflow-hidden rounded-[2rem] bg-white shadow-[0_24px_90px_rgba(15,23,42,0.08)] border border-slate-200">
                        <div class="relative h-56 overflow-hidden">
                            <img
                                src="<?= !empty($tour['image_url']) ? '/' . htmlspecialchars($tour['image_url']) : '/uploads/picture1.jfif' ?>"
                                alt="<?= htmlspecialchars($tour['name'] ?? '') ?>"
                                class="h-full w-full object-cover transition duration-500 hover:scale-105"
                            />
                            <span class="absolute left-4 top-4 rounded-full bg-white/90 px-4 py-2 text-xs font-semibold text-slate-900 shadow-sm">
                                <?= htmlspecialchars($tour['category'] ?? '') ?>
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between gap-4 mb-4">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-slate-900 break-words whitespace-normal" title="<?= htmlspecialchars($tour['name'] ?? '') ?>">
                                        <?= htmlspecialchars($tour['name'] ?? '') ?>
                                    </h3>
                                    <p class="mt-2 text-sm text-slate-500 break-words whitespace-normal">
                                        <span class="material-symbols-outlined text-[14px] align-middle">location_on</span>
                                        <?= htmlspecialchars($tour['location'] ?? 'Chưa cập nhật') ?>
                                    </p>
                                    <p class="mt-1 text-sm text-slate-500 break-words whitespace-normal">
                                        <span class="material-symbols-outlined text-[14px] align-middle">schedule</span>
                                        <?= htmlspecialchars($tour['duration'] ?? 'Chưa cập nhật') ?>
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-extrabold text-blue-700">
                                        <?= number_format((float)($tour['price'] ?? 0), 0, ',', '.') ?>đ
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">⭐ 5.0</span>
                                <a href="/index.php?url=tour&id=<?= (int)($tour['id'] ?? 0) ?>" class="rounded-full bg-orange-500 px-5 py-3 text-sm font-semibold text-white hover:bg-orange-600 transition">
                                    Xem tour
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex items-center justify-center">
                <nav class="flex items-center gap-2">
                    <?php
                    $currentPage = $page ?? 1;
                    $totalPagesLocal = $totalPages ?? 1;

                    $baseUrl = '/index.php?url=tour_all&page=';
                    ?>

                    <a
                        href="<?= $currentPage <= 1 ? '#' : $baseUrl . ($currentPage - 1) ?>"
                        class="px-4 py-2 rounded-lg border border-slate-200 text-sm font-semibold <?= $currentPage <= 1 ? 'text-slate-400 cursor-not-allowed bg-slate-50' : 'text-slate-700 bg-white hover:bg-slate-50' ?>"
                    >
                        Trước
                    </a>

                    <?php
                    $start = max(1, $currentPage - 2);
                    $end = min($totalPagesLocal, $currentPage + 2);
                    for ($p = $start; $p <= $end; $p++): ?>
                        <a
                            href="<?= $baseUrl . $p ?>"
                            class="px-4 py-2 rounded-lg border text-sm font-semibold <?= $p == $currentPage ? 'bg-blue-700 border-blue-700 text-white' : 'bg-white border-slate-200 text-slate-700 hover:bg-slate-50' ?>"
                        >
                            <?= $p ?>
                        </a>
                    <?php endfor; ?>

                    <a
                        href="<?= $currentPage >= $totalPagesLocal ? '#' : $baseUrl . ($currentPage + 1) ?>"
                        class="px-4 py-2 rounded-lg border border-slate-200 text-sm font-semibold <?= $currentPage >= $totalPagesLocal ? 'text-slate-400 cursor-not-allowed bg-slate-50' : 'text-slate-700 bg-white hover:bg-slate-50' ?>"
                    >
                        Sau
                    </a>
                </nav>
            </div>

        <?php else: ?>
            <div class="rounded-[2rem] bg-white p-10 shadow-sm border border-slate-200 text-center">
                <p class="text-slate-600">Hiện chưa có tour nào.</p>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm Tour | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>
    <link rel="stylesheet" href="/public/css/scrollAnimations.css">
</head>
<body class="bg-[#faf8ff] text-slate-800 font-sans antialiased">
    <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="/index.php?url=home" class="text-2xl font-bold text-slate-900">CloudJourney</a>
            <a href="/index.php?url=home" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                <span class="material-symbols-outlined text-sm mr-1">arrow_back</span> Quay lại
            </a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-8 scroll-reveal reveal-from-bottom reveal-delay-150">
        <!-- Header -->
        <div class="mb-8 border-b border-slate-200 pb-6">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-2">Tìm kiếm Tour</h1>
            <p class="text-slate-600">Tìm thấy <strong class="text-blue-700"><?= $totalResults ?></strong> tour phù hợp với tìm kiếm của bạn</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filters -->
            <aside class="lg:col-span-1">
                <form method="GET" action="/index.php" class="sticky top-24 space-y-6">
                    <input type="hidden" name="url" value="search">
                    
                    <!-- Location Filter -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-700">location_on</span> Điểm đến
                        </h3>
                        <input type="text" name="location" value="<?= htmlspecialchars($selectedFilters['location']) ?>" 
                            placeholder="Nhập tên địa điểm..." class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <!-- Category Filter -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-700">category</span> Loại Tour
                        </h3>
                        <select name="category" class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition cursor-pointer">
                            <option value="all">Tất cả danh mục</option>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= htmlspecialchars($cat['category']) ?>" 
                                    <?= $selectedFilters['category'] === $cat['category'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['category']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-700">attach_money</span> Khoảng giá
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm text-slate-600 block mb-2">Từ</label>
                                <input type="number" name="min_price" value="<?= htmlspecialchars($selectedFilters['min_price']) ?>" 
                                    placeholder="Giá tối thiểu" class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            </div>
                            <div>
                                <label class="text-sm text-slate-600 block mb-2">Đến</label>
                                <input type="number" name="max_price" value="<?= htmlspecialchars($selectedFilters['max_price']) ?>" 
                                    placeholder="Giá tối đa" class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            </div>
                            <?php
                                $minPriceLabel = is_numeric($selectedFilters['min_price']) ? number_format((float)$selectedFilters['min_price'], 0, ',', '.') . 'đ' : '0đ';
                                $maxPriceLabel = is_numeric($selectedFilters['max_price']) ? number_format((float)$selectedFilters['max_price'], 0, ',', '.') . 'đ' : 'Tất cả';
                            ?>
                            <p class="text-xs text-slate-500 mt-2">
                                Giá: <?= $minPriceLabel ?> - <?= $maxPriceLabel ?>
                            </p>
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-700">sort</span> Sắp xếp
                        </h3>
                        <select name="sort" class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition cursor-pointer">
                            <option value="latest" <?= $selectedFilters['sort'] === 'latest' ? 'selected' : '' ?>>Mới nhất</option>
                            <option value="price_asc" <?= $selectedFilters['sort'] === 'price_asc' ? 'selected' : '' ?>>Giá: Thấp → Cao</option>
                            <option value="price_desc" <?= $selectedFilters['sort'] === 'price_desc' ? 'selected' : '' ?>>Giá: Cao → Thấp</option>
                            <option value="name_asc" <?= $selectedFilters['sort'] === 'name_asc' ? 'selected' : '' ?>>Tên: A → Z</option>
                            <option value="name_desc" <?= $selectedFilters['sort'] === 'name_desc' ? 'selected' : '' ?>>Tên: Z → A</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-3">
                        <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 rounded-xl transition flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">search</span> Tìm kiếm
                        </button>
                        <a href="/index.php?url=search" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-900 font-bold py-3 rounded-xl transition flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">refresh</span> Đặt lại bộ lọc
                        </a>
                    </div>
                </form>
            </aside>

            <!-- Results -->
            <div class="lg:col-span-3">
                <?php if ($totalResults > 0): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php foreach ($filteredTours as $tour): ?>
                            <article class="group overflow-hidden rounded-2xl bg-white shadow-sm border border-slate-200 hover:shadow-xl transition duration-300">
                                <!-- Image -->
                                <div class="relative h-52 overflow-hidden bg-slate-200">
                                    <img src="<?= !empty($tour['image_url']) ? '/' . htmlspecialchars($tour['image_url']) : '/uploads/picture1.jfif' ?>" 
                                        alt="<?= htmlspecialchars($tour['name']) ?>" 
                                        class="h-full w-full object-cover group-hover:scale-110 transition duration-500">
                                    
                                    <!-- Category Badge -->
                                    <span class="absolute left-3 top-3 rounded-full bg-blue-600 text-white px-3 py-1 text-xs font-semibold">
                                        <?= htmlspecialchars($tour['category']) ?>
                                    </span>
                                    
                                    <!-- Price Badge -->
                                    <span class="absolute right-3 top-3 rounded-full bg-orange-500 text-white px-3 py-1 text-sm font-bold">
                                        <?= number_format((float)($tour['price'] ?? 0), 0, ',', '.') ?>đ
                                    </span>
                                </div>

                                <!-- Content -->
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-slate-900 break-words whitespace-normal mb-2">
                                        <?= htmlspecialchars($tour['name']) ?>
                                    </h3>
                                    
                                    <div class="space-y-2 mb-4 text-sm text-slate-600">
                                        <p class="flex items-center gap-2 break-words whitespace-normal">
                                            <span class="material-symbols-outlined text-base text-blue-700">location_on</span>
                                            <?= htmlspecialchars($tour['location'] ?? 'Chưa cập nhật') ?>
                                        </p>
                                        <p class="flex items-center gap-2 break-words whitespace-normal">
                                            <span class="material-symbols-outlined text-base text-blue-700">schedule</span>
                                            <?= htmlspecialchars($tour['duration'] ?? 'Chưa cập nhật') ?>
                                        </p>
                                    </div>

                                    <!-- Description Preview -->
                                    <p class="text-sm text-slate-600 line-clamp-2 mb-4">
                                        <?= htmlspecialchars(substr($tour['description'] ?? '', 0, 100)) ?>...
                                    </p>

                                    <!-- Button -->
                                    <a href="/index.php?url=tour&id=<?= $tour['id'] ?>" 
                                        class="block w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2.5 rounded-xl transition text-center">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <!-- Empty State -->
                    <div class="bg-white rounded-2xl border border-slate-200 p-16 text-center">
                        <span class="material-symbols-outlined text-7xl text-slate-300 block mb-4">search_off</span>
                        <h2 class="text-2xl font-bold text-slate-900 mb-2">Không tìm thấy tour nào</h2>
                        <p class="text-slate-600 mb-6">
                            Rất tiếc, không có tour nào phù hợp với tiêu chí tìm kiếm của bạn.<br>
                            Vui lòng thử lại với các bộ lọc khác.
                        </p>
                        <a href="/index.php?url=search" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-xl transition">
                            <span class="material-symbols-outlined text-sm">refresh</span> Đặt lại bộ lọc
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer spacing -->
    <div class="h-12"></div>
</body>
    <script defer src="/public/js/scrollAnimations.js"></script>
</html>
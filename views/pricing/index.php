<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Giá Tour | CloudJourney</title>
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

    <main class="max-w-7xl mx-auto px-6 py-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Bảng Giá Tour</h1>
            <p class="text-lg text-slate-600">Chọn tour yêu thích và đặt ngay với giá tốt nhất</p>
        </div>

        <!-- Pricing Table -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-blue-700 to-blue-800 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-bold">Tên Tour</th>
                            <th class="px-6 py-4 text-left font-bold">Danh Mục</th>
                            <th class="px-6 py-4 text-left font-bold">Địa Điểm</th>
                            <th class="px-6 py-4 text-left font-bold">Thời Gian</th>
                            <th class="px-6 py-4 text-right font-bold">Giá Tiền</th>
                            <th class="px-6 py-4 text-center font-bold">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($tours) && count($tours) > 0): ?>
                            <?php foreach($tours as $tour): ?>
                                <tr class="border-b border-slate-200 hover:bg-slate-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-slate-900"><?= htmlspecialchars($tour['name']) ?></div>
                                        <div class="text-xs text-slate-500 mt-1"><?= htmlspecialchars($tour['tour_code']) ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                            <?= htmlspecialchars($tour['category']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-700">
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-sm">location_on</span>
                                            <?= htmlspecialchars($tour['location'] ?? 'N/A') ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-700">
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-sm">schedule</span>
                                            <?= htmlspecialchars($tour['duration'] ?? 'N/A') ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-2xl font-extrabold text-orange-600">
                                            <?= number_format((float)($tour['price'] ?? 0), 0, ',', '.') ?>đ
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="index.php?url=tour&id=<?= $tour['id'] ?>" 
                                           class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-semibold px-4 py-2 rounded-lg transition">
                                            Đặt tour
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <span class="material-symbols-outlined text-5xl text-slate-300 block mb-3">box</span>
                                    Chưa có tour nào
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Notes -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <h3 class="font-bold text-slate-900 mb-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-blue-700">info</span> Lưu Ý
                </h3>
                <p class="text-sm text-slate-700">Giá tour bao gồm vé, ăn, ở và hướng dẫn viên.</p>
            </div>
            <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                <h3 class="font-bold text-slate-900 mb-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-700">discount</span> Giảm Giá
                </h3>
                <p class="text-sm text-slate-700">Nhóm 10+ người được giảm giá đặc biệt. Liên hệ 0901234567</p>
            </div>
            <div class="bg-orange-50 border border-orange-200 rounded-xl p-6">
                <h3 class="font-bold text-slate-900 mb-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-orange-700">calendar_month</span> Linh Hoạt
                </h3>
                <p class="text-sm text-slate-700">Có thể thay đổi hoặc hủy trước 7-10 ngày.</p>
            </div>
        </div>
    </main>
</body>
</html>

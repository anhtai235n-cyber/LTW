<!-- Header -->
<header class="flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h1 class="text-3xl font-extrabold tracking-tight text-on-surface">Quản lý Tour</h1>
        <p class="text-on-surface-variant mt-1">Cập nhật và điều chỉnh các hành trình khám phá.</p>
    </div>
    <div class="flex items-center gap-4">
        <a href="/index.php?url=admin/tours_create" class="flex items-center gap-2 px-6 py-3 bg-gradient-to-br from-primary to-primary-container text-white rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
            <span class="material-symbols-outlined">add</span>
            Thêm tour mới
        </a>
    </div>
</header>

<!-- Stats -->
<section class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <span class="p-3 bg-primary/10 text-primary rounded-xl material-symbols-outlined">map</span>
        </div>
        <p class="text-on-surface-variant text-sm font-medium">Tổng số Tour</p>
        <p class="text-2xl font-extrabold text-on-surface"><?= $totalTours ?></p>
    </div>
    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <span class="p-3 bg-green-100 text-green-700 rounded-xl material-symbols-outlined">check_circle</span>
        </div>
        <p class="text-on-surface-variant text-sm font-medium">Đang hoạt động</p>
        <p class="text-2xl font-extrabold text-on-surface"><?= $activeTours ?></p>
    </div>
    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <span class="p-3 bg-gray-100 text-gray-700 rounded-xl material-symbols-outlined">visibility_off</span>
        </div>
        <p class="text-on-surface-variant text-sm font-medium">Đang ẩn</p>
        <p class="text-2xl font-extrabold text-on-surface"><?= $hiddenTours ?></p>
    </div>
</section>

<!-- Tour Table -->
<div class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low border-b-0">
                    <th class="px-8 py-5 font-bold text-on-surface-variant text-sm">MÃ TOUR</th>
                    <th class="px-6 py-5 font-bold text-on-surface-variant text-sm">TÊN TOUR</th>
                    <th class="px-6 py-5 font-bold text-on-surface-variant text-sm">DANH MỤC</th>
                    <th class="px-6 py-5 font-bold text-on-surface-variant text-sm text-right">GIÁ (VNĐ)</th>
                    <th class="px-6 py-5 font-bold text-on-surface-variant text-sm text-center">TRẠNG THÁI</th>
                    <th class="px-8 py-5 font-bold text-on-surface-variant text-sm text-right">HÀNH ĐỘNG</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                <?php if (count($tours) > 0): ?>
                    <?php foreach($tours as $tour): ?>
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-8 py-5 text-sm font-medium text-outline"><?= htmlspecialchars($tour['tour_code']) ?></td>
                        <td class="px-6 py-5">
                            <div class="font-bold text-on-surface group-hover:text-primary transition-colors"><?= htmlspecialchars($tour['name']) ?></div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-3 py-1 bg-tertiary/10 text-tertiary rounded-full text-xs font-bold uppercase tracking-wider"><?= htmlspecialchars($tour['category']) ?></span>
                        </td>
                        <td class="px-6 py-5 text-right font-bold text-on-surface">
                            <?= number_format($tour['price']) ?>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <?php if($tour['status'] == 'active'): ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">
                                Hoạt động
                            </span>
                            <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold">
                                Ẩn
                            </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-8 py-5 text-right space-x-2">
                            <a href="/index.php?url=admin/tours_edit?id=<?= $tour['id'] ?>" class="inline-block p-2 text-outline hover:text-primary hover:bg-primary/5 rounded-lg transition-all">
                                <span class="material-symbols-outlined text-xl">edit</span>
                            </a>
                            <a href="/index.php?url=admin/tours_delete?id=<?= $tour['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá?')" class="inline-block p-2 text-outline hover:text-error hover:bg-error/5 rounded-lg transition-all">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-on-surface-variant">Chưa có dữ liệu tour nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

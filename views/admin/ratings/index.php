<div class="mb-8">
    <h2 class="text-3xl font-bold text-slate-900">Quản Lý Đánh Giá</h2>
</div>

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

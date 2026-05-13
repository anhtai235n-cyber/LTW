<header class="mb-8">
    <h1 class="text-3xl font-extrabold tracking-tight text-on-surface">Cập Nhật Tour</h1>
    <p class="text-on-surface-variant mt-1">Chỉnh sửa thông tin hành trình khám phá.</p>
</header>

<div class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm">
    <form action="/index.php?url=admin/tours_update" method="POST" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="id" value="<?= $tour['id'] ?>">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Mã Tour</label>
                <input type="text" name="tour_code" value="<?= htmlspecialchars($tour['tour_code']) ?>" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Tên Tour</label>
                <input type="text" name="name" value="<?= htmlspecialchars($tour['name']) ?>" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Danh Mục</label>
                <select name="category" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
                    <option value="Khám phá" <?= $tour['category'] == 'Khám phá' ? 'selected' : '' ?>>Khám phá</option>
                    <option value="Nghỉ dưỡng" <?= $tour['category'] == 'Nghỉ dưỡng' ? 'selected' : '' ?>>Nghỉ dưỡng</option>
                    <option value="Giải trí" <?= $tour['category'] == 'Giải trí' ? 'selected' : '' ?>>Giải trí</option>
                    <option value="Văn hóa" <?= $tour['category'] == 'Văn hóa' ? 'selected' : '' ?>>Văn hóa</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Giá (VNĐ)</label>
                <input type="number" name="price" value="<?= $tour['price'] ?>" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Thời gian (VD: 3 Ngày 2 Đêm)</label>
                <input type="text" name="duration" value="<?= htmlspecialchars($tour['duration'] ?? '') ?>" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Khu vực (VD: Đà Lạt, Việt Nam)</label>
                <input type="text" name="location" value="<?= htmlspecialchars($tour['location'] ?? '') ?>" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Trạng Thái</label>
                <select name="status" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
                    <option value="active" <?= $tour['status'] == 'active' ? 'selected' : '' ?>>Hoạt động</option>
                    <option value="hidden" <?= $tour['status'] == 'hidden' ? 'selected' : '' ?>>Ẩn</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Hình Ảnh Đại Diện</label>
                <?php if($tour['image_url']): ?>
                    <img src="/<?= $tour['image_url'] ?>" alt="Ảnh hiện tại" class="h-16 w-auto mb-2 rounded-lg object-cover">
                <?php endif; ?>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
                <span class="text-xs text-on-surface-variant mt-1 block">Tải lên ảnh mới nếu muốn thay thế (Bỏ trống sẽ giữ ảnh cũ)</span>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-on-surface mb-2">Thêm Ảnh Phụ (Chọn nhiều ảnh)</label>
                <input type="file" name="gallery[]" accept="image/*" multiple class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40 text-on-surface-variant">
                <p class="text-xs text-on-surface-variant mt-2">Dùng phím Ctrl (hoặc Cmd) để chọn thêm nhiều ảnh mới cho tour này.</p>
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Mô Tả Chi Tiết</label>
            <textarea name="description" rows="5" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40"><?= htmlspecialchars($tour['description'] ?? '') ?></textarea>
        </div>
        
        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Điểm Nổi Bật (Mỗi dòng 1 điểm)</label>
            <textarea name="highlights" rows="4" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40"><?= htmlspecialchars($tour['highlights'] ?? '') ?></textarea>
        </div>
        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Lịch Trình Chi Tiết</label>
            <textarea name="itinerary" rows="6" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40"><?= htmlspecialchars($tour['itinerary'] ?? '') ?></textarea>
        </div>
        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Chính Sách Tour (Hoàn/Hủy)</label>
            <textarea name="policy" rows="4" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40"><?= htmlspecialchars($tour['policy'] ?? '') ?></textarea>
        </div>

        <div class="flex justify-end gap-4 mt-8">
            <a href="/index.php?url=admin/tours" class="px-6 py-3 bg-surface-container-high text-on-surface rounded-xl font-bold hover:bg-surface-container-highest transition-colors">Hủy</a>
            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">Lưu Thay Đổi</button>
        </div>
    </form>
</div>

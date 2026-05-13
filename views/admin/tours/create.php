<header class="mb-8">
    <h1 class="text-3xl font-extrabold tracking-tight text-on-surface">Thêm Tour Mới</h1>
    <p class="text-on-surface-variant mt-1">Điền thông tin chi tiết để tạo mới một tour.</p>
</header>

<div class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm">
    <form action="/index.php?url=admin/tours_store" method="POST" enctype="multipart/form-data" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Mã Tour (Mã duy nhất)</label>
                <input type="text" name="tour_code" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40" placeholder="VD: CJ-2024-001">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Tên Tour</label>
                <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40" placeholder="Tên hiển thị của tour">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Danh Mục</label>
                <select name="category" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
                    <option value="Khám phá">Khám phá</option>
                    <option value="Nghỉ dưỡng">Nghỉ dưỡng</option>
                    <option value="Giải trí">Giải trí</option>
                    <option value="Văn hóa">Văn hóa</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Giá (VNĐ)</label>
                <input type="number" name="price" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40" placeholder="Ví dụ: 4500000">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Thời gian (VD: 3 Ngày 2 Đêm)</label>
                <input type="text" name="duration" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40" placeholder="3 Ngày 2 Đêm">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Khu vực (VD: Đà Lạt, Việt Nam)</label>
                <input type="text" name="location" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40" placeholder="Đà Lạt, Việt Nam">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Trạng Thái</label>
                <select name="status" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
                    <option value="active">Hoạt động</option>
                    <option value="hidden">Ẩn</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Hình Ảnh Đại Diện</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-on-surface mb-2">Thư Viện Ảnh Phụ (Chọn nhiều ảnh)</label>
                <input type="file" name="gallery[]" accept="image/*" multiple class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40 text-on-surface-variant">
                <p class="text-xs text-on-surface-variant mt-2">Dùng phím Ctrl (hoặc Cmd) để chọn nhiều ảnh cùng lúc.</p>
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Mô Tả Chi Tiết</label>
            <textarea name="description" rows="5" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40" placeholder="Giới thiệu về hành trình..."></textarea>
        </div>
        
        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Điểm Nổi Bật (Mỗi dòng 1 điểm)</label>
            <textarea name="highlights" rows="4" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40" placeholder="VD: Khám phá Vịnh Hạ Long..."></textarea>
        </div>
        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Lịch Trình Chi Tiết</label>
            <textarea name="itinerary" rows="6" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40" placeholder="Ngày 1: ...&#10;Ngày 2: ..."></textarea>
        </div>
        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Chính Sách Tour (Hoàn/Hủy)</label>
            <textarea name="policy" rows="4" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40" placeholder="Chính sách hoàn tiền..."></textarea>
        </div>

        <div class="flex justify-end gap-4 mt-8">
            <a href="/index.php?url=admin/tours" class="px-6 py-3 bg-surface-container-high text-on-surface rounded-xl font-bold hover:bg-surface-container-highest transition-colors">Hủy</a>
            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">Lưu Tour</button>
        </div>
    </form>
</div>

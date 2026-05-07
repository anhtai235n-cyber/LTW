<!-- Header -->
<header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold tracking-tight text-on-surface">Cài đặt Chung</h1>
        <p class="text-on-surface-variant mt-1">Quản lý thông tin cấu hình của website.</p>
    </div>
</header>

<?php if(isset($_SESSION['setting_success'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($_SESSION['setting_success']) ?></span>
    </div>
    <?php unset($_SESSION['setting_success']); ?>
<?php endif; ?>

<?php if(isset($_SESSION['setting_error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-6" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($_SESSION['setting_error']) ?></span>
    </div>
    <?php unset($_SESSION['setting_error']); ?>
<?php endif; ?>

<div class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm">
    <form action="/admin/setting_update" method="POST" enctype="multipart/form-data" class="space-y-6">
        
        <h3 class="text-xl font-bold text-on-surface mb-4">Thông tin Website</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Tên Website</label>
                <input type="text" name="site_name" value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Tiêu đề Banner Trang Chủ</label>
                <input type="text" name="hero_title" value="<?= htmlspecialchars($settings['hero_title'] ?? '') ?>" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-on-surface mb-2">Ảnh Nền Banner Trang Chủ</label>
                <?php if(isset($settings['hero_image']) && $settings['hero_image']): ?>
                    <img src="/<?= $settings['hero_image'] ?>" alt="Banner hiện tại" class="h-32 w-auto mb-2 rounded-xl object-cover shadow">
                <?php endif; ?>
                <input type="file" name="hero_image" accept="image/*" class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
                <span class="text-xs text-on-surface-variant mt-1 block">Tải lên ảnh mới nếu muốn thay thế ảnh nền Trang Chủ (Bỏ trống sẽ giữ ảnh cũ)</span>
            </div>
        </div>
        
        <hr class="my-8 border-surface-container-high">

        <h3 class="text-xl font-bold text-on-surface mb-4">Thông tin Liên Hệ Công Ty</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Số điện thoại</label>
                <input type="text" name="company_phone" value="<?= htmlspecialchars($settings['company_phone'] ?? '') ?>" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Email công ty</label>
                <input type="email" name="company_email" value="<?= htmlspecialchars($settings['company_email'] ?? '') ?>" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-on-surface mb-2">Địa chỉ</label>
                <input type="text" name="company_address" value="<?= htmlspecialchars($settings['company_address'] ?? '') ?>" required class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>
        </div>

        <div class="flex justify-end gap-4 mt-8">
            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">Lưu Cấu Hình</button>
        </div>
    </form>
</div>
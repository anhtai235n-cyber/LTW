<div class="space-y-6">
    <!-- Thanh tiêu đề -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-on-surface">Tạo Tài khoản Admin mới</h1>
            <p class="text-on-surface-variant mt-2">Nhập thông tin để tạo một tài khoản quản trị viên mới</p>
        </div>
        <a href="/admin/users" class="flex items-center gap-2 px-6 py-3 text-primary hover:bg-primary-container rounded-xl font-bold transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
            <span>Quay lại</span>
        </a>
    </div>

    <!-- Hiển thị lỗi nếu có -->
    <?php if(isset($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
            <span><?= htmlspecialchars($error) ?></span>
        </div>
    <?php endif; ?>

    <!-- Form tạo admin -->
    <div class="bg-white rounded-xl shadow-md p-8 max-w-2xl">
        <form action="/admin/users/store" method="POST" class="space-y-6">
            <!-- Tên đăng nhập -->
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Tên đăng nhập <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    name="username" 
                    required 
                    class="w-full px-4 py-3 rounded-xl border border-outline focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                    placeholder="Nhập tên đăng nhập (chỉ dùng chữ, số, dấu gạch dưới, dấu chấm)"
                >
                <p class="text-xs text-on-surface-variant mt-1">Tối thiểu 3 ký tự, tối đa 20 ký tự</p>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Email <span class="text-red-500">*</span></label>
                <input 
                    type="email" 
                    name="email" 
                    required 
                    class="w-full px-4 py-3 rounded-xl border border-outline focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                    placeholder="Nhập địa chỉ email"
                >
            </div>

            <!-- Họ và tên -->
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Họ và tên <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    name="fullname" 
                    required 
                    class="w-full px-4 py-3 rounded-xl border border-outline focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                    placeholder="Nhập họ và tên"
                >
            </div>

            <!-- Mật khẩu -->
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Mật khẩu <span class="text-red-500">*</span></label>
                <input 
                    type="password" 
                    name="password" 
                    required 
                    class="w-full px-4 py-3 rounded-xl border border-outline focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                    placeholder="Nhập mật khẩu (tối thiểu 8 ký tự)"
                >
                <p class="text-xs text-on-surface-variant mt-1">Tối thiểu 8 ký tự</p>
            </div>

            <!-- Xác nhận mật khẩu -->
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Xác nhận mật khẩu <span class="text-red-500">*</span></label>
                <input 
                    type="password" 
                    name="confirm_password" 
                    required 
                    class="w-full px-4 py-3 rounded-xl border border-outline focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                    placeholder="Nhập lại mật khẩu"
                >
            </div>

            <!-- Nút hành động -->
            <div class="flex gap-4 pt-4">
                <button 
                    type="submit" 
                    class="flex-1 py-3 bg-primary text-white rounded-xl font-bold hover:bg-blue-700 transition-colors"
                >
                    <span class="material-symbols-outlined" style="vertical-align: middle; margin-right: 8px;">check</span>
                    Tạo Admin
                </button>
                <a 
                    href="/admin/users" 
                    class="flex-1 py-3 bg-surface-container text-on-surface rounded-xl font-bold hover:bg-surface-container text-center transition-colors"
                >
                    <span class="material-symbols-outlined" style="vertical-align: middle; margin-right: 8px;">close</span>
                    Hủy
                </a>
            </div>
        </form>
    </div>

    <!-- Lưu ý -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
        <h3 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
            <span class="material-symbols-outlined">info</span>
            Lưu ý
        </h3>
        <ul class="text-sm text-blue-800 space-y-2">
            <li>✓ Tài khoản admin sẽ được tạo với trạng thái "Hoạt động"</li>
            <li>✓ Admin mới có quyền quản lý toàn bộ hệ thống</li>
            <li>✓ Đảm bảo mật khẩu mạnh và dễ nhớ</li>
            <li>✓ Sau khi tạo, admin mới có thể đăng nhập ngay lập tức</li>
        </ul>
    </div>
</div>

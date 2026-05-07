<div class="space-y-6">
    <!-- Thanh tiêu đề và nút tạo admin -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-on-surface">Quản lý Người dùng</h1>
            <p class="text-on-surface-variant mt-2">Tổng cộng: <strong><?= count($users) ?></strong> người dùng</p>
        </div>
        <a href="/admin/users/create" class="flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-xl font-bold hover:bg-blue-700 transition-colors">
            <span class="material-symbols-outlined">add</span>
            <span>Tạo Admin mới</span>
        </a>
    </div>

    <!-- Thông báo thành công -->
    <?php if(isset($_SESSION['success'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
            <span><?= htmlspecialchars($_SESSION['success']) ?></span>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Bảng danh sách người dùng -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-surface-container border-b border-outline">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold text-on-surface">ID</th>
                        <th class="px-6 py-4 text-left font-bold text-on-surface">Tên đăng nhập</th>
                        <th class="px-6 py-4 text-left font-bold text-on-surface">Họ và tên</th>
                        <th class="px-6 py-4 text-left font-bold text-on-surface">Email</th>
                        <th class="px-6 py-4 text-left font-bold text-on-surface">Vai trò</th>
                        <th class="px-6 py-4 text-left font-bold text-on-surface">Trạng thái</th>
                        <th class="px-6 py-4 text-left font-bold text-on-surface">Ngày tạo</th>
                        <th class="px-6 py-4 text-center font-bold text-on-surface">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($users)): ?>
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-on-surface-variant">Không có người dùng nào</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($users as $user): ?>
                            <tr class="border-b border-outline hover:bg-surface-container-low transition-colors">
                                <td class="px-6 py-4 text-on-surface"><?= htmlspecialchars($user['id']) ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <?php if($user['avatar']): ?>
                                            <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="" class="w-8 h-8 rounded-full">
                                        <?php else: ?>
                                            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">
                                                <?= strtoupper(substr($user['username'], 0, 1)) ?>
                                            </div>
                                        <?php endif; ?>
                                        <span class="text-on-surface font-medium"><?= htmlspecialchars($user['username']) ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-on-surface"><?= htmlspecialchars($user['fullname']) ?></td>
                                <td class="px-6 py-4 text-on-surface"><?= htmlspecialchars($user['email']) ?></td>
                                <td class="px-6 py-4">
                                    <?php if($user['role'] === 'admin'): ?>
                                        <span class="px-3 py-1 bg-primary text-white text-xs font-bold rounded-full">Admin</span>
                                    <?php else: ?>
                                        <span class="px-3 py-1 bg-gray-300 text-gray-700 text-xs font-bold rounded-full">Thành viên</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if($user['status'] === 'active'): ?>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Hoạt động</span>
                                    <?php else: ?>
                                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">Bị khóa</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-on-surface"><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Nút Nâng cấp/Hạ xuống -->
                                        <?php if($user['role'] === 'member'): ?>
                                            <a href="/admin/users/promote?id=<?= $user['id'] ?>" title="Nâng cấp thành Admin" class="p-2 hover:bg-primary-container rounded transition-colors">
                                                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">grade</span>
                                            </a>
                                        <?php else: ?>
                                            <a href="/admin/users/demote?id=<?= $user['id'] ?>" title="Hạ xuống Member" class="p-2 hover:bg-red-100 rounded transition-colors">
                                                <span class="material-symbols-outlined text-red-600">trending_down</span>
                                            </a>
                                        <?php endif; ?>

                                        <!-- Nút Khóa/Mở khóa -->
                                        <?php if($user['status'] === 'active'): ?>
                                            <a href="/admin/users/ban?id=<?= $user['id'] ?>" title="Khóa tài khoản" class="p-2 hover:bg-red-100 rounded transition-colors" onclick="return confirm('Xác nhận khóa tài khoản này?')">
                                                <span class="material-symbols-outlined text-red-600">lock</span>
                                            </a>
                                        <?php else: ?>
                                            <a href="/admin/users/unban?id=<?= $user['id'] ?>" title="Mở khóa tài khoản" class="p-2 hover:bg-green-100 rounded transition-colors">
                                                <span class="material-symbols-outlined text-green-600">lock_open</span>
                                            </a>
                                        <?php endif; ?>

                                        <!-- Nút Xóa -->
                                        <a href="/admin/users/delete?id=<?= $user['id'] ?>" title="Xóa tài khoản" class="p-2 hover:bg-red-100 rounded transition-colors" onclick="return confirm('Bạn chắc chắn muốn xóa tài khoản này không? Hành động này không thể hoàn tác!')">
                                            <span class="material-symbols-outlined text-red-600">delete</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

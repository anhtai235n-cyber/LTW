<!-- Header -->
<header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold tracking-tight text-on-surface">Quản lý Liên hệ</h1>
        <p class="text-on-surface-variant mt-1">Xem và phản hồi các yêu cầu từ khách hàng.</p>
    </div>
</header>

<!-- Stats -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <span class="p-3 bg-blue-100 text-blue-700 rounded-xl material-symbols-outlined">inbox</span>
        </div>
        <p class="text-on-surface-variant text-sm font-medium">Tổng số liên hệ</p>
        <p class="text-2xl font-extrabold text-on-surface"><?= $totalContacts ?></p>
    </div>
    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <span class="p-3 bg-red-100 text-red-700 rounded-xl material-symbols-outlined">mark_email_unread</span>
        </div>
        <p class="text-on-surface-variant text-sm font-medium">Chưa đọc</p>
        <p class="text-2xl font-extrabold text-on-surface"><?= $unreadContacts ?></p>
    </div>
</section>

<!-- Contacts Table -->
<div class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low border-b-0">
                    <th class="px-6 py-5 font-bold text-on-surface-variant text-sm">NGÀY GỬI</th>
                    <th class="px-6 py-5 font-bold text-on-surface-variant text-sm">KHÁCH HÀNG</th>
                    <th class="px-6 py-5 font-bold text-on-surface-variant text-sm">NỘI DUNG LỜI NHẮN</th>
                    <th class="px-6 py-5 font-bold text-on-surface-variant text-sm text-center">TRẠNG THÁI</th>
                    <th class="px-6 py-5 font-bold text-on-surface-variant text-sm text-right">HÀNH ĐỘNG</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                <?php if (count($contacts) > 0): ?>
                    <?php foreach($contacts as $contact): ?>
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-6 py-5 text-sm text-on-surface-variant whitespace-nowrap">
                            <?= date('d/m/Y H:i', strtotime($contact['created_at'])) ?>
                        </td>
                        <td class="px-6 py-5">
                            <div class="font-bold text-on-surface"><?= htmlspecialchars($contact['customer_name']) ?></div>
                            <div class="text-xs text-outline mt-1"><?= htmlspecialchars($contact['customer_email']) ?></div>
                        </td>
                        <td class="px-6 py-5 max-w-md">
                            <p class="text-sm text-on-surface-variant line-clamp-2" title="<?= htmlspecialchars($contact['message']) ?>">
                                <?= htmlspecialchars($contact['message']) ?>
                            </p>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <form action="/index.php?url=admin/contact_status" method="POST" class="inline-block">
                                <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                                <select name="status" onchange="this.form.submit()" class="text-xs font-bold rounded-full px-3 py-1 border-none focus:ring-0
                                    <?php 
                                        if($contact['status'] == 'unread') echo 'bg-red-100 text-red-700';
                                        elseif($contact['status'] == 'read') echo 'bg-gray-100 text-gray-700';
                                        elseif($contact['status'] == 'replied') echo 'bg-green-100 text-green-700';
                                    ?>
                                ">
                                    <option value="unread" <?= $contact['status'] == 'unread' ? 'selected' : '' ?>>Chưa đọc</option>
                                    <option value="read" <?= $contact['status'] == 'read' ? 'selected' : '' ?>>Đã đọc</option>
                                    <option value="replied" <?= $contact['status'] == 'replied' ? 'selected' : '' ?>>Đã phản hồi</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-5 text-right space-x-2 whitespace-nowrap">
                            <a href="mailto:<?= htmlspecialchars($contact['customer_email']) ?>" title="Gửi email phản hồi" class="inline-block p-2 text-outline hover:text-primary hover:bg-primary/5 rounded-lg transition-all">
                                <span class="material-symbols-outlined text-xl">reply</span>
                            </a>
                            <a href="/index.php?url=admin/contact_delete?id=<?= $contact['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá liên hệ này?')" class="inline-block p-2 text-outline hover:text-error hover:bg-error/5 rounded-lg transition-all">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-on-surface-variant">Chưa có liên hệ nào từ khách hàng.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

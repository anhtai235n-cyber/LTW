<header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold tracking-tight text-on-surface">Quản lý Đặt Tour</h1>
        <p class="text-on-surface-variant mt-1">Theo dõi và xử lý các đơn đặt tour từ khách hàng.</p>
    </div>
</header>

<div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm overflow-x-auto">
    <table class="w-full text-left whitespace-nowrap">
        <thead>
            <tr class="border-b border-surface-container-high">
                <th class="py-4 px-4 font-semibold text-on-surface-variant">Mã / Ngày đặt</th>
                <th class="py-4 px-4 font-semibold text-on-surface-variant">Khách hàng</th>
                <th class="py-4 px-4 font-semibold text-on-surface-variant">Tour / Ngày đi</th>
                <th class="py-4 px-4 font-semibold text-on-surface-variant">Số tiền</th>
                <th class="py-4 px-4 font-semibold text-on-surface-variant">Trạng thái</th>
                <th class="py-4 px-4 font-semibold text-on-surface-variant">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($bookings) && count($bookings) > 0): ?>
                <?php foreach($bookings as $booking): ?>
                <tr class="border-b border-surface-container-low hover:bg-surface-container-low/50 transition-colors">
                    <td class="py-4 px-4">
                        <div class="font-bold text-on-surface">#<?= $booking['id'] ?></div>
                        <div class="text-sm text-on-surface-variant"><?= date('d/m/Y', strtotime($booking['created_at'])) ?></div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="font-bold text-on-surface"><?= htmlspecialchars($booking['customer_name']) ?></div>
                        <div class="text-sm text-on-surface-variant"><?= htmlspecialchars($booking['customer_phone']) ?></div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="font-medium text-on-surface text-wrap min-w-[200px]"><?= htmlspecialchars($booking['tour_name'] ?? 'Tour đã bị xóa') ?></div>
                        <div class="text-sm text-on-surface-variant mt-1"><span class="font-bold">Ngày đi:</span> <?= date('d/m/Y', strtotime($booking['booking_date'])) ?> • <?= $booking['guests'] ?> Khách</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="font-bold text-primary"><?= number_format((float)$booking['total_price'], 0, ',', '.') ?>đ</div>
                        <div class="text-xs text-on-surface-variant"><?= $booking['payment_method'] == 'transfer' ? 'Chuyển khoản' : 'Tại văn phòng' ?></div>
                    </td>
                    <td class="py-4 px-4">
                        <?php if($booking['status'] == 'pending'): ?>
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">Chờ xử lý</span>
                        <?php elseif($booking['status'] == 'confirmed'): ?>
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">Đã xác nhận</span>
                        <?php else: ?>
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">Đã hủy</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-4">
                        <form action="/admin/booking_status" method="POST" class="flex gap-2">
                            <input type="hidden" name="id" value="<?= $booking['id'] ?>">
                            <select name="status" class="px-3 py-2 rounded-xl bg-surface-container border-none text-sm outline-none">
                                <option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                                <option value="confirmed" <?= $booking['status'] == 'confirmed' ? 'selected' : '' ?>>Xác nhận</option>
                                <option value="cancelled" <?= $booking['status'] == 'cancelled' ? 'selected' : '' ?>>Hủy</option>
                            </select>
                            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-xl text-sm font-bold shadow-sm hover:scale-105 transition">Lưu</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="py-12 text-center text-on-surface-variant">Chưa có đơn đặt tour nào.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
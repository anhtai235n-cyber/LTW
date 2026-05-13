<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-on-surface">Quản lý Đặt tour</h1>
            <p class="text-on-surface-variant mt-2">Xem và cập nhật trạng thái các đơn đặt tour.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-surface-container border-b border-outline">
                    <tr>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Mã đơn</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Tour</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Khách hàng</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Ngày đặt</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Số khách</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Tổng tiền</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Khởi hành / Phương tiện</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Trạng thái</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Ghi chú</th>
                        <th class="px-6 py-4 text-sm font-bold text-on-surface">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bookings)): ?>
                        <?php foreach ($bookings as $booking): ?>
                            <tr class="border-b border-outline hover:bg-surface-container-low transition-colors">
                                <td class="px-6 py-4 text-on-surface">#<?= htmlspecialchars($booking['id']) ?></td>
                                <td class="px-6 py-4 text-on-surface"><?= htmlspecialchars($booking['tour_name'] ?? 'Không xác định') ?></td>
                                <td class="px-6 py-4 text-on-surface">
                                    <div class="font-medium"><?= htmlspecialchars($booking['customer_name']) ?></div>
                                    <div class="text-sm text-on-surface-variant"><?= htmlspecialchars($booking['customer_email']) ?></div>
                                    <div class="text-sm text-slate-500">SĐT: <?= htmlspecialchars($booking['customer_phone']) ?></div>
                                </td>
                                <td class="px-6 py-4 text-on-surface"><?= date('d/m/Y', strtotime($booking['booking_date'])) ?></td>
                                <td class="px-6 py-4 text-on-surface"><?= htmlspecialchars($booking['guests']) ?></td>
                                <td class="px-6 py-4 text-on-surface"><?= number_format($booking['total_price'], 0, ',', '.') ?>đ</td>
                                <td class="px-6 py-4 text-on-surface">
                                    <div class="space-y-2 text-sm text-slate-700">
                                        <div><strong>Khởi hành:</strong> <?= htmlspecialchars($booking['departure_location'] ?? 'Chưa xác định') ?></div>
                                        <div><strong>Phương tiện:</strong> <?= htmlspecialchars($booking['transport_method'] ?? 'Chưa xác định') ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?= $booking['status'] === 'confirmed' ? 'bg-green-100 text-green-700' : ($booking['status'] === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') ?>">
                                        <?= ucfirst($booking['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-700">
                                    <?= htmlspecialchars($booking['confirmation_message'] ?? 'Chưa có ghi chú') ?>
                                    <?php if (!empty($booking['special_requests'])): ?>
                                        <div class="mt-2 text-slate-500"><strong>Yêu cầu: </strong><?= nl2br(htmlspecialchars($booking['special_requests'])) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if ($booking['status'] === 'pending'): ?>
                                    <div class="flex flex-wrap gap-2">
                                        <form method="POST" action="/index.php?url=admin/booking_status" class="inline">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($booking['id']) ?>">
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="inline-flex items-center px-3 py-2 rounded-xl bg-green-600 text-white text-sm font-medium hover:bg-green-700 transition">Xác nhận</button>
                                        </form>
                                        <form method="POST" action="/index.php?url=admin/booking_status" class="inline">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($booking['id']) ?>">
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="inline-flex items-center px-3 py-2 rounded-xl bg-red-100 text-red-700 text-sm font-medium hover:bg-red-200 transition">Hủy</button>
                                        </form>
                                    </div>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-semibold <?= $booking['status'] === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                                            <?= $booking['status'] === 'confirmed' ? 'Đã xác nhận' : 'Đã hủy' ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-on-surface-variant">Hiện không có đơn đặt tour nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


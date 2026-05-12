<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Thanh Toán | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>
    <link rel="stylesheet" href="/public/css/scrollAnimations.css">
</head>
<body class="bg-[#faf8ff] text-slate-800 font-sans">
    <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="index.php?url=profile" class="text-2xl font-bold text-slate-900">CloudJourney</a>
            <a href="index.php?url=profile" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                <span class="material-symbols-outlined text-sm mr-1">arrow_back</span> Quay lại hồ sơ
            </a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12 scroll-reveal reveal-from-bottom reveal-delay-150">
        <?php if(isset($user) && isset($action)): ?>
            <?php if($action === 'paymentInfo'): ?>
                <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-700 px-8 py-6">
                        <h1 class="text-2xl font-bold text-white">Thông Tin Thanh Toán</h1>
                        <p class="text-green-100 mt-1">Quản lý thông tin thẻ tín dụng và thanh toán</p>
                    </div>

                    <form action="index.php?url=profile/paymentInfo" method="POST" class="p-8">
                        <?php if(isset($_SESSION['payment_error'])): ?>
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-red-700 font-semibold">Lỗi!</p>
                                <p class="text-red-600 text-sm mt-1"><?= htmlspecialchars($_SESSION['payment_error']) ?></p>
                            </div>
                            <?php unset($_SESSION['payment_error']); ?>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['payment_success'])): ?>
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <p class="text-green-700 font-semibold">Thành công!</p>
                                <p class="text-green-600 text-sm mt-1"><?= htmlspecialchars($_SESSION['payment_success']) ?></p>
                            </div>
                            <?php unset($_SESSION['payment_success']); ?>
                        <?php endif; ?>

                        <!-- Card Info -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-green-700">credit_card</span>
                                Thông Tin Thẻ Tín Dụng
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="card_holder" class="block text-sm font-semibold text-slate-700 mb-2">Tên Chủ Thẻ *</label>
                                    <input type="text" id="card_holder" name="card_holder" required
                                           value="<?= htmlspecialchars($paymentInfo['card_holder'] ?? '') ?>"
                                           class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                           placeholder="NGUYEN VAN A">
                                </div>
                                <div class="md:col-span-2">
                                    <label for="card_number" class="block text-sm font-semibold text-slate-700 mb-2">Số Thẻ *</label>
                                    <input type="text" id="card_number" name="card_number" required
                                           value="<?= htmlspecialchars($paymentInfo['card_number'] ?? '') ?>"
                                           class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                           placeholder="1234 5678 9012 3456" maxlength="19">
                                </div>
                                <div>
                                    <label for="expiry_date" class="block text-sm font-semibold text-slate-700 mb-2">Ngày Hết Hạn *</label>
                                    <input type="text" id="expiry_date" name="expiry_date" required
                                           value="<?= htmlspecialchars($paymentInfo['expiry_date'] ?? '') ?>"
                                           class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                           placeholder="MM/YY" maxlength="5">
                                </div>
                                <div>
                                    <label for="cvv" class="block text-sm font-semibold text-slate-700 mb-2">CVV *</label>
                                    <input type="text" id="cvv" name="cvv" required
                                           value="<?= htmlspecialchars($paymentInfo['cvv'] ?? '') ?>"
                                           class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                           placeholder="123" maxlength="4">
                                </div>
                            </div>
                        </div>

                        <!-- Billing Address -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-green-700">location_on</span>
                                Địa Chỉ Thanh Toán
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="billing_address" class="block text-sm font-semibold text-slate-700 mb-2">Địa Chỉ *</label>
                                    <textarea id="billing_address" name="billing_address" rows="3" required
                                              class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                              placeholder="123 Đường ABC, Phường XYZ, Quận 1, TP.HCM"><?= htmlspecialchars($paymentInfo['billing_address'] ?? '') ?></textarea>
                                </div>
                                <div>
                                    <label for="billing_city" class="block text-sm font-semibold text-slate-700 mb-2">Thành Phố *</label>
                                    <input type="text" id="billing_city" name="billing_city" required
                                           value="<?= htmlspecialchars($paymentInfo['billing_city'] ?? '') ?>"
                                           class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                           placeholder="TP.HCM">
                                </div>
                                <div>
                                    <label for="billing_zip" class="block text-sm font-semibold text-slate-700 mb-2">Mã Bưu Chính</label>
                                    <input type="text" id="billing_zip" name="billing_zip"
                                           value="<?= htmlspecialchars($paymentInfo['billing_zip'] ?? '') ?>"
                                           class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                           placeholder="70000">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-green-700 hover:bg-green-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                                <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">save</span>
                                Lưu Thông Tin
                            </button>
                            <a href="index.php?url=profile" class="px-6 py-3 border border-slate-300 text-slate-700 font-semibold rounded-lg hover:bg-slate-50 transition">
                                Hủy
                            </a>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </main>
    <script defer src="/public/js/scrollAnimations.js"></script>
    <script>
        // Format card number with spaces
        document.getElementById('card_number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formatted = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formatted;
        });

        // Format expiry date
        document.getElementById('expiry_date').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });

        // Validate CVV
        document.getElementById('cvv').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '').substring(0, 4);
        });
    </script>
</body>
</html>
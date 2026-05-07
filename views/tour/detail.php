<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tour['name']) ?> | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>
</head>
<body class="bg-[#faf8ff] text-slate-800 font-sans">
    <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="index.php?url=home" class="text-2xl font-bold text-slate-900">CloudJourney</a>
            <a href="index.php?url=home" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                <span class="material-symbols-outlined text-sm mr-1">arrow_back</span> Quay lại
            </a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <!-- Main Image -->
        <div class="mb-8 rounded-3xl overflow-hidden shadow-xl h-96 bg-slate-200">
            <img src="<?= !empty($tour['image_url']) ? '/' . htmlspecialchars($tour['image_url']) : 'uploads/picture1.jfif' ?>" 
                alt="<?= htmlspecialchars($tour['name']) ?>" 
                class="w-full h-full object-cover">
        </div>

        <!-- Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Header -->
                <div>
                    <span class="inline-block bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                        <?= htmlspecialchars($tour['category']) ?>
                    </span>
                    <h1 class="text-4xl font-extrabold text-slate-900 mb-4">
                        <?= htmlspecialchars($tour['name']) ?>
                    </h1>
                    <div class="flex flex-wrap gap-6 mb-6 pb-6 border-b border-slate-200">
                        <div class="flex items-center gap-2 text-lg">
                            <span class="material-symbols-outlined text-blue-700">location_on</span>
                            <span><?= htmlspecialchars($tour['location'] ?? 'Chưa cập nhật') ?></span>
                        </div>
                        <div class="flex items-center gap-2 text-lg">
                            <span class="material-symbols-outlined text-blue-700">schedule</span>
                            <span><?= htmlspecialchars($tour['duration'] ?? 'Chưa cập nhật') ?></span>
                        </div>
                        <div class="flex items-center gap-2 text-lg">
                            <span class="material-symbols-outlined text-blue-700">attach_money</span>
                            <span class="font-bold text-orange-600"><?= number_format((float)($tour['price'] ?? 0), 0, ',', '.') ?>đ/khách</span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-700">description</span> Mô tả Tour
                    </h2>
                    <p class="text-lg text-slate-700 leading-relaxed">
                        <?= nl2br(htmlspecialchars($tour['description'] ?? 'Chưa có mô tả')) ?>
                    </p>
                </div>

                <!-- Highlights -->
                <?php if(!empty($tour['highlights'])): ?>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-700">star</span> Điểm Nổi Bật
                    </h2>
                    <ul class="space-y-3">
                        <?php foreach(array_filter(array_map('trim', explode("\n", $tour['highlights']))) as $highlight): ?>
                            <li class="flex gap-3">
                                <span class="text-blue-600 font-bold">✓</span>
                                <span class="text-slate-700"><?= htmlspecialchars($highlight) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- Itinerary -->
                <?php if(!empty($tour['itinerary'])): ?>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-700">trip</span> Lịch Trình Chi Tiết
                    </h2>
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 space-y-4">
                        <?php foreach(array_filter(array_map('trim', explode("\n", $tour['itinerary']))) as $day): ?>
                            <div class="pb-4 border-b border-slate-100 last:border-b-0">
                                <p class="text-slate-700 leading-relaxed"><?= htmlspecialchars($day) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Policy -->
                <?php if(!empty($tour['policy'])): ?>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-700">policy</span> Chính Sách Hủy
                    </h2>
                    <div class="bg-orange-50 border border-orange-200 rounded-2xl p-6">
                        <p class="text-slate-700 leading-relaxed">
                            <?= nl2br(htmlspecialchars($tour['policy'])) ?>
                        </p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Image Gallery -->
                <?php if(!empty($tourImages) && count($tourImages) > 0): ?>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-700">image</span> Thư Viện Ảnh
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <?php foreach($tourImages as $img): ?>
                            <div class="rounded-2xl overflow-hidden h-48 bg-slate-200 group cursor-pointer">
                                <img src="/<?= htmlspecialchars($img['image_url']) ?>" 
                                    alt="Ảnh tour" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar - Booking Form -->
            <aside class="lg:col-span-1">
                <div class="sticky top-24 bg-white rounded-3xl p-8 border border-slate-200 shadow-xl">
                    <!-- Price Summary -->
                    <div class="mb-6">
                        <p class="text-slate-600 text-sm mb-2">Giá mỗi khách</p>
                        <p class="text-3xl font-extrabold text-orange-600">
                            <?= number_format((float)($tour['price'] ?? 0), 0, ',', '.') ?>đ
                        </p>
                    </div>

                    <!-- Booking Form -->
                    <form id="bookingForm" class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Ngày đi</label>
                            <input type="date" id="bookingDate" name="booking_date" required 
                                class="w-full px-4 py-2 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none"
                                min="<?= date('Y-m-d') ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Số lượng khách</label>
                            <div class="flex items-center border border-slate-300 rounded-xl">
                                <button type="button" onclick="changeGuests(-1)" class="px-4 py-2 font-bold text-slate-600">−</button>
                                <input type="number" id="guestCount" name="guests" value="1" min="1" max="20" required 
                                    class="flex-1 text-center border-0 outline-none font-bold">
                                <button type="button" onclick="changeGuests(1)" class="px-4 py-2 font-bold text-slate-600">+</button>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-200">
                            <div class="flex justify-between mb-2">
                                <span class="text-slate-600">Tổng tiền</span>
                                <span class="font-bold text-lg" id="totalPrice">
                                    <?= number_format((float)($tour['price'] ?? 0), 0, ',', '.') ?>đ
                                </span>
                            </div>
                        </div>

                        <a href="index.php?url=payment&tour_id=<?= $tour['id'] ?>&date=<?= date('Y-m-d') ?>&guests=1" 
                            id="bookBtn" 
                            class="block w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-xl transition text-center mt-6">
                            Đặt Tour Ngay
                        </a>
                    </form>

                    <!-- Info -->
                    <div class="mt-8 pt-6 border-t border-slate-200 space-y-3 text-sm text-slate-600">
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm text-blue-700">verified</span>
                            Giữ chỗ miễn phí 48h
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm text-blue-700">verified</span>
                            Không phí dịch vụ
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm text-blue-700">verified</span>
                            Hỗ trợ 24/7
                        </p>
                    </div>
                </div>
            </aside>
        </div>

        <!-- Ratings Section -->
        <div class="mt-12 pt-12 border-t-2 border-slate-300">
            <h2 class="text-3xl font-bold text-slate-900 mb-8 flex items-center gap-2">
                <span class="material-symbols-outlined text-amber-500">star</span>
                Đánh Giá &amp; Nhận Xét (<?= isset($ratings) ? count($ratings) : 0 ?>)
            </h2>

            <!-- Rating Stats -->
            <?php if(isset($ratingStats) && $ratingStats['count'] > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <!-- Overall Rating -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200 text-center">
                        <p class="text-sm text-slate-600 mb-2">Đánh giá trung bình</p>
                        <div class="flex items-center justify-center gap-2 mb-4">
                            <span class="text-5xl font-extrabold text-amber-500"><?= number_format($ratingStats['average'], 1, ',', '.') ?></span>
                            <span class="text-3xl text-amber-500">/5</span>
                        </div>
                        <div class="flex justify-center gap-1">
                            <?php for($i = 0; $i < round($ratingStats['average']); $i++): ?>
                                <span class="material-symbols-outlined text-amber-500">star</span>
                            <?php endfor; ?>
                            <?php for($i = round($ratingStats['average']); $i < 5; $i++): ?>
                                <span class="material-symbols-outlined text-slate-300">star</span>
                            <?php endfor; ?>
                        </div>
                        <p class="text-sm text-slate-500 mt-4">Từ <?= $ratingStats['count'] ?> đánh giá</p>
                    </div>

                    <!-- Rating Distribution -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200 md:col-span-2">
                        <p class="font-semibold text-slate-900 mb-4">Phân bố đánh giá</p>
                        <div class="space-y-3">
                            <?php for($rating = 5; $rating >= 1; $rating--): ?>
                                <div class="flex items-center gap-2">
                                    <span class="w-12 text-sm font-semibold text-slate-600"><?= $rating ?> ★</span>
                                    <div class="flex-1 h-3 bg-slate-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-amber-500" 
                                            style="width: <?= $ratingStats['count'] > 0 ? (($ratingStats['distribution'][$rating] ?? 0) / $ratingStats['count'] * 100) : 0 ?>%">
                                        </div>
                                    </div>
                                    <span class="w-12 text-sm text-slate-500 text-right"><?= $ratingStats['distribution'][$rating] ?? 0 ?></span>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Submit Rating Form (only if logged in) -->
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-8 mb-12">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Chia sẻ đánh giá của bạn</h3>
                    <form method="POST" action="index.php?url=tour/rate" class="space-y-6">
                        <input type="hidden" name="tour_id" value="<?= $tour['id'] ?>">
                        
                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3">Đánh giá của bạn</label>
                            <div class="flex gap-3">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="rating" value="<?= $i ?>" required style="display:none;">
                                        <span class="material-symbols-outlined text-5xl text-slate-300 hover:text-amber-400 transition star-rating" data-rating="<?= $i ?>">star</span>
                                    </label>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <!-- Comment -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3">Nhận xét (tùy chọn)</label>
                            <textarea name="comment" rows="4" placeholder="Chia sẻ trải nghiệm của bạn về tour này..." 
                                class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>

                        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                            <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">send</span> Gửi Đánh Giá
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-8 mb-12">
                    <p class="text-slate-700">
                        <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">lock</span>
                        Vui lòng <a href="index.php?url=login" class="text-blue-700 font-semibold hover:underline">đăng nhập</a> để gửi đánh giá
                    </p>
                </div>
            <?php endif; ?>

            <!-- Ratings List -->
            <?php if(isset($ratings) && count($ratings) > 0): ?>
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Tất cả đánh giá</h3>
                    <?php foreach($ratings as $rating): ?>
                        <div class="bg-white rounded-xl border border-slate-200 p-6">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <p class="font-semibold text-slate-900"><?= htmlspecialchars($rating['user_name'] ?? 'Ẩn danh') ?></p>
                                    <p class="text-sm text-slate-500">
                                        <?= date('d/m/Y', strtotime($rating['created_at'])) ?>
                                    </p>
                                </div>
                                <div class="flex gap-1">
                                    <?php for($i = 0; $i < $rating['rating']; $i++): ?>
                                        <span class="material-symbols-outlined text-amber-500 text-sm">star</span>
                                    <?php endfor; ?>
                                    <?php for($i = $rating['rating']; $i < 5; $i++): ?>
                                        <span class="material-symbols-outlined text-slate-300 text-sm">star</span>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <?php if(!empty($rating['comment'])): ?>
                                <p class="text-slate-700 leading-relaxed">
                                    <?= nl2br(htmlspecialchars($rating['comment'])) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="material-symbols-outlined text-5xl text-slate-300 block mx-auto mb-4">star_outline</span>
                    <p class="text-slate-500 text-lg">Chưa có đánh giá nào. Hãy là người đầu tiên!</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script>
        const tourPrice = <?= (float)($tour['price'] ?? 0) ?>;
        
        function changeGuests(delta) {
            const input = document.getElementById('guestCount');
            const newValue = parseInt(input.value) + delta;
            if (newValue >= 1 && newValue <= 20) {
                input.value = newValue;
                updateTotal();
                updateBookingLink();
            }
        }

        function updateTotal() {
            const guests = parseInt(document.getElementById('guestCount').value);
            const total = tourPrice * guests;
            document.getElementById('totalPrice').textContent = 
                new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND',
                    minimumFractionDigits: 0
                }).format(total).replace('₫', 'đ');
        }

        function updateBookingLink() {
            const date = document.getElementById('bookingDate').value || new Date().toISOString().split('T')[0];
            const guests = document.getElementById('guestCount').value;
            const link = `index.php?url=payment&tour_id=<?= $tour['id'] ?>&date=${date}&guests=${guests}`;
            document.getElementById('bookBtn').href = link;
        }

        document.getElementById('bookingDate').addEventListener('change', updateBookingLink);
        document.getElementById('guestCount').addEventListener('change', () => {
            updateTotal();
            updateBookingLink();
        });

        // Set min date to today
        document.getElementById('bookingDate').valueAsDate = new Date();

        // Star rating functionality
        document.querySelectorAll('.star-rating').forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.dataset.rating;
                document.querySelector(`input[value="${rating}"]`).checked = true;
                
                // Update visual feedback
                document.querySelectorAll('.star-rating').forEach(s => {
                    if(s.dataset.rating <= rating) {
                        s.classList.remove('text-slate-300');
                        s.classList.add('text-amber-400');
                    } else {
                        s.classList.remove('text-amber-400');
                        s.classList.add('text-slate-300');
                    }
                });
            });

            // Hover effect
            star.addEventListener('mouseenter', function() {
                const rating = this.dataset.rating;
                document.querySelectorAll('.star-rating').forEach(s => {
                    if(s.dataset.rating <= rating) {
                        s.classList.add('text-amber-400');
                    } else {
                        s.classList.remove('text-amber-400');
                    }
                });
            });
        });

        // Reset stars on mouse leave
        const ratingForm = document.querySelector('form[action*="tour/rate"]');
        if(ratingForm) {
            ratingForm.addEventListener('mouseleave', function() {
                const checked = document.querySelector('input[name="rating"]:checked');
                document.querySelectorAll('.star-rating').forEach(s => {
                    if(checked && s.dataset.rating <= checked.value) {
                        s.classList.add('text-amber-400');
                        s.classList.remove('text-slate-300');
                    } else {
                        s.classList.remove('text-amber-400');
                        s.classList.add('text-slate-300');
                    }
                });
            });
        }
    </script>
</body>
</html>

﻿<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudJourney - Khám phá hành trình tuyệt vời của bạn</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-panel { background: rgba(255,255,255,0.72); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#faf8ff] text-[#191b23] font-sans">
<nav class="fixed inset-x-0 top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 md:px-8 h-24 flex items-center justify-between">
        <div class="flex items-center gap-8">
            <a href="?url=home" class="text-2xl font-bold text-slate-900"><?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?></a>
            <div class="hidden lg:flex items-center gap-6 text-sm font-medium text-slate-600">
                <a href="#destinations" class="hover:text-blue-700 transition">Khám phá</a>
                <a href="index.php?url=about" class="hover:text-blue-700 transition">Về chúng tôi</a>
                <a href="#features" class="hover:text-blue-700 transition">Lý do chọn</a>
                <a href="#testimonials" class="hover:text-blue-700 transition">Đánh giá</a>
                <a href="/contact" class="hover:text-blue-700 transition">Liên hệ</a>
                <a href="index.php?url=news" class="hover:text-blue-700 transition">Tin tức</a>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <button class="rounded-full border border-slate-300 px-4 py-2 text-sm text-slate-600 hover:bg-slate-100 transition">VN/EN</button>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="hidden md:flex items-center gap-4">
                    <span class="text-sm font-medium text-slate-700">Xin chào, <?= htmlspecialchars($_SESSION['fullname']) ?></span>
                    <a href="/logout" class="rounded-full bg-red-500 px-6 py-2 text-sm font-semibold text-white hover:bg-red-600 transition">Đăng xuất</a>
                </div>
            <?php else: ?>
                <a href="index.php?url=login" class="hidden md:inline-flex items-center justify-center rounded-full bg-blue-700 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-800 transition">Đăng nhập</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<main class="pt-24">
    <section class="relative overflow-hidden min-h-[90vh]">
        <div class="absolute inset-0">
            <img src="<?= isset($settings['hero_image']) && $settings['hero_image'] ? htmlspecialchars($settings['hero_image']) : 'uploads/picture1.jfif' ?>" alt="Banner" class="w-full h-full object-cover opacity-90">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-950/25 via-slate-950/10 to-slate-950/35"></div>
        </div>
        <div class="relative z-10 max-w-6xl mx-auto px-6 md:px-8 py-24 text-center text-white">
            <p class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-sm font-medium tracking-wide text-white/90 shadow-lg shadow-slate-950/20"><?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?> • Khám phá hành trình tuyệt vời</p>
            <h1 class="mt-8 text-4xl md:text-6xl font-extrabold leading-tight"><?= htmlspecialchars($settings['hero_title'] ?? 'Khám phá hành trình tuyệt vời của bạn') ?></h1>
            <p class="mt-6 text-base md:text-lg text-white/80">Hành trình trọn vẹn từ khởi hành đến điểm đến, thiết kế riêng cho trải nghiệm du lịch của bạn.</p>
            <form action="index.php" method="GET" class="mt-14 glass-panel rounded-[2rem] border border-white/70 shadow-2xl p-6 md:p-8 text-left">
                <input type="hidden" name="url" value="search">
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-5 items-end">
                    <!-- Location -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3 flex items-center gap-3">
                        <span class="text-xl">📍</span>
                        <div class="flex-1">
                            <p class="text-[9px] uppercase tracking-[0.15em] text-slate-500 font-semibold">Điểm đến</p>
                            <select name="location" class="w-full bg-transparent text-slate-900 outline-none border-none p-0 focus:ring-0 cursor-pointer text-sm font-medium">
                                <option value="">Tất cả</option>
                                <optgroup label="Trong nước">
                                    <option value="Hạ Long">Hạ Long</option>
                                    <option value="Sapa">Sapa</option>
                                    <option value="Đà Nẵng">Đà Nẵng</option>
                                    <option value="Đà Lạt">Đà Lạt</option>
                                    <option value="Phú Quốc">Phú Quốc</option>
                                    <option value="Nha Trang">Nha Trang</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Category -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3 flex items-center gap-3">
                        <span class="text-xl">🏷️</span>
                        <div class="flex-1">
                            <p class="text-[9px] uppercase tracking-[0.15em] text-slate-500 font-semibold">Loại tour</p>
                            <select name="category" class="w-full bg-transparent text-slate-900 outline-none border-none p-0 focus:ring-0 cursor-pointer text-sm font-medium">
                                <option value="all">Tất cả</option>
                                <?php if(isset($categories)): ?>
                                    <?php foreach($categories as $cat): ?>
                                        <option value="<?= htmlspecialchars($cat['category']) ?>">
                                            <?= htmlspecialchars($cat['category']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="Nghỉ dưỡng">Nghỉ dưỡng</option>
                                    <option value="Khám phá">Khám phá</option>
                                    <option value="Giải trí">Giải trí</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Price Min -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3 flex items-center gap-3">
                        <span class="text-xl">💰</span>
                        <div class="flex-1">
                            <p class="text-[9px] uppercase tracking-[0.15em] text-slate-500 font-semibold">Giá từ</p>
                            <input type="number" name="min_price" placeholder="0" class="w-full bg-transparent text-slate-900 outline-none border-none p-0 focus:ring-0 text-sm font-medium placeholder-slate-400" />
                        </div>
                    </div>
                    
                    <!-- Price Max -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3 flex items-center gap-3">
                        <span class="text-xl">💳</span>
                        <div class="flex-1">
                            <p class="text-[9px] uppercase tracking-[0.15em] text-slate-500 font-semibold">Giá đến</p>
                            <input type="number" name="max_price" placeholder="99M" class="w-full bg-transparent text-slate-900 outline-none border-none p-0 focus:ring-0 text-sm font-medium placeholder-slate-400" />
                        </div>
                    </div>
                    
                    <!-- Search Button -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3">
                        <button type="submit" class="w-full h-full min-h-[48px] inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-orange-400/30 hover:shadow-xl hover:-translate-y-0.5 hover:from-orange-600 hover:to-orange-700 transition">
                            🔍 Tìm
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section id="destinations" class="max-w-7xl mx-auto px-6 md:px-8 py-24">
        <div class="text-center mb-14">
            <p class="text-sm uppercase tracking-[0.3em] text-blue-700 font-semibold">Chuyến đi nổi bật</p>
            <h2 class="mt-4 text-4xl md:text-5xl font-extrabold text-slate-900">Chuyến đi kết hợp tiện nghi và cảnh đẹp</h2>
            <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Những hành trình được chọn lọc dành cho bạn để khám phá vẻ đẹp thế giới cùng dịch vụ tận tâm.</p>
        </div>
        <div class="grid gap-8 md:grid-cols-3">
            <?php if (isset($activeTours) && count($activeTours) > 0): ?>
                <?php foreach ($activeTours as $tour): ?>
                <article class="tour-card overflow-hidden rounded-[2rem] bg-white shadow-[0_24px_90px_rgba(15,23,42,0.08)] border border-slate-200">
                    <div class="relative h-72 overflow-hidden">
                        <img src="<?= $tour['image_url'] ? '/' . htmlspecialchars($tour['image_url']) : 'uploads/picture1.jfif' ?>" alt="<?= htmlspecialchars($tour['name']) ?>" class="h-full w-full object-cover transition duration-500 hover:scale-105" />
                        <span class="absolute left-4 top-4 rounded-full bg-white/90 px-4 py-2 text-xs font-semibold text-slate-900 shadow-sm"><?= htmlspecialchars($tour['category']) ?></span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-slate-900 truncate" title="<?= htmlspecialchars($tour['name']) ?>"><?= htmlspecialchars($tour['name']) ?></h3>
                                <p class="mt-2 text-sm text-slate-500 truncate"><span class="material-symbols-outlined text-[14px] align-middle">location_on</span> <?= htmlspecialchars($tour['location'] ?? 'Chưa cập nhật') ?></p>
                                <p class="mt-1 text-sm text-slate-500 truncate"><span class="material-symbols-outlined text-[14px] align-middle">schedule</span> <?= htmlspecialchars($tour['duration'] ?? 'Chưa cập nhật') ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-extrabold text-blue-700"><?= number_format((float)($tour['price'] ?? 0), 0, ',', '.') ?>đ</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-600">⭐ 5.0</span>
                            <a href="?url=tour&id=<?= $tour['id'] ?>" class="rounded-full bg-orange-500 px-5 py-3 text-sm font-semibold text-white hover:bg-orange-600 transition">Xem tour</a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-10">
                    <p class="text-slate-500">Hiện tại chưa có tour nào. Vui lòng quay lại sau.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <section id="features" class="bg-slate-50 py-24">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            <div class="text-center mb-14">
                <p class="text-sm uppercase tracking-[0.3em] text-blue-700 font-semibold">Tại sao chọn CloudJourney?</p>
                <h2 class="mt-4 text-4xl md:text-5xl font-extrabold text-slate-900">Dịch vụ trọn gói, an toàn và đáng tin cậy</h2>
                <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Chúng tôi mang đến sự an tâm và những trải nghiệm độc đáo nhất cho mọi hành trình của bạn.</p>
            </div>
            <div class="grid gap-6 md:grid-cols-4">
                <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-200 text-center transition hover:shadow-lg">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl mx-auto flex items-center justify-center text-blue-700 text-3xl mb-6">✔</div>
                    <h4 class="text-xl font-semibold mb-3">An toàn tuyệt đối</h4>
                    <p class="text-sm text-slate-600">Hệ thống bảo hiểm và hỗ trợ khách hàng 24/7 trên mọi hành trình.</p>
                </div>
                <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-200 text-center transition hover:shadow-lg">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl mx-auto flex items-center justify-center text-blue-700 text-3xl mb-6">💰</div>
                    <h4 class="text-xl font-semibold mb-3">Giá cả cạnh tranh</h4>
                    <p class="text-sm text-slate-600">Cam kết giá tốt nhất với nhiều ưu đãi hấp dẫn.</p>
                </div>
                <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-200 text-center transition hover:shadow-lg">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl mx-auto flex items-center justify-center text-blue-700 text-3xl mb-6">🗺</div>
                    <h4 class="text-xl font-semibold mb-3">Lộ trình đa dạng</h4>
                    <p class="text-sm text-slate-600">Hàng ngàn điểm đến được cập nhật liên tục mỗi tuần.</p>
                </div>
                <div class="rounded-[2rem] bg-white p-8 shadow-sm border border-slate-200 text-center transition hover:shadow-lg">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl mx-auto flex items-center justify-center text-blue-700 text-3xl mb-6">🤝</div>
                    <h4 class="text-xl font-semibold mb-3">Dịch vụ tận tâm</h4>
                    <p class="text-sm text-slate-600">ội ngũ tư vấn viên giàu kinh nghiệm phục vụ chu đáo.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="testimonials" class="py-24">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            <div class="text-center mb-14">
                <p class="text-sm uppercase tracking-[0.3em] text-blue-700 font-semibold">Khách hàng nói gì về chúng tôi</p>
                <h2 class="mt-4 text-4xl md:text-5xl font-extrabold text-slate-900">Trải nghiệm thực tế từ khách hàng</h2>
            </div>
            <div class="grid gap-8 lg:grid-cols-3">
                <div class="rounded-[2rem] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)] border border-slate-200">
                    <p class="text-slate-600">“Mọi chuyến đi đều được tổ chức vô cùng chuyên nghiệp. Tôi không cần phải lo lắng bất cứ điều gì từ lúc đặt tour cho đến khi trở về nhà.”</p>
                    <div class="mt-8">
                        <p class="font-semibold text-slate-900">Minh Anh</p>
                        <p class="text-sm text-slate-500">Giám đốc Sáng tạo</p>
                    </div>
                </div>
                <div class="rounded-[2rem] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)] border border-slate-200">
                    <p class="text-slate-600">“Dịch vụ xuất sắc và giá cả hợp lý. Tour Bali thực sự là một trải nghiệm không thể quên.”</p>
                    <div class="mt-8">
                        <p class="font-semibold text-slate-900">Hoàng Nam</p>
                        <p class="text-sm text-slate-500">Nhà báo du lịch</p>
                    </div>
                </div>
                <div class="rounded-[2rem] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)] border border-slate-200">
                    <p class="text-slate-600">“Hỗ trợ nhiệt tình, tư vấn lộ trình rất hợp lý cho người đi lần đầu. Sẽ quay lại!”</p>
                    <div class="mt-8">
                        <p class="font-semibold text-slate-900">Lan Phương</p>
                        <p class="text-sm text-slate-500">Chuyên viên sự kiện</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-blue-900 text-white py-24">
        <div class="max-w-6xl mx-auto px-6 md:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold">ăng ký để nhận ưu đãi bí mật</h2>
            <p class="mt-4 text-slate-200 max-w-2xl mx-auto">Gia nhập cộng đồng hơn 50,000 người yêu du lịch và nhận những deal hấp dẫn nhất trực tiếp vào email của bạn.</p>
            <div class="mt-10 flex flex-col gap-4 sm:flex-row items-center justify-center">
                <input type="email" placeholder="ịa chỉ email của bạn" class="w-full max-w-xl rounded-full border border-white/30 bg-white/10 px-6 py-4 text-white placeholder:text-slate-200 outline-none focus:border-white focus:bg-white/15" />
                <button class="rounded-full bg-orange-500 px-8 py-4 text-sm font-semibold uppercase tracking-[0.15em] text-white hover:bg-orange-400 transition">ăng ký ngay</button>
            </div>
        </div>
    </section>
</main>
<footer class="bg-slate-950 text-slate-300 py-14">
    <div class="max-w-7xl mx-auto px-6 md:px-8 grid gap-10 lg:grid-cols-4">
        <div>
            <h3 class="text-xl font-semibold text-white"><?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?></h3>
            <p class="mt-4 text-sm text-slate-400">Khám phá thế giới theo cách riêng của bạn. Hành trình trọn vẹn, kết nối toàn cầu.</p>
            <div class="mt-4 space-y-2 text-sm text-slate-400">
                <p>📞 <?= htmlspecialchars($settings['company_phone'] ?? '0901234567') ?></p>
                <p>✉️ <?= htmlspecialchars($settings['company_email'] ?? 'support@cloudjourney.vn') ?></p>
                <p>📍 <?= htmlspecialchars($settings['company_address'] ?? '') ?></p>
            </div>
        </div>
        <div>
            <h4 class="font-semibold text-white mb-4">Công ty</h4>
            <ul class="space-y-3 text-sm text-slate-400">
                <li><a href="index.php?url=about" class="hover:text-white transition">Về chúng tôi</a></li>
                <li>Tuyển dụng</li>
                <li>Tin tức</li>
            </ul>
        </div>
        <div>
            <h4 class="font-semibold text-white mb-4">Hỗ trợ</h4>
            <ul class="space-y-3 text-sm text-slate-400">
                <li>Trung tâm hỗ trợ</li>
                <li>Câu hỏi thường gặp</li>
                <li><a href="/contact" class="hover:text-white transition">Liên hệ</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-semibold text-white mb-4">Pháp lý</h4>
            <ul class="space-y-3 text-sm text-slate-400">
                <li>Chính sách bảo mật</li>
                <li>iều khoản dịch vụ</li>
            </ul>
        </div>
    </div>
    <div class="mt-10 border-t border-slate-800 pt-6 text-center text-sm text-slate-500">© <?= date('Y') ?> <?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?>. Tất cả quyền được bảo lưu.</div>
</footer>
</body>
</html>

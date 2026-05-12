<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về chúng tôi | <?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .fade-in { animation: fadeIn 0.7s ease-out both; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    <link rel="stylesheet" href="/public/css/scrollAnimations.css">
</head>
<body class="bg-[#f8fbff] text-[#17243b] font-sans">
    <nav class="fixed inset-x-0 top-0 z-50 bg-white/95 backdrop-blur-xl border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 md:px-8 h-24 flex items-center justify-between">
            <a href="index.php?url=home" class="text-2xl font-bold text-slate-900"><?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?></a>
            <div class="hidden lg:flex items-center gap-6 text-sm font-medium text-slate-600">
                <a href="index.php?url=home" class="hover:text-blue-700 transition">Trang chủ</a>
                <a href="index.php?url=about" class="text-blue-700 font-semibold">Về chúng tôi</a>
                <a href="index.php?url=home#features" class="hover:text-blue-700 transition">Lý do chọn</a>
                <a href="index.php?url=contact" class="hover:text-blue-700 transition">Liên hệ</a>
                <a href="index.php?url=news" class="hover:text-blue-700 transition">Tin tức</a>
            </div>
            <div class="flex items-center gap-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="hidden md:inline-block text-sm text-slate-600">Xin chào, <?= htmlspecialchars($_SESSION['fullname'] ?? 'Khách') ?></span>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                        <a href="index.php?url=admin" class="hidden md:inline-flex rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition">Admin</a>
                    <?php endif; ?>
                    <a href="index.php?url=logout" class="rounded-full bg-blue-700 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-800 transition">Đăng xuất</a>
                <?php else: ?>
                    <a href="index.php?url=login" class="rounded-full bg-blue-700 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-800 transition">Đăng nhập</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="pt-28 pb-24">
        <section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-blue-900 to-blue-700 text-white scroll-reveal reveal-from-bottom reveal-delay-100">
            <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.25),_transparent_35%)]"></div>
            <div class="max-w-7xl mx-auto px-6 md:px-8 py-20 md:py-24 relative">
                <div class="max-w-3xl fade-in">
                    <p class="text-sm uppercase tracking-[0.4em] text-blue-200/80 mb-4">Về <?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?></p>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">Chúng tôi tạo ra hành trình du lịch trọn vẹn, an toàn và đáng nhớ.</h1>
                    <p class="text-lg md:text-xl text-blue-100/90 leading-relaxed">Từ trải nghiệm khách hàng đến dịch vụ hỗ trợ, CloudJourney đồng hành cùng bạn ở mọi chặng đường với cam kết chất lượng, linh hoạt và thân thiện.</p>
                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="index.php?url=home" class="inline-flex items-center gap-2 rounded-full bg-white text-slate-900 px-6 py-3 font-semibold shadow-lg shadow-slate-950/10 hover:bg-slate-100 transition">Khám phá Tour</a>
                        <a href="index.php?url=contact" class="inline-flex items-center gap-2 rounded-full border border-white/40 px-6 py-3 text-white hover:bg-white/10 transition">Liên hệ tư vấn</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 md:px-8 mt-16 scroll-reveal reveal-from-left reveal-delay-150">
            <div class="grid gap-10 lg:grid-cols-2 items-center">
                <div class="space-y-6 fade-in">
                    <p class="text-sm uppercase tracking-[0.35em] text-blue-700 font-semibold">Lý do chọn CloudJourney</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Hành trình của bạn xứng đáng được lập kế hoạch chuyên nghiệp nhất.</h2>
                    <p class="text-slate-600 text-lg leading-relaxed">Chúng tôi kết nối hành trình với trải nghiệm: lịch trình tối ưu, hỗ trợ 24/7, giá cả công khai và đội ngũ chuyên gia du lịch tận tâm.</p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 mb-4">
                            <span class="material-symbols-outlined">tour</span>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-2">Lịch trình chọn lọc</h3>
                        <p class="text-slate-600">Mỗi tour được thiết kế cân bằng giữa khám phá và trải nghiệm, phù hợp với nhiều nhóm khách.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 mb-4">
                            <span class="material-symbols-outlined">support_agent</span>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-2">Hỗ trợ 24/7</h3>
                        <p class="text-slate-600">Đội ngũ chúng tôi luôn sẵn sàng giải đáp và xử lý nhanh mọi tình huống trong suốt hành trình của bạn.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 mb-4">
                            <span class="material-symbols-outlined">verified</span>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-2">Cam kết chất lượng</h3>
                        <p class="text-slate-600">Giá tour rõ ràng, dịch vụ minh bạch và bảo mật thông tin đặt tour cho khách hàng.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 mb-4">
                            <span class="material-symbols-outlined">groups</span>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-2">Đội ngũ chuyên nghiệp</h3>
                        <p class="text-slate-600">Hướng dẫn viên giàu kinh nghiệm và đối tác địa phương tin cậy, đồng hành cùng bạn từng bước.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="max-w-7xl mx-auto px-6 md:px-8 mt-20 scroll-reveal reveal-from-right reveal-delay-200">
            <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] items-center">
                <div class="space-y-6 fade-in">
                    <p class="text-sm uppercase tracking-[0.35em] text-blue-700 font-semibold">Cam kết dịch vụ</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Chúng tôi không chỉ bán tour, mà còn trao trải nghiệm du lịch chuẩn chỉnh.</h2>
                    <p class="text-slate-600 text-lg leading-relaxed">Mỗi dịch vụ tại CloudJourney đều xây dựng dựa trên sự an tâm, tiện nghi và niềm tin để hành trình của bạn luôn trọn vẹn.</p>
                </div>
                <div class="grid gap-4">
                    <?php $features = [
                        ['icon' => 'shield', 'title' => 'An toàn ưu tiên', 'description' => 'Đảm bảo tour vận hành đúng tiến độ, đối tác hợp tác uy tín.' ],
                        ['icon' => 'payments', 'title' => 'Giá cả công khai', 'description' => 'Không phí ẩn, báo giá rõ ràng ngay từ đầu.' ],
                        ['icon' => 'favorite', 'title' => 'Dịch vụ chăm sóc', 'description' => 'Hỗ trợ trước, trong và sau chuyến đi cho từng khách hàng.' ],
                        ['icon' => 'credit_score', 'title' => 'Đảm bảo linh hoạt', 'description' => 'Đổi lịch, hoàn hủy theo chính sách minh bạch và nhanh chóng.' ],
                    ]; ?>
                    <?php foreach ($features as $item): ?>
                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 mb-4">
                                <span class="material-symbols-outlined"><?= $item['icon'] ?></span>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2"><?= htmlspecialchars($item['title']) ?></h3>
                            <p class="text-slate-600"><?= htmlspecialchars($item['description']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 md:px-8 mt-20">
            <div class="grid gap-10 lg:grid-cols-2 items-center">
                <div class="rounded-[2rem] overflow-hidden bg-gradient-to-br from-blue-700 via-slate-950 to-slate-900 text-white p-12 shadow-2xl fade-in">
                    <p class="text-sm uppercase tracking-[0.35em] text-blue-200 mb-4">Sứ mệnh của chúng tôi</p>
                    <h2 class="text-3xl font-bold mb-6">Mang đến kỳ nghỉ đáng nhớ mà bạn đang tìm kiếm.</h2>
                    <p class="text-lg leading-relaxed text-blue-100 mb-6">CloudJourney hướng đến việc tạo ra hành trình du lịch trọn gói, dễ dàng và đáng tin cậy dành cho mọi đối tượng khách hàng, từ gia đình, cặp đôi đến nhóm bạn.</p>
                    <ul class="space-y-4 text-slate-100">
                        <li class="flex gap-3"><span class="material-symbols-outlined text-blue-200">check_circle</span> Tư vấn cá nhân hóa theo nhu cầu. </li>
                        <li class="flex gap-3"><span class="material-symbols-outlined text-blue-200">check_circle</span> Hỗ trợ đặt vé nhanh chóng, thủ tục tối giản. </li>
                        <li class="flex gap-3"><span class="material-symbols-outlined text-blue-200">check_circle</span> Chăm sóc khách hàng từ khi đặt đến khi kết thúc hành trình. </li>
                    </ul>
                </div>
                <div class="grid gap-4">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <p class="text-sm uppercase tracking-[0.35em] text-blue-700 font-semibold mb-4">Đội ngũ giàu kinh nghiệm</p>
                        <p class="text-slate-600 leading-relaxed">Hướng dẫn và chuyên gia du lịch của chúng tôi đã tổ chức hàng ngàn hành trình nội địa và quốc tế.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <p class="text-sm uppercase tracking-[0.35em] text-blue-700 font-semibold mb-4">Đối tác đáng tin cậy</p>
                        <p class="text-slate-600 leading-relaxed">Mạng lưới đối tác cung cấp khách sạn, vận chuyển và trải nghiệm tại điểm đến có uy tín cao.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <p class="text-sm uppercase tracking-[0.35em] text-blue-700 font-semibold mb-4">Bảo mật thông tin</p>
                        <p class="text-slate-600 leading-relaxed">Dữ liệu khách hàng được bảo vệ nghiêm ngặt và chỉ sử dụng để phục vụ hành trình.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 md:px-8 mt-20">
            <div class="rounded-[2rem] bg-white p-10 shadow-[0_30px_80px_rgba(15,23,42,0.08)]">
                <div class="grid gap-8 lg:grid-cols-3">
                    <div class="fade-in">
                        <p class="text-sm uppercase tracking-[0.35em] text-blue-700 font-semibold mb-4">Kết quả nổi bật</p>
                        <h2 class="text-3xl font-bold text-slate-900 mb-4">Chúng tôi đồng hành cùng bạn trên mọi hành trình.</h2>
                        <p class="text-slate-600 leading-relaxed">Từ hành trình doanh nghiệp đến chuyến đi khám phá, CloudJourney luôn đặt mục tiêu khiến mỗi chuyến đi trở thành kỷ niệm đáng nhớ.</p>
                    </div>
                    <div class="space-y-4">
                        <div class="rounded-3xl border border-slate-200 p-6">
                            <p class="text-4xl font-extrabold text-blue-700">98%</p>
                            <p class="text-slate-600 mt-2">Khách hàng hài lòng với dịch vụ của chúng tôi.</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 p-6">
                            <p class="text-4xl font-extrabold text-blue-700">24/7</p>
                            <p class="text-slate-600 mt-2">Hỗ trợ khách hàng nhanh chóng mọi lúc.</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="rounded-3xl border border-slate-200 p-6">
                            <p class="text-4xl font-extrabold text-blue-700">15+</p>
                            <p class="text-slate-600 mt-2">Điểm đến trong nước và quốc tế được phục vụ.</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 p-6">
                            <p class="text-4xl font-extrabold text-blue-700">500+</p>
                            <p class="text-slate-600 mt-2">Chuyến đi đã tổ chức thành công cho khách hàng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script defer src="/public/js/scrollAnimations.js"></script>
</body>
</html>
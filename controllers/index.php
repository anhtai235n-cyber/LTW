<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về Chúng Tôi | <?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-[#faf8ff] text-[#191b23] font-sans pt-24">

<!-- Navbar -->
<nav class="fixed inset-x-0 top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 md:px-8 h-24 flex items-center justify-between">
        <div class="flex items-center gap-8">
            <a href="index.php?url=home" class="text-2xl font-bold text-slate-900"><?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?></a>
            <div class="hidden lg:flex items-center gap-6 text-sm font-medium text-slate-600">
                <a href="index.php?url=home#destinations" class="hover:text-blue-700 transition">Khám phá</a>
                <a href="index.php?url=about" class="text-blue-700 font-bold transition">Về chúng tôi</a>
                <a href="index.php?url=home#testimonials" class="hover:text-blue-700 transition">Đánh giá</a>
                <a href="index.php?url=contact" class="hover:text-blue-700 transition">Liên hệ</a>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <a href="index.php?url=home" class="hidden md:inline-flex items-center justify-center rounded-full bg-slate-100 px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200 transition">Quay lại Trang chủ</a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="max-w-4xl mx-auto px-6 py-16">
    <div class="text-center mb-16">
        <p class="text-sm uppercase tracking-[0.3em] text-blue-700 font-semibold mb-4">Câu chuyện của chúng tôi</p>
        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-6">Mang thế giới đến gần bạn hơn</h1>
        <p class="text-lg text-slate-600 leading-relaxed">
            Tại <?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?>, chúng tôi tin rằng mỗi chuyến đi không chỉ là việc di chuyển từ nơi này đến nơi khác, mà là một hành trình khám phá bản thân và kết nối với thế giới xung quanh.
        </p>
    </div>

    <div class="rounded-[2rem] overflow-hidden mb-16 shadow-xl shadow-slate-200/50">
        <img src="/<?= htmlspecialchars($settings['hero_image'] ?? 'uploads/picture1.jfif') ?>" alt="About Us" class="w-full h-80 object-cover">
    </div>

    <div class="grid md:grid-cols-2 gap-12 mb-16">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Sứ mệnh</h2>
            <p class="text-slate-600 leading-relaxed">
                Cung cấp những trải nghiệm du lịch trọn vẹn, an toàn và đáng nhớ nhất. Chúng tôi cam kết đồng hành cùng khách hàng trên mọi nẻo đường, mang lại dịch vụ tận tâm với chi phí hợp lý nhất.
            </p>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Tầm nhìn</h2>
            <p class="text-slate-600 leading-relaxed">
                Trở thành nền tảng đặt tour du lịch hàng đầu tại Việt Nam và vươn tầm khu vực. Tiên phong trong việc ứng dụng công nghệ để cá nhân hóa trải nghiệm du lịch cho từng khách hàng.
            </p>
        </div>
    </div>

    <div class="bg-blue-50 rounded-[2rem] p-10 text-center">
        <h2 class="text-2xl font-bold text-slate-900 mb-4">Liên hệ với chúng tôi</h2>
        <p class="text-slate-600 mb-6">Bạn đã sẵn sàng cho chuyến đi tiếp theo chưa? Đội ngũ của chúng tôi luôn ở đây để hỗ trợ bạn.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="index.php?url=contact" class="inline-flex items-center justify-center rounded-full bg-blue-700 px-8 py-3.5 text-sm font-semibold text-white hover:bg-blue-800 transition shadow-lg shadow-blue-700/30">Gửi tin nhắn ngay</a>
            <a href="tel:<?= htmlspecialchars($settings['company_phone'] ?? '') ?>" class="inline-flex items-center justify-center rounded-full bg-white px-8 py-3.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition border border-slate-200">Gọi <?= htmlspecialchars($settings['company_phone'] ?? 'Hotline') ?></a>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-slate-950 text-slate-300 py-14">
    <div class="max-w-7xl mx-auto px-6 md:px-8 text-center">
        <h3 class="text-xl font-semibold text-white mb-4"><?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?></h3>
        <p class="text-sm text-slate-400 mb-6">Khám phá thế giới theo cách riêng của bạn. Hành trình trọn vẹn, kết nối toàn cầu.</p>
        <div class="border-t border-slate-800 pt-6 text-sm text-slate-500">© <?= date('Y') ?> <?= htmlspecialchars($settings['site_name'] ?? 'CloudJourney') ?>. Tất cả quyền được bảo lưu.</div>
    </div>
</footer>
</body>
</html>
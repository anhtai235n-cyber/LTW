<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liên hệ - CloudJourney</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
    <link rel="stylesheet" href="/public/css/scrollAnimations.css">
</head>
<body class="bg-slate-50 text-slate-900">
<nav class="fixed inset-x-0 top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 md:px-8 h-24 flex items-center justify-between">
        <a href="?url=home" class="text-2xl font-bold text-blue-800">CloudJourney</a>
        <div class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600">
            <a href="?url=home" class="hover:text-blue-700 transition">Trang chủ</a>
            <a href="?url=home#destinations" class="hover:text-blue-700 transition">Điểm đến</a>
            <a href="?url=home#features" class="hover:text-blue-700 transition">Lý do chọn</a>
            <a href="?url=contact" class="text-blue-700 font-semibold">Liên hệ</a>
        </div>
        <div class="flex items-center gap-4">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="hidden md:flex items-center gap-4">
                    <span class="text-sm font-medium text-slate-700">Xin chào, <?= htmlspecialchars($_SESSION['fullname']) ?></span>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                        <a href="index.php?url=admin" class="rounded-full bg-slate-700 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition">Admin</a>
                    <?php endif; ?>
                    <a href="index.php?url=logout" class="rounded-full bg-red-500 px-6 py-2 text-sm font-semibold text-white hover:bg-red-600 transition">Đăng xuất</a>
                </div>
            <?php else: ?>
                <a href="index.php?url=login" class="rounded-full bg-blue-700 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-800 transition">Đăng nhập</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<main class="pt-28 pb-16">
    <div class="max-w-5xl mx-auto px-6 md:px-8">
        <div class="rounded-[2rem] overflow-hidden shadow-2xl">
            <div class="bg-[url('uploads/picture1.jfif')] bg-cover bg-center h-72 relative">
                <div class="absolute inset-0 bg-slate-950/50"></div>
                <div class="relative z-10 flex h-full items-center justify-center">
                    <div class="text-center text-white px-6">
                        <p class="text-sm uppercase tracking-[0.3em] mb-3">Liên hệ với chúng tôi</p>
                        <h1 class="text-4xl md:text-5xl font-bold">Chúng tôi sẵn sàng hỗ trợ bạn</h1>
                    </div>
                </div>
            </div>
            <div class="bg-white p-8 md:p-12 grid gap-10 lg:grid-cols-[1.6fr_1fr]">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Gửi tin nhắn cho CloudJourney</h2>
                    <p class="text-slate-600 mb-8">Hãy cho chúng tôi biết nhu cầu của bạn. Đội ngũ tư vấn sẽ phản hồi nhanh nhất trong ngày.</p>
                    
                    <?php if(isset($success)): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6" role="alert">
                            <span class="block sm:inline"><?= htmlspecialchars($success) ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($error)): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-6" role="alert">
                            <span class="block sm:inline"><?= htmlspecialchars($error) ?></span>
                        </div>
                    <?php endif; ?>

                    <form id="contactForm" action="/contact/submit" method="POST" onsubmit="return validateForm()" class="space-y-6">
                        <div>
                            <label class="block mb-2 font-semibold text-slate-700" for="fullname">Họ và tên</label>
                            <input type="text" id="fullname" name="customer_name" class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Nguyễn Văn A" />
                            <p id="error-name" class="text-red-500 text-sm hidden">Vui lòng nhập họ tên ít nhất 3 ký tự.</p>
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold text-slate-700" for="email">Email</label>
                            <input type="email" id="email" name="customer_email" class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="email@vi du.com" />
                            <p id="error-email" class="text-red-500 text-sm hidden">Email không hợp lệ.</p>
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold text-slate-700" for="message">Lời nhắn</label>
                            <textarea id="message" name="message" rows="5" class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-200"></textarea>
                        </div>
                        <button type="submit" class="w-full rounded-3xl bg-blue-700 py-4 text-white text-base font-semibold hover:bg-blue-800 transition">Gửi tin nhắn</button>
                    </form>
                </div>
                <div class="rounded-[2rem] bg-slate-50 p-8 shadow-inner border border-slate-200">
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Thông tin liên hệ</h3>
                    <div class="space-y-5 text-slate-600 text-sm">
                        <div>
                            <p class="font-semibold text-slate-900">Email</p>
                            <p>support@cloudjourney.vn</p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">iện thoại</p>
                            <p>0909 123 456</p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">ịa chỉ</p>
                            <p>123 ường Du Lịch, Quận 1, TP. HCM</p>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">Giờ làm việc</p>
                            <p>Thứ 2 - Thứ 6: 08:00 - 18:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
function validateForm() {
    let isValid = true;
    const name = document.getElementById('fullname').value;
    const email = document.getElementById('email').value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(name.length < 3) {
        document.getElementById('error-name').classList.remove('hidden');
        isValid = false;
    } else {
        document.getElementById('error-name').classList.add('hidden');
    }
    if(!emailRegex.test(email)) {
        document.getElementById('error-email').classList.remove('hidden');
        isValid = false;
    } else {
        document.getElementById('error-email').classList.add('hidden');
    }
    return isValid;
}
</script>
<script defer src="/public/js/scrollAnimations.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>
    <link rel="stylesheet" href="/public/css/scrollAnimations.css">
</head>
<body class="bg-[#faf8ff] text-slate-800 font-sans">
    <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm">
        <div class="max-w-6xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="index.php?url=home" class="text-2xl font-bold text-slate-900">CloudJourney</a>
            <a href="index.php?url=home" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                <span class="material-symbols-outlined text-sm mr-1">arrow_back</span> Quay lại
            </a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <!-- Header -->
        <div class="text-center mb-12 scroll-reveal reveal-from-bottom reveal-delay-100">
            <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Câu Hỏi Thường Gặp (FAQ)</h1>
            <p class="text-lg text-slate-600">Tìm câu trả lời cho những câu hỏi phổ biến của bạn</p>
        </div>

        <!-- FAQ Content -->
        <?php if(isset($faq_grouped) && count($faq_grouped) > 0): ?>
            <div class="space-y-8 scroll-reveal reveal-from-right reveal-delay-150">
                <?php foreach($faq_grouped as $category => $items): ?>
                    <!-- Category Section -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-200">
                        <!-- Category Header -->
                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-6">
                            <h2 class="text-2xl font-bold flex items-center gap-3">
                                <span class="material-symbols-outlined bg-white/20 w-10 h-10 flex items-center justify-center rounded-lg">
                                    help
                                </span>
                                <?= htmlspecialchars($category ?: 'Chung') ?>
                            </h2>
                        </div>

                        <!-- FAQ Items -->
                        <div class="divide-y divide-slate-200">
                            <?php foreach($items as $index => $faq): ?>
                                <div class="faq-item" data-faq-id="<?= $faq['id'] ?>">
                                    <!-- Question -->
                                    <button class="faq-toggle w-full px-8 py-6 text-left hover:bg-slate-50 transition flex items-start justify-between gap-4">
                                        <span class="flex-1">
                                            <h3 class="text-lg font-semibold text-slate-900 text-left">
                                                <?= htmlspecialchars($faq['question']) ?>
                                            </h3>
                                        </span>
                                        <span class="faq-icon material-symbols-outlined text-slate-500 flex-shrink-0 transition-transform duration-300">
                                            expand_more
                                        </span>
                                    </button>

                                    <!-- Answer (Hidden by default) -->
                                    <div class="faq-answer hidden px-8 py-6 bg-slate-50 border-t border-slate-200">
                                        <p class="text-slate-700 leading-relaxed">
                                            <?= nl2br(htmlspecialchars($faq['answer'])) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- No FAQ -->
            <div class="text-center py-12">
                <span class="material-symbols-outlined text-6xl text-slate-300 block mb-4">help_outline</span>
                <p class="text-slate-500 text-lg">Chưa có câu hỏi thường gặp nào.</p>
            </div>
        <?php endif; ?>

        <!-- Contact Section -->
        <div class="mt-16 p-8 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl">
            <h3 class="text-xl font-bold text-slate-900 mb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-blue-700">contact_support</span>
                Không tìm thấy câu trả lời?
            </h3>
            <p class="text-slate-700 mb-4">
                Có câu hỏi hoặc cần hỗ trợ? Vui lòng liên hệ với chúng tôi thông qua:
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="tel:0901234567" class="flex items-center gap-3 p-4 bg-white rounded-lg hover:bg-slate-50 transition">
                    <span class="material-symbols-outlined text-blue-700">phone</span>
                    <div>
                        <p class="font-semibold text-slate-900">0901234567</p>
                        <p class="text-xs text-slate-500">Gọi cho chúng tôi</p>
                    </div>
                </a>
                <a href="mailto:contact@cloudjourney.com" class="flex items-center gap-3 p-4 bg-white rounded-lg hover:bg-slate-50 transition">
                    <span class="material-symbols-outlined text-blue-700">email</span>
                    <div>
                        <p class="font-semibold text-slate-900">contact@cloudjourney.com</p>
                        <p class="text-xs text-slate-500">Gửi email</p>
                    </div>
                </a>
                <a href="index.php?url=contact" class="flex items-center gap-3 p-4 bg-white rounded-lg hover:bg-slate-50 transition">
                    <span class="material-symbols-outlined text-blue-700">message</span>
                    <div>
                        <p class="font-semibold text-slate-900">Liên Hệ</p>
                        <p class="text-xs text-slate-500">Gửi phản hồi</p>
                    </div>
                </a>
            </div>
        </div>
    </main>

    <script>
        // Accordion functionality
        document.querySelectorAll('.faq-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const item = this.closest('.faq-item');
                const answer = item.querySelector('.faq-answer');
                const icon = this.querySelector('.faq-icon');
                
                // Close other open items in the same category
                const parent = item.closest('[class*="bg-white"]');
                parent.querySelectorAll('.faq-item').forEach(otherItem => {
                    if(otherItem !== item) {
                        otherItem.querySelector('.faq-answer').classList.add('hidden');
                        otherItem.querySelector('.faq-icon').style.transform = 'rotate(0deg)';
                    }
                });
                
                // Toggle current item
                answer.classList.toggle('hidden');
                if(answer.classList.contains('hidden')) {
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });
    </script>
    <script defer src="/public/js/scrollAnimations.js"></script>
</body>
</html>

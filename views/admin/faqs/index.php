<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý FAQ | Admin CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans">
    <!-- Admin Header -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-slate-900">Admin Dashboard</h1>
            <a href="index.php?url=admin" class="flex items-center text-slate-600 hover:text-slate-900">
                <span class="material-symbols-outlined text-sm mr-2">arrow_back</span> Quay lại
            </a>
        </div>
    </nav>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-slate-900 text-white p-6 overflow-y-auto">
            <h2 class="text-xl font-bold mb-8">CloudJourney Admin</h2>
            <nav class="space-y-2">
                <a href="index.php?url=admin" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">dashboard</span> Dashboard
                </a>
                <a href="index.php?url=admin/users" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">people</span> Quản Lý User
                </a>
                <a href="index.php?url=admin/news" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">article</span> Quản Lý Tin Tức
                </a>
                <a href="index.php?url=admin/faqs" class="block px-4 py-3 rounded-lg text-sm font-semibold bg-slate-700 text-white">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">help</span> Quản Lý FAQ
                </a>
                <a href="index.php?url=admin/comments" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">comment</span> Duyệt Bình Luận
                </a>
                <a href="index.php?url=admin/ratings" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">star</span> Quản Lý Đánh Giá
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <div class="mb-8 flex items-center justify-between">
                <h2 class="text-3xl font-bold text-slate-900">Quản Lý FAQ</h2>
                <button onclick="openModal('addFaqModal')" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-4 py-2 rounded-lg transition inline-flex items-center">
                    <span class="material-symbols-outlined text-sm mr-2">add</span> Thêm FAQ
                </button>
            </div>

            <!-- FAQs Table -->
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-100 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold text-slate-900">Câu Hỏi</th>
                                <th class="px-6 py-4 text-left font-semibold text-slate-900">Danh Mục</th>
                                <th class="px-6 py-4 text-left font-semibold text-slate-900 w-12">STT</th>
                                <th class="px-6 py-4 text-center font-semibold text-slate-900">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($faqs) && count($faqs) > 0): ?>
                                <?php foreach($faqs as $faq): ?>
                                    <tr class="border-b border-slate-200 hover:bg-slate-50 transition">
                                        <td class="px-6 py-4">
                                            <p class="font-semibold text-slate-900 max-w-xs"><?= htmlspecialchars($faq['question']) ?></p>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600"><?= htmlspecialchars($faq['category'] ?? 'Khác') ?></td>
                                        <td class="px-6 py-4 text-slate-600 text-center"><?= htmlspecialchars($faq['ordering'] ?? '0') ?></td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button onclick="openModal('editFaqModal'); setFaqData(<?= json_encode($faq) ?>)"
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </button>
                                                <form method="POST" action="index.php?url=admin/faqs/delete" style="display:inline;">
                                                    <input type="hidden" name="faq_id" value="<?= $faq['id'] ?>">
                                                    <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa FAQ này?')"
                                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                                        <span class="material-symbols-outlined text-sm">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                        Chưa có FAQ nào
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add FAQ Modal -->
    <div id="addFaqModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4">
            <h3 class="text-2xl font-bold text-slate-900 mb-6">Thêm FAQ</h3>
            <form method="POST" action="index.php?url=admin/faqs/create" class="space-y-4">
                <input type="text" name="question" placeholder="Câu hỏi" required class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <textarea name="answer" placeholder="Câu trả lời" rows="4" required class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                <input type="text" name="category" placeholder="Danh mục (tùy chọn)" class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="number" name="ordering" placeholder="Thứ tự" value="0" class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-blue-700 hover:bg-blue-800 text-white font-semibold px-4 py-2 rounded-lg transition">Lưu</button>
                    <button type="button" onclick="closeModal('addFaqModal')" class="flex-1 bg-slate-200 hover:bg-slate-300 text-slate-900 font-semibold px-4 py-2 rounded-lg transition">Hủy</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit FAQ Modal -->
    <div id="editFaqModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4">
            <h3 class="text-2xl font-bold text-slate-900 mb-6">Chỉnh Sửa FAQ</h3>
            <form method="POST" action="index.php?url=admin/faqs/update" class="space-y-4">
                <input type="hidden" id="editFaqId" name="faq_id">
                <input type="text" id="editQuestion" name="question" placeholder="Câu hỏi" required class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <textarea id="editAnswer" name="answer" placeholder="Câu trả lời" rows="4" required class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                <input type="text" id="editCategory" name="category" placeholder="Danh mục" class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="number" id="editOrdering" name="ordering" placeholder="Thứ tự" class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-blue-700 hover:bg-blue-800 text-white font-semibold px-4 py-2 rounded-lg transition">Lưu</button>
                    <button type="button" onclick="closeModal('editFaqModal')" class="flex-1 bg-slate-200 hover:bg-slate-300 text-slate-900 font-semibold px-4 py-2 rounded-lg transition">Hủy</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
        function setFaqData(faq) {
            document.getElementById('editFaqId').value = faq.id;
            document.getElementById('editQuestion').value = faq.question;
            document.getElementById('editAnswer').value = faq.answer;
            document.getElementById('editCategory').value = faq.category || '';
            document.getElementById('editOrdering').value = faq.ordering || 0;
        }
    </script>
</body>
</html>

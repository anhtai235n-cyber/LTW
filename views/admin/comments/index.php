<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyệt Bình Luận | Admin CloudJourney</title>
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
                <a href="index.php?url=admin/faqs" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">help</span> Quản Lý FAQ
                </a>
                <a href="index.php?url=admin/comments" class="block px-4 py-3 rounded-lg text-sm font-semibold bg-slate-700 text-white">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">comment</span> Duyệt Bình Luận
                </a>
                <a href="index.php?url=admin/ratings" class="block px-4 py-3 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <span class="material-symbols-outlined text-sm mr-3" style="display:inline;">star</span> Quản Lý Đánh Giá
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <h2 class="text-3xl font-bold text-slate-900 mb-8">Duyệt Bình Luận</h2>

            <!-- Comments List -->
            <div class="space-y-6">
                <?php if(isset($comments) && count($comments) > 0): ?>
                    <?php foreach($comments as $comment): ?>
                        <div class="bg-white rounded-xl shadow-lg border border-slate-200 p-6">
                            <!-- Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="font-bold text-slate-900">
                                        <span class="text-sm text-slate-500">Bài viết:</span>
                                        <?= htmlspecialchars($comment['news_title'] ?? 'N/A') ?>
                                    </h3>
                                    <p class="text-sm text-slate-600 mt-1">
                                        <span class="material-symbols-outlined text-xs" style="display:inline;">person</span>
                                        <?= htmlspecialchars($comment['fullname'] ?? 'Ẩn danh') ?>
                                    </p>
                                </div>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    <?php 
                                    switch($comment['status']) {
                                        case 'pending': echo 'bg-yellow-100 text-yellow-700'; break;
                                        case 'approved': echo 'bg-green-100 text-green-700'; break;
                                        case 'rejected': echo 'bg-red-100 text-red-700'; break;
                                        default: echo 'bg-slate-100 text-slate-700';
                                    }
                                    ?>">
                                    <?php 
                                    $status_map = ['pending' => 'Chờ duyệt', 'approved' => 'Đã duyệt', 'rejected' => 'Bị từ chối'];
                                    echo htmlspecialchars($status_map[$comment['status']] ?? 'Không rõ');
                                    ?>
                                </span>
                            </div>

                            <!-- Content -->
                            <p class="text-slate-700 mb-4 p-4 bg-slate-50 rounded-lg border border-slate-200">
                                <?= nl2br(htmlspecialchars($comment['content'])) ?>
                            </p>

                            <!-- Metadata -->
                            <p class="text-xs text-slate-500 mb-4">
                                Ngày: <?= date('d/m/Y H:i', strtotime($comment['created_at'])) ?>
                            </p>

                            <!-- Actions -->
                            <?php if($comment['status'] === 'pending'): ?>
                                <div class="flex gap-3">
                                    <form method="POST" action="index.php?url=admin/comments/approve" style="display:inline;">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <button type="submit" class="px-4 py-2 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-lg transition">
                                            <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">check_circle</span> Duyệt
                                        </button>
                                    </form>
                                    <form method="POST" action="index.php?url=admin/comments/reject" style="display:inline;">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <button type="submit" class="px-4 py-2 bg-red-700 hover:bg-red-800 text-white font-semibold rounded-lg transition">
                                            <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">close</span> Từ chối
                                        </button>
                                    </form>
                                </div>
                            <?php else: ?>
                                <div class="flex gap-3">
                                    <form method="POST" action="index.php?url=admin/comments/delete" style="display:inline;">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa bình luận này?')"
                                            class="px-4 py-2 bg-red-700 hover:bg-red-800 text-white font-semibold rounded-lg transition">
                                            <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">delete</span> Xóa
                                        </button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-12 bg-white rounded-xl border border-slate-200">
                        <span class="material-symbols-outlined text-6xl text-slate-300 block mb-4">chat</span>
                        <p class="text-slate-500 text-lg">Chưa có bình luận nào cần duyệt</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

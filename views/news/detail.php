<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($article) ? htmlspecialchars($article['title']) : 'Tin Tức' ?> | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>
</head>
<body class="bg-[#faf8ff] text-slate-800 font-sans">
    <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur-xl border-b border-slate-200 shadow-sm">
        <div class="max-w-5xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="index.php?url=home" class="text-2xl font-bold text-slate-900">CloudJourney</a>
            <a href="index.php?url=news" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                <span class="material-symbols-outlined text-sm mr-1">arrow_back</span> Quay lại
            </a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php if(isset($article)): ?>
            <!-- Article Header -->
            <article>
                <!-- Featured Image -->
                <?php if(!empty($article['image_url'])): ?>
                    <img src="<?= htmlspecialchars($article['image_url']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" 
                         class="w-full h-72 object-cover rounded-2xl mb-8 shadow-lg">
                <?php else: ?>
                    <div class="w-full h-72 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl mb-8 flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-8xl">landscape</span>
                    </div>
                <?php endif; ?>

                <!-- Title & Meta -->
                <div class="mb-8">
                    <h1 class="text-4xl font-extrabold text-slate-900 mb-4">
                        <?= htmlspecialchars($article['title']) ?>
                    </h1>
                    <div class="flex flex-wrap items-center gap-4 pb-6 border-b border-slate-300">
                        <div class="flex items-center gap-2 text-slate-600">
                            <span class="material-symbols-outlined">calendar_today</span>
                            <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                        </div>
                        <div class="flex items-center gap-2 text-slate-600">
                            <span class="material-symbols-outlined">person</span>
                            <?= htmlspecialchars($article['author_name'] ?? 'Admin') ?>
                        </div>
                        <div class="flex items-center gap-2 text-slate-600">
                            <span class="material-symbols-outlined">visibility</span>
                            <?= number_format($article['views'] ?? 0) ?> lượt xem
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <?php if(!empty($article['description'])): ?>
                    <div class="text-lg text-slate-600 italic mb-8 p-6 bg-blue-50 border-l-4 border-blue-500 rounded">
                        <?= htmlspecialchars($article['description']) ?>
                    </div>
                <?php endif; ?>

                <!-- Keywords -->
                <?php if(!empty($article['keywords'])): ?>
                    <div class="mb-8 flex flex-wrap gap-2">
                        <?php 
                        $keywords = array_filter(array_map('trim', explode(',', $article['keywords'])));
                        foreach($keywords as $keyword):
                        ?>
                            <span class="text-sm bg-slate-200 text-slate-700 px-3 py-1 rounded-full">
                                #<?= htmlspecialchars($keyword) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Content -->
                <div class="prose prose-lg max-w-none mb-12 text-slate-700 leading-relaxed">
                    <?= nl2br(htmlspecialchars($article['content'])) ?>
                </div>
            </article>

            <!-- Comments Section -->
            <div class="mt-12 pt-8 border-t-2 border-slate-300">
                <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined">comment</span>
                    Bình Luận (<?= isset($comments) ? count($comments) : 0 ?>)
                </h2>

                <!-- Add Comment Form (Only if logged in) -->
                <?php 
                $is_logged_in = isset($_SESSION['user_id']);
                if($is_logged_in):
                ?>
                    <form method="POST" action="index.php?url=news/submit_comment" class="mb-10 p-6 bg-white rounded-xl border border-slate-200">
                        <input type="hidden" name="news_id" value="<?= $article['id'] ?>">
                        <input type="hidden" name="slug" value="<?= htmlspecialchars($article['slug']) ?>">
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Bình luận của bạn</label>
                            <textarea name="content" rows="4" required placeholder="Viết bình luận của bạn tại đây..."
                                      class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-2 rounded-lg transition">
                            <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">send</span> Gửi bình luận
                        </button>
                    </form>
                <?php else: ?>
                    <div class="mb-10 p-6 bg-blue-50 border border-blue-200 rounded-xl">
                        <p class="text-slate-700 mb-3">
                            <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">lock</span>
                            Vui lòng <a href="index.php?url=login" class="text-blue-700 font-semibold hover:underline">đăng nhập</a> để bình luận
                        </p>
                    </div>
                <?php endif; ?>

                <!-- Comments List -->
                <?php if(isset($comments) && count($comments) > 0): ?>
                    <div class="space-y-6">
                        <?php foreach($comments as $comment): ?>
                            <div class="p-6 bg-white rounded-xl border border-slate-200">
                                <!-- Comment Header -->
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <p class="font-semibold text-slate-900">
                                            <?= htmlspecialchars($comment['user_name']) ?>
                                        </p>
                                        <p class="text-sm text-slate-500">
                                            <?= date('d/m/Y H:i', strtotime($comment['created_at'])) ?>
                                        </p>
                                    </div>
                                    <?php if($comment['status'] === 'pending'): ?>
                                        <span class="text-xs bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full font-semibold">
                                            <span class="material-symbols-outlined text-xs mr-1" style="display:inline;">schedule</span> Chờ duyệt
                                        </span>
                                    <?php elseif($comment['status'] === 'rejected'): ?>
                                        <span class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded-full font-semibold">
                                            <span class="material-symbols-outlined text-xs mr-1" style="display:inline;">close</span> Bị từ chối
                                        </span>
                                    <?php else: ?>
                                        <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold">
                                            <span class="material-symbols-outlined text-xs mr-1" style="display:inline;">check_circle</span> Đã duyệt
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Comment Content -->
                                <p class="text-slate-700 leading-relaxed">
                                    <?= nl2br(htmlspecialchars($comment['content'])) ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8 text-slate-500">
                        <span class="material-symbols-outlined text-5xl text-slate-300 block mb-3">chat</span>
                        <p>Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
                    </div>
                <?php endif; ?>
            </div>

        <?php else: ?>
            <!-- Not Found -->
            <div class="text-center py-20">
                <span class="material-symbols-outlined text-8xl text-slate-300 block mb-4">article</span>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Bài viết không tồn tại</h2>
                <p class="text-slate-600 mb-6">Bài viết mà bạn tìm kiếm không tồn tại hoặc đã bị xóa.</p>
                <a href="index.php?url=news" class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                    <span class="material-symbols-outlined text-sm mr-2" style="display:inline;">arrow_back</span> Quay lại tin tức
                </a>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>

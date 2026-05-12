<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($article) ? htmlspecialchars($article['title']) : 'Tin Tức' ?> | CloudJourney</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .prose img { border-radius: 1rem; margin: 2rem 0; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
    </style>
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
            <article>
                <?php if(!empty($article['image_url'])): ?>
                    <img src="<?= htmlspecialchars($article['image_url']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" 
                         class="w-full h-[450px] object-cover rounded-3xl mb-10 shadow-xl">
                <?php else: ?>
                    <div class="w-full h-72 bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl mb-10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-8xl">landscape</span>
                    </div>
                <?php endif; ?>

                <header class="mb-10">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-6 leading-tight">
                        <?= htmlspecialchars($article['title']) ?>
                    </h1>
                    <div class="flex flex-wrap items-center gap-6 pb-6 border-b border-slate-200 text-slate-500 italic">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-600">calendar_today</span>
                            <span>Đăng ngày: <?= date('d/m/Y', strtotime($article['created_at'])) ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-600">person</span>
                            <span>Tác giả: <span class="font-semibold text-slate-700"><?= htmlspecialchars($article['author_name'] ?? 'Admin') ?></span></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-600">visibility</span>
                            <span><?= number_format($article['views'] ?? 0) ?> lượt xem</span>
                        </div>
                    </div>
                </header>

                <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed text-lg mb-16">
                    <div class="post-content fs-5 lh-lg mb-5">
                        <?= $article['content'] ?>
                    </div>
                </div>

                <?php if(!empty($article['keywords'])): ?>
                    <div class="mb-12 flex flex-wrap gap-2">
                        <?php 
                        $keywords = array_filter(array_map('trim', explode(',', $article['keywords'])));
                        foreach($keywords as $keyword):
                        ?>
                            <span class="bg-blue-50 text-blue-700 px-4 py-1.5 rounded-full text-sm font-medium border border-blue-100">
                                #<?= htmlspecialchars($keyword) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </article>

            <section class="mt-16 pt-10 border-t-2 border-slate-100">
                <h2 class="text-3xl font-bold text-slate-900 mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined text-3xl text-blue-600">forum</span>
                    Bình luận (<?= isset($comments) ? count($comments) : 0 ?>)
                </h2>

                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 mb-12 shadow-sm">
                        <h5 class="text-lg font-bold mb-4">Gửi bình luận của bạn</h5>
                        <form method="POST" action="index.php?url=news/submit_comment" class="space-y-4">
                            <input type="hidden" name="news_id" value="<?= $article['id'] ?>">
                            <input type="hidden" name="slug" value="<?= htmlspecialchars($article['slug']) ?>">
                            <textarea name="content" rows="4" required 
                                      class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" 
                                      placeholder="Chia sẻ cảm nghĩ của bạn về bài viết..."></textarea>
                            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold px-8 py-3 rounded-xl transition inline-flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">send</span> Gửi bình luận
                            </button>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="bg-slate-100 rounded-2xl p-8 text-center mb-12 border border-dashed border-slate-300">
                        <span class="material-symbols-outlined text-slate-400 text-4xl mb-2">lock</span>
                        <p class="text-slate-600">Vui lòng <a href="index.php?url=login" class="text-blue-700 font-bold hover:underline">đăng nhập</a> để tham gia thảo luận.</p>
                    </div>
                <?php endif; ?>

                <div class="space-y-6">
                    <?php if(!empty($comments)): ?>
                        <?php foreach($comments as $comment): ?>
                            <div id="comment-<?= $comment['id'] ?>" class="flex gap-4 p-6 bg-white rounded-2xl border border-slate-100 shadow-sm transition hover:shadow-md mb-4 scroll-mt-24">
                                
                                <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xl flex-shrink-0">
                                    <?= strtoupper(substr($comment['user_name'] ?? 'A', 0, 1)) ?>
                                </div>

                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <h6 class="font-bold text-slate-900"><?= htmlspecialchars($comment['user_name']) ?></h6>
                                        <span class="text-xs text-slate-400 font-medium"><?= date('H:i d/m/Y', strtotime($comment['created_at'])) ?></span>
                                    </div>

                                    <p class="text-slate-600 leading-relaxed">
                                        <?= nl2br(htmlspecialchars($comment['content'])) ?>
                                    </p>
                                    
                                    <?php if(($comment['status'] ?? '') === 'pending'): ?>
                                        <span class="inline-flex items-center mt-3 px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <span class="material-symbols-outlined text-[14px] mr-1">history</span> Đang chờ duyệt
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-10">
                            <p class="text-slate-400 italic">Chưa có bình luận nào. Hãy khởi đầu cuộc trò chuyện!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

        <?php else: ?>
            <div class="text-center py-24">
                <span class="material-symbols-outlined text-9xl text-slate-200 mb-6">search_off</span>
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Ối! Bài viết không tồn tại</h2>
                <p class="text-slate-500 mb-8">Có vẻ như bài viết đã bị gỡ bỏ hoặc đường dẫn không chính xác.</p>
                <a href="index.php?url=news" class="bg-blue-700 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-800 transition">
                    Quay lại Tin tức
                </a>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
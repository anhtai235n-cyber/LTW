<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-slate-900">Duyệt Bình Luận Mới</h2>
        <p class="text-slate-500 mt-1">Danh sách các bình luận đang chờ bạn phê duyệt.</p>
    </div>

    <div class="space-y-6">
        <?php 
        $hasPending = false;
        if(isset($comments) && count($comments) > 0): 
            foreach($comments as $comment): 
                $current_status = strtolower(trim($comment['status'] ?? ''));
                if ($current_status !== 'pending' && $current_status !== '0' && $current_status !== '') {
                    continue; 
                }
                $hasPending = true;
        ?>
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex flex-wrap items-start justify-between gap-4 mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold">
                                <?= strtoupper(substr($comment['fullname'] ?? 'A', 0, 1)) ?>
                            </div>

                            <div>
                                <h4 class="font-bold text-slate-900"><?= htmlspecialchars($comment['fullname'] ?? 'Ẩn danh') ?></h4>
                                <p class="text-xs text-slate-500 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">article</span>
                                    Bài viết: 
                                    <a href="index.php?url=news/<?= $comment['news_slug'] ?>#comment-<?= $comment['id'] ?>" 
                                       target="_blank" 
                                       class="text-blue-600 font-medium hover:underline flex items-center gap-1">
                                        <?= htmlspecialchars($comment['news_title'] ?? 'N/A') ?>
                                        <span class="material-symbols-outlined text-[12px]">open_in_new</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                        
                    </div>

                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 mb-4">
                        <p class="text-slate-700 leading-relaxed italic">
                            "<?= nl2br(htmlspecialchars($comment['content'])) ?>"
                        </p>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-400 flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">schedule</span>
                            <?= date('H:i - d/m/Y', strtotime($comment['created_at'])) ?>
                        </span>

                        <div class="flex gap-2">
                            <form method="POST" action="index.php?url=admin/comments/approve" class="inline">
                                <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                <button type="submit" class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-lg transition flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">done</span> Duyệt
                                </button>
                            </form>
                            
                            <form method="POST" action="index.php?url=admin/comments/reject" class="inline">
                                <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                <button type="submit" class="px-5 py-2 bg-white hover:bg-red-50 text-slate-600 hover:text-red-600 border border-slate-200 hover:border-red-200 text-sm font-bold rounded-lg transition flex items-center gap-2">
                                    <span class="material-symbols-outlined text-sm">close</span> Từ chối
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if(!$hasPending): ?>
            <div class="text-center py-24 bg-white rounded-2xl border-2 border-dashed border-slate-200">
                <span class="material-symbols-outlined text-7xl text-slate-200 block mb-4">task_alt</span>
                <p class="text-slate-500 font-medium">Tuyệt vời! Không còn bình luận nào chờ phê duyệt.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
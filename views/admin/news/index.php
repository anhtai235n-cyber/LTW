<?php
/**
 * File: views/admin/news/index.php
 * Lưu ý: Không thêm <html>, <head>, <body> hay Sidebar vào đây 
 * vì nó sẽ được nạp vào file admin/layout.php
 */
?>

<div class="max-w-6xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-slate-900">Quản Lý Tin Tức</h2>
            <p class="text-slate-500 text-sm mt-1">Quản lý các bài viết và nội dung blog trên hệ thống</p>
        </div>
        <a href="index.php?url=admin/news/create" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-4 py-2.5 rounded-lg transition inline-flex items-center shadow-md">
            <span class="material-symbols-outlined text-sm mr-2">add</span> Tạo Bài Viết Mới
        </a>
    </div>

    <div class="mb-6">
        <form action="index.php" method="GET" class="flex gap-2">
            <input type="hidden" name="url" value="admin/news">
            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                       placeholder="Tìm kiếm tiêu đề hoặc nội dung bài viết..." 
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
            </div>
            <button type="submit" class="bg-slate-800 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-slate-900 transition">
                Tìm kiếm
            </button>
            <?php if(isset($_GET['search'])): ?>
                <a href="index.php?url=admin/news" class="bg-slate-100 text-slate-600 px-4 py-2.5 rounded-xl font-semibold hover:bg-slate-200 transition flex items-center">
                    Xóa lọc
                </a>
            <?php endif; ?>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 font-semibold text-slate-700">Thông tin bài viết</th>
                    <th class="px-6 py-4 font-semibold text-slate-700 text-center">Trạng Thái</th>
                    <th class="px-6 py-4 font-semibold text-slate-700 text-center">Hành Động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <?php if(!empty($news)): ?>
                    <?php foreach($news as $article): ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900 text-lg mb-1 group">
                                <a href="index.php?url=news/<?= $article['slug'] ?>" 
                                target="_blank" 
                                class="hover:text-blue-700 flex items-center gap-2 transition-colors">
                                    <?= htmlspecialchars($article['title']) ?>
                                    <span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity">
                                        open_in_new
                                    </span>
                                </a>
                            </div>
                            
                            <div class="flex items-center gap-4 text-xs text-slate-500">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">calendar_today</span>
                                    <?= date('d/m/Y', strtotime($article['created_at'])) ?>
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">person</span>
                                    <?= htmlspecialchars($article['author_name'] ?? 'Admin') ?>
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm <?= $article['status'] === 'published' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' ?>">
                                <?= $article['status'] === 'published' ? 'Công khai' : 'Bản nháp' ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-3">
                                <a href="index.php?url=admin/news/edit&id=<?= $article['id'] ?>" 
                                   class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" 
                                   title="Chỉnh sửa">
                                    <span class="material-symbols-outlined">edit_square</span>
                                </a>
                                
                                <form action="index.php?url=admin/news/delete" method="POST" class="inline" 
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                    <input type="hidden" name="news_id" value="<?= $article['id'] ?>">
                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Xóa">
                                        <span class="material-symbols-outlined">delete_forever</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="px-6 py-20 text-center">
                            <span class="material-symbols-outlined text-5xl text-slate-300 block mb-2">article</span>
                            <p class="text-slate-500">Hệ thống chưa có bài viết nào.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
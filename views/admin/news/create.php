<header class="mb-8">
    <h1 class="text-3xl font-extrabold tracking-tight text-on-surface">Tạo Bài Viết Mới</h1>
    <p class="text-on-surface-variant mt-1">Điền thông tin chi tiết để tạo một bài viết mới.</p>
</header>

<div class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm">
    <form action="index.php?url=admin/news_store" method="POST" enctype="multipart/form-data" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-on-surface mb-2">Tiêu Đề Bài Viết</label>
                <input type="text" name="title" required
                    class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40"
                    placeholder="Nhập tiêu đề hấp dẫn...">
            </div>

            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Slug (URL-friendly)</label>
                <input type="text" name="slug"
                    class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40"
                    placeholder="Để trống để tự động tạo">
                <p class="text-xs text-on-surface-variant mt-1">Nếu bỏ trống, slug sẽ được tạo từ tiêu đề.</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Hình Ảnh Đại Diện</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-on-surface mb-2">Mô Tả Ngắn (Meta Description)</label>
                <textarea name="description" rows="2"
                    class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40"
                    placeholder="Mô tả ngắn hiển thị trên trang danh sách..."></textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-on-surface mb-2">Từ Khóa (Keywords - Cách nhau bằng dấu
                    phẩy)</label>
                <input type="text" name="keywords"
                    class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40"
                    placeholder="du lịch, đà lạt, tour, ...">
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Nội Dung Chi Tiết</label>
            <textarea name="content" id="editor" rows="10"
                class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40"
                placeholder="Viết nội dung bài viết ở đây..."></textarea>
        </div>

        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Trạng Thái</label>
            <select name="status"
                class="w-full px-4 py-3 rounded-xl bg-surface-container-low border-none focus:ring-2 focus:ring-primary/40">
                <option value="draft">Nháp (Chưa xuất bản)</option>
                <option value="published">Công khai (Xuất bản)</option>
            </select>
        </div>

        <div class="flex justify-end gap-4 mt-8">
            <a href="/index.php?url=admin/news"
                class="px-6 py-3 bg-surface-container-high text-on-surface rounded-xl font-bold hover:bg-surface-container-highest transition-colors">Hủy</a>
            <button type="submit"
                class="px-6 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">Lưu
                Bài Viết</button>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                items: [
                    'heading', '|', 'bold', 'italic', 'underline', '|',
                    'fontColor', 'fontBackgroundColor', '|',
                    'alignment', '|',
                    'bulletedList', 'numberedList', 'link', 'uploadImage', 'insertTable', '|',
                    'undo', 'redo'
                ]
            },
            ckfinder: {
                uploadUrl: 'controllers/upload_image.php'
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>

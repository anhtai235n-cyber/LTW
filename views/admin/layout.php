<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?= isset($pageTitle) ? $pageTitle : 'Admin Dashboard' ?> - CloudJourney</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#003d9b",
                        "background": "#faf8ff",
                        "surface": "#faf8ff",
                        "on-surface": "#191b23",
                        "surface-container": "#ededf8",
                        "surface-container-low": "#f3f3fd",
                        "surface-container-lowest": "#ffffff",
                        "on-surface-variant": "#434654",
                        "outline": "#737685",
                        "tertiary": "#004c48",
                        "secondary": "#a43c12",
                        "error": "#ba1a1a",
                        "primary-container": "#0052cc",
                        "on-primary": "#ffffff",
                    },
                    fontFamily: {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .sidebar-active { background-color: #ededf8; color: #003d9b; font-weight: 600; }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-72 bg-surface-container h-screen sticky top-0 flex flex-col p-6 space-y-8">
        <div class="flex items-center gap-3 px-2">
            <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">cloud_done</span>
            <span class="text-2xl font-bold tracking-tight text-primary">CloudJourney</span>
        </div>
        <nav class="flex-1 space-y-2">
            <a href="/admin/index" class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:bg-white transition-colors">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-medium">Bảng điều khiển</span>
            </a>
            <a href="/admin/users" class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:bg-white transition-colors">
                <span class="material-symbols-outlined">people</span>
                <span class="font-medium">Quản lý người dùng</span>
            </a>
            <a href="/admin/tours" class="flex items-center gap-4 px-4 py-3 rounded-xl sidebar-active">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">explore</span>
                <span class="font-medium">Quản lý tour</span>
            </a>
            <a href="/admin/bookings" class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:bg-white transition-colors">
                <span class="material-symbols-outlined">receipt_long</span>
                <span class="font-medium">Quản lý đặt tour</span>
            </a>
            <a href="/admin/contact" class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:bg-white transition-colors">
                <span class="material-symbols-outlined">contact_mail</span>
                <span class="font-medium">Liên hệ khách hàng</span>
            </a>
            <a href="/admin/setting" class="flex items-center gap-4 px-4 py-3 rounded-xl text-on-surface-variant hover:bg-white transition-colors">
                <span class="material-symbols-outlined">settings</span>
                <span class="font-medium">Cài đặt chung</span>
            </a>
        </nav>
        <div class="mt-auto p-4 rounded-2xl bg-primary-container text-white">
            <p class="text-xs opacity-80 mb-2">Xin chào,</p>
            <p class="font-bold truncate"><?= isset($_SESSION['fullname']) ? htmlspecialchars($_SESSION['fullname']) : 'Admin' ?></p>
            <a href="/logout" class="mt-4 block text-center w-full py-2 bg-white text-primary rounded-lg text-sm font-bold hover:bg-gray-100 transition">Đăng xuất</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 space-y-8 max-w-[1400px] mx-auto w-full">
        <?php if(isset($contentView)) { include $contentView; } ?>
    </main>
</body>
</html>
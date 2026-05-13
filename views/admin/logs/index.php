<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-on-surface">Nhật ký hệ thống</h1>
            <p class="text-on-surface-variant mt-2">Xem các sự kiện hoạt động gần đây của hệ thống.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-outline bg-surface-container"> 
            <h2 class="text-lg font-semibold text-on-surface">Log hoạt động</h2>
        </div>
        <div class="p-6">
            <?php if (empty($logs)): ?>
                <div class="text-slate-600">Chưa có dữ liệu nhật ký.</div>
            <?php else: ?>
                <pre class="whitespace-pre-wrap font-mono text-sm text-slate-800 bg-slate-50 p-4 rounded-xl overflow-x-auto" style="max-height: 520px;">
<?= htmlspecialchars(implode("\n", $logs)) ?>
                </pre>
            <?php endif; ?>
        </div>
    </div>
</div>

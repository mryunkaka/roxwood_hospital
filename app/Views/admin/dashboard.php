<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card bg-base-100 shadow-sm">
    <div class="card-body">
        <h1 class="card-title">Dashboard</h1>
        <div class="alert">
            <span>Admin layout is ready. Next: build modules and authentication.</span>
        </div>

        <div class="stats stats-vertical sm:stats-horizontal shadow-sm">
            <div class="stat">
                <div class="stat-title">Realtime</div>
                <div class="stat-value text-base">AJAX Polling</div>
            </div>
            <div class="stat">
                <div class="stat-title">UI</div>
                <div class="stat-value text-base">DaisyUI</div>
            </div>
            <div class="stat">
                <div class="stat-title">Interaction</div>
                <div class="stat-value text-base">HTMX</div>
            </div>
        </div>

        <div class="card-actions justify-end">
            <a class="btn btn-primary" href="/admin/recruitment">Recruitment</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card bg-base-100 shadow-sm">
    <div class="card-body space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <div class="text-sm opacity-70">Operational overview and quick access.</div>
            </div>
            <div class="flex items-center gap-2">
                <span class="badge badge-outline">Shared Hosting Ready</span>
                <span class="badge badge-outline">AJAX Polling</span>
            </div>
        </div>

        <div class="stats stats-vertical lg:stats-horizontal shadow-sm bg-base-200">
            <div class="stat">
                <div class="stat-title">Realtime</div>
                <div class="stat-value text-2xl">1–2s</div>
                <div class="stat-desc">Polling interval</div>
            </div>
            <div class="stat">
                <div class="stat-title">UI</div>
                <div class="stat-value text-2xl">DaisyUI</div>
                <div class="stat-desc">Medical Green theme</div>
            </div>
            <div class="stat">
                <div class="stat-title">Interaction</div>
                <div class="stat-value text-2xl">HTMX</div>
                <div class="stat-desc">HTML-first updates</div>
            </div>
        </div>

        <div class="alert alert-info">
            <span>Modules are scaffolded. Next: implement Dashboard cache + realtime endpoints.</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            <div class="card bg-base-200">
                <div class="card-body p-4">
                    <div class="flex items-center justify-between">
                        <div class="font-semibold">Recruitment</div>
                        <span class="badge badge-outline">HR</span>
                    </div>
                    <div class="text-sm opacity-70">Candidate registration, exams, evaluation, interview.</div>
                    <div class="card-actions justify-end">
                        <a class="btn btn-primary btn-sm" href="/admin/recruitment/candidate-registration">Open</a>
                    </div>
                </div>
            </div>
            <div class="card bg-base-200">
                <div class="card-body p-4">
                    <div class="flex items-center justify-between">
                        <div class="font-semibold">Pharmacy</div>
                        <span class="badge badge-outline">Ops</span>
                    </div>
                    <div class="text-sm opacity-70">Regulations and consumer recap.</div>
                    <div class="card-actions justify-end">
                        <a class="btn btn-ghost btn-sm" href="/admin/pharmacy/consumer-recap">View</a>
                    </div>
                </div>
            </div>
            <div class="card bg-base-200">
                <div class="card-body p-4">
                    <div class="flex items-center justify-between">
                        <div class="font-semibold">Analytics</div>
                        <span class="badge badge-outline">Rank</span>
                    </div>
                    <div class="text-sm opacity-70">Duty hours, transactions, website usage.</div>
                    <div class="card-actions justify-end">
                        <a class="btn btn-ghost btn-sm" href="/admin/analytics/duty-hour-ranking">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

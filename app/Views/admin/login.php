<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<?php helper(['form']); ?>

<div class="alert mb-4">
    <span>Sign in using your <strong>Full Name</strong> and <strong>PIN</strong>.</span>
    <span class="badge badge-outline">user_rh</span>
</div>

<?php if (defined('ENVIRONMENT') && ENVIRONMENT !== 'production'): ?>
    <?php
        $db = config('Database')->default ?? [];
        $dbHost = (string) ($db['hostname'] ?? '');
        $dbName = (string) ($db['database'] ?? '');
        $dbUser = (string) ($db['username'] ?? '');
    ?>
    <div class="alert alert-info mb-4">
        <span class="text-sm">
            Dev mode: Verify `.env` → `database.default.*`. Current DB: <?= esc($dbUser) ?>@<?= esc($dbHost) ?>/<?= esc($dbName) ?>.
        </span>
        <a class="btn btn-xs btn-ghost" href="/admin/diagnostics/db">Database check</a>
    </div>
<?php endif; ?>

<form method="post" action="/admin/login" class="space-y-3">
    <?= csrf_field() ?>

    <div class="card bg-base-200">
        <div class="card-body p-4 sm:p-6 space-y-4">
            <div class="space-y-2 w-full">
                <div class="text-sm font-medium">Full Name</div>
                <input
                    name="full_name"
                    type="text"
                    class="input input-bordered w-full"
                    placeholder="e.g. admin"
                    value="<?= esc(old('full_name') ?? '') ?>"
                    autocomplete="username"
                    required
                >
            </div>

            <div class="space-y-2 w-full">
                <div class="text-sm font-medium">PIN</div>
                <input
                    name="pin"
                    type="password"
                    class="input input-bordered w-full"
                    placeholder="••••"
                    autocomplete="current-password"
                    inputmode="numeric"
                    required
                >
                <div class="text-xs opacity-70">If you are inactive, your account cannot sign in.</div>
            </div>

            <div class="pt-1">
                <button class="btn btn-primary w-full" type="submit">Sign In</button>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

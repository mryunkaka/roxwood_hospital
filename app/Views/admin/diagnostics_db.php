<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="alert alert-info">
        <span>This page is available in development mode only.</span>
    </div>

    <div class="card bg-base-200">
        <div class="card-body p-4 sm:p-6">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <div class="text-lg font-semibold">Connection</div>
                    <div class="text-sm opacity-70">Current configured database target (password hidden).</div>
                </div>
                <?php if (($result['connected'] ?? false) === true): ?>
                    <span class="badge badge-success">Connected</span>
                <?php else: ?>
                    <span class="badge badge-error">Not Connected</span>
                <?php endif; ?>
            </div>

            <div class="overflow-x-auto mt-3">
                <table class="table table-zebra">
                    <tbody>
                    <?php foreach (($dbConfig ?? []) as $k => $v): ?>
                        <tr>
                            <td class="font-medium"><?= esc((string) $k) ?></td>
                            <td class="font-mono text-xs break-all"><?= esc(is_scalar($v) ? (string) $v : json_encode($v)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if (! empty($result['error'])): ?>
                <div class="alert alert-error mt-4">
                    <span class="font-mono text-xs break-all"><?= esc((string) $result['error']) ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="card bg-base-200">
        <div class="card-body p-4 sm:p-6 space-y-3">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <div class="text-lg font-semibold">Schema sanity</div>
                    <div class="text-sm opacity-70">Checks the `user_rh` table required for sign-in.</div>
                </div>
                <?php if (($result['user_rh']['exists'] ?? false) === true): ?>
                    <span class="badge badge-success">user_rh found</span>
                <?php else: ?>
                    <span class="badge badge-error">user_rh missing</span>
                <?php endif; ?>
            </div>

            <?php if (($result['user_rh']['exists'] ?? false) === true): ?>
                <div class="stats stats-vertical sm:stats-horizontal bg-base-100">
                    <div class="stat">
                        <div class="stat-title">Rows</div>
                        <div class="stat-value text-2xl"><?= esc((string) ($result['user_rh']['count'] ?? '—')) ?></div>
                    </div>
                    <div class="stat">
                        <div class="stat-title">Required columns</div>
                        <?php if (($result['user_rh']['columns_ok'] ?? false) === true): ?>
                            <div class="stat-value text-2xl">OK</div>
                            <div class="stat-desc">full_name, pin, is_active</div>
                        <?php else: ?>
                            <div class="stat-value text-2xl">Missing</div>
                            <div class="stat-desc"><?= esc(implode(', ', (array) ($result['user_rh']['missing_columns'] ?? []))) ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Updated</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ((array) ($result['user_rh']['sample'] ?? []) as $row): ?>
                            <tr>
                                <td><?= esc((string) ($row['id'] ?? '')) ?></td>
                                <td><?= esc((string) ($row['full_name'] ?? '')) ?></td>
                                <td><span class="badge badge-outline"><?= esc((string) ($row['role'] ?? '')) ?></span></td>
                                <td>
                                    <?php $active = (int) ($row['is_active'] ?? 0) === 1; ?>
                                    <span class="badge <?= $active ? 'badge-success' : 'badge-ghost' ?>">
                                        <?= $active ? 'Active' : 'Inactive' ?>
                                    </span>
                                </td>
                                <td class="text-xs opacity-70"><?= esc((string) ($row['updated_at'] ?? '')) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <span>Import your SQL and make sure the database selected in `.env` contains the `user_rh` table.</span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="flex items-center justify-end gap-2">
        <a class="btn btn-ghost" href="/admin/login">Back to Sign In</a>
        <a class="btn btn-primary" href="/admin/diagnostics/db">Refresh</a>
    </div>
</div>
<?= $this->endSection() ?>


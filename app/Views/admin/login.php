<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<?php helper(['form']); ?>

<div class="alert mb-4">
    <span>Use your admin credentials to sign in.</span>
</div>

<form method="post" action="/admin/login" class="space-y-3">
    <?= csrf_field() ?>

    <div class="card bg-base-200">
        <div class="card-body p-4 space-y-3">
            <label class="form-control w-full">
                <div class="label"><span class="label-text">Email</span></div>
                <input name="email" type="email" class="input input-bordered w-full" placeholder="admin@example.com"
                       value="<?= esc(old('email') ?? '') ?>" required>
            </label>

            <label class="form-control w-full">
                <div class="label"><span class="label-text">Password</span></div>
                <input name="password" type="password" class="input input-bordered w-full" placeholder="••••••••" required>
            </label>

            <button class="btn btn-primary w-full" type="submit">Sign In</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

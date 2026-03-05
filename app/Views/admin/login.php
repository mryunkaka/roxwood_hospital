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
                <div class="label"><span class="label-text">Full Name</span></div>
                <input name="full_name" type="text" class="input input-bordered w-full" placeholder="Your full name"
                       value="<?= esc(old('full_name') ?? '') ?>" required>
            </label>

            <label class="form-control w-full">
                <div class="label"><span class="label-text">PIN</span></div>
                <input name="pin" type="password" class="input input-bordered w-full" placeholder="••••" required>
            </label>

            <button class="btn btn-primary w-full" type="submit">Sign In</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

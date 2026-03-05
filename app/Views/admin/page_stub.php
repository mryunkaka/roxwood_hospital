<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card bg-base-100">
    <div class="card-body">
        <h2 class="card-title"><?= esc($title ?? 'Page') ?></h2>
        <div class="alert alert-info">
            <span>This page is a stub. The module will be implemented in the next phases.</span>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?php
$success = session()->getFlashdata('success');
$error = session()->getFlashdata('error');
$warning = session()->getFlashdata('warning');
?>

<?php if ($success): ?>
    <div class="alert alert-success mb-4">
        <span><?= esc($success) ?></span>
    </div>
<?php endif; ?>

<?php if ($warning): ?>
    <div class="alert alert-warning mb-4">
        <span><?= esc($warning) ?></span>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-error mb-4">
        <span><?= esc($error) ?></span>
    </div>
<?php endif; ?>


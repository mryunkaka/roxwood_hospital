<?php
$success = session()->getFlashdata('success');
$error = session()->getFlashdata('error');
$warning = session()->getFlashdata('warning');
$info = session()->getFlashdata('info');
?>

<?php
    $payload = [
        'success' => is_string($success) ? $success : null,
        'warning' => is_string($warning) ? $warning : null,
        'error'   => is_string($error) ? $error : null,
        'info'    => is_string($info) ? $info : null,
    ];
?>
<script id="roxwood-flash" type="application/json"><?= json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>

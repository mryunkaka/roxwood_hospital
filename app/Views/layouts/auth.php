<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Sign In') ?> — ROXWOOD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <?php $assetVersion = $assetVersion ?? '1'; ?>
    <link rel="stylesheet" href="/assets/app.css?v=<?= esc($assetVersion) ?>">
    <script defer src="/assets/vendor/htmx.min.js?v=<?= esc($assetVersion) ?>"></script>
    <script defer src="/assets/vendor/alpine.min.js?v=<?= esc($assetVersion) ?>"></script>
    <script defer src="/assets/app.js?v=<?= esc($assetVersion) ?>"></script>
</head>
<body class="min-h-screen bg-base-200">

<main class="min-h-screen flex items-center justify-center p-4">
    <div class="card w-full max-w-md bg-base-100 shadow-sm">
        <div class="card-body">
            <div class="flex items-center justify-between">
                <h1 class="card-title">ROXWOOD</h1>
                <span class="badge badge-outline">Admin</span>
            </div>
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</main>

</body>
</html>


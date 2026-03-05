<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Sign In') ?> — ROXWOOD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <?php $assetVersion = $assetVersion ?? '1'; ?>
    <script>
        (function () {
            try {
                var t = localStorage.getItem('roxwood.ui.theme');
                if (!t) {
                    t = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
                } else {
                    t = JSON.parse(t);
                }
                document.documentElement.setAttribute('data-theme', t);
            } catch (e) {}
        })();
    </script>
    <link rel="stylesheet" href="/assets/app.css?v=<?= esc($assetVersion) ?>">
    <script defer src="/assets/vendor/htmx.min.js?v=<?= esc($assetVersion) ?>"></script>
    <script defer src="/assets/vendor/alpine.min.js?v=<?= esc($assetVersion) ?>"></script>
    <script defer src="/assets/app.js?v=<?= esc($assetVersion) ?>"></script>
</head>
<body class="min-h-screen bg-base-200">

<main class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-b from-base-200 to-base-300">
    <div class="card w-full max-w-sm sm:max-w-md bg-base-100 shadow-sm">
        <div class="card-body">
            <div class="flex items-center justify-between">
                <h1 class="card-title">ROXWOOD</h1>
                <span class="badge badge-outline">Admin</span>
            </div>
            <?= $this->include('partials/flash_messages') ?>
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</main>

</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ROXWOOD HOSPITAL SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <?php $assetVersion = '1'; ?>
    <link rel="stylesheet" href="/assets/app.css?v=<?= esc($assetVersion) ?>">

    <script defer src="/assets/vendor/htmx.min.js?v=<?= esc($assetVersion) ?>"></script>
    <script defer src="/assets/vendor/alpine.min.js?v=<?= esc($assetVersion) ?>"></script>
    <script defer src="/assets/app.js?v=<?= esc($assetVersion) ?>"></script>
</head>
<body class="min-h-screen bg-base-200">
<div class="navbar bg-base-100 shadow-sm">
    <div class="flex-1">
        <a class="btn btn-ghost text-lg">ROXWOOD</a>
        <span class="badge badge-outline">CI4</span>
    </div>
    <div class="flex-none">
        <a class="btn btn-sm" href="#" hx-get="#" hx-trigger="click">Admin</a>
        <a class="btn btn-sm btn-outline" href="#" hx-get="#" hx-trigger="click">Recruitment</a>
    </div>
</div>

<main class="p-4">
    <div class="card bg-base-100 shadow-sm">
        <div class="card-body">
            <h1 class="card-title">ROXWOOD HOSPITAL SYSTEM</h1>
            <div class="alert">
                <span>Asset pipeline is installed: Tailwind + DaisyUI + AlpineJS + HTMX.</span>
            </div>
            <div class="stats stats-vertical sm:stats-horizontal shadow-sm">
                <div class="stat">
                    <div class="stat-title">UI</div>
                    <div class="stat-value text-base">DaisyUI</div>
                </div>
                <div class="stat">
                    <div class="stat-title">Reactive</div>
                    <div class="stat-value text-base">AlpineJS</div>
                </div>
                <div class="stat">
                    <div class="stat-title">HTML Interaction</div>
                    <div class="stat-value text-base">HTMX</div>
                </div>
            </div>
            <div class="card-actions justify-end">
                <button class="btn btn-primary" type="button">Continue</button>
            </div>
        </div>
    </div>
</main>
</body>
</html>


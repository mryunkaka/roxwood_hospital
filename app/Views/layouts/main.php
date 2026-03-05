<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'ROXWOOD HOSPITAL SYSTEM') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <style>[x-cloak]{display:none!important}</style>

    <?php $assetVersion = $assetVersion ?? '1'; ?>
    <script>
        (function () {
            try {
                var t = localStorage.getItem('roxwood.ui.theme');
                if (!t) {
                    t = 'emerald';
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

<?= $this->include('partials/notification_system') ?>

<div class="drawer" x-data="roxwoodLayout()" x-init="init()">
    <input id="roxwood-admin-drawer" type="checkbox" class="drawer-toggle"
           :checked="drawerOpen"
           @change="setDrawer($event.target.checked)">

    <div class="drawer-content flex flex-col">
        <div class="sticky top-0 z-40">
            <?= $this->include('partials/navbar') ?>
        </div>

        <div class="px-4 pt-4 w-full max-w-screen-2xl mx-auto">
            <?= $this->include('partials/breadcrumbs') ?>
            <?= $this->include('partials/flash_messages') ?>
        </div>

        <main class="flex-1 w-full max-w-screen-2xl mx-auto p-4">
            <div class="space-y-4">
                <?= $this->renderSection('content') ?>
            </div>
        </main>

        <?= $this->include('partials/footer') ?>
    </div>

    <div class="drawer-side">
        <label for="roxwood-admin-drawer" class="drawer-overlay"></label>
        <?= $this->include('partials/sidebar') ?>
    </div>
</div>

<?= $this->include('partials/modal_dialogs') ?>

<script>
    function roxwoodLayout() {
        return {
            drawerOpen: true,
            init() {
                const cached = window.ROXWOOD?.storage?.get('roxwood.ui.drawerOpen', null);
                if (cached === null) {
                    this.drawerOpen = window.matchMedia('(min-width: 1024px)').matches;
                    return;
                }
                this.drawerOpen = !!cached;
            },
            setDrawer(value) {
                this.drawerOpen = !!value;
                window.ROXWOOD?.storage?.set('roxwood.ui.drawerOpen', this.drawerOpen);
            }
        }
    }
</script>

</body>
</html>

<?php
/** @var array<int, array{label:string, href?:string}> $breadcrumbs */
$breadcrumbs = $breadcrumbs ?? [];
?>
<?php if (! empty($breadcrumbs)): ?>
    <div class="card bg-base-100 shadow-sm mb-4">
        <div class="card-body py-3 px-4">
            <div class="flex flex-wrap items-center gap-2">
                <?php foreach ($breadcrumbs as $i => $item): ?>
                    <?php if ($i > 0): ?>
                        <span class="badge badge-outline">/</span>
                    <?php endif; ?>
                    <?php if (! empty($item['href'])): ?>
                        <a class="badge badge-outline" href="<?= esc($item['href']) ?>"><?= esc($item['label']) ?></a>
                    <?php else: ?>
                        <span class="badge"><?= esc($item['label']) ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>


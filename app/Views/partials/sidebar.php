<?php
/** @var \CodeIgniter\HTTP\URI $uri */
$uri = service('uri');
$path = '/' . trim((string) $uri->getPath(), '/');
$path = $path === '/' ? '/admin' : $path;

$isActive = static function (string $href) use ($path): bool {
    if ($href === '/admin') {
        return $path === '/admin' || $path === '/admin/';
    }
    return $path === $href || str_starts_with($path, rtrim($href, '/') . '/');
};

$menuItem = static function (string $label, string $href, string $iconSvg, ?string $badge = null) use ($isActive): string {
    $activeClass = $isActive($href) ? 'active' : '';
    $badgeHtml = $badge ? '<span class="badge badge-outline ml-auto">' . esc($badge) . '</span>' : '';

    return '<li>'
        . '<a class="' . $activeClass . '" href="' . esc($href) . '">'
        . '<span class="w-5 h-5 inline-flex items-center justify-center opacity-80">' . $iconSvg . '</span>'
        . '<span class="truncate">' . esc($label) . '</span>'
        . $badgeHtml
        . '</a>'
        . '</li>';
};

$icon = static function (string $name): string {
    return match ($name) {
        'dashboard' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 13h8V3H3v10Zm0 8h8v-6H3v6Zm10 0h8V11h-8v10Zm0-18v6h8V3h-8Z"/></svg>',
        'calendar' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M7 2a1 1 0 0 1 1 1v1h8V3a1 1 0 1 1 2 0v1h1a3 3 0 0 1 3 3v13a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h1V3a1 1 0 0 1 1-1Zm13 8H4v10a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V10Z"/></svg>',
        'document' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M6 2h7l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Zm7 1.5V8h4.5L13 3.5Z"/></svg>',
        'pharmacy' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M7 2h10a2 2 0 0 1 2 2v2a4 4 0 0 1-4 4h-1v2.5l3.7 3.7a4 4 0 1 1-5.7 5.7l-3.7-3.7H7a4 4 0 0 1-4-4V4a2 2 0 0 1 2-2Zm10 2H7v12a2 2 0 0 0 2 2h1.6l5.2 5.2a2 2 0 1 0 2.8-2.8L13 14.6V10h2a2 2 0 0 0 2-2V4Z"/></svg>',
        'wallet' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 6a3 3 0 0 1 3-3h12a2 2 0 0 1 2 2v1h-2V5H6a1 1 0 0 0 0 2h14a2 2 0 0 1 2 2v9a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm16 6a1 1 0 1 0 0 2h2v-2h-2Z"/></svg>',
        'medical' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M10 3a2 2 0 0 1 4 0v2h2a2 2 0 0 1 0 4h-2v2h2a2 2 0 0 1 0 4h-2v2a2 2 0 0 1-4 0v-2H8a2 2 0 0 1 0-4h2v-2H8a2 2 0 0 1 0-4h2V3Z"/></svg>',
        'chart' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M4 19a1 1 0 0 0 1 1h14a1 1 0 1 0 0-2H6V5a1 1 0 1 0-2 0v14Zm5-2a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v7a1 1 0 0 0 1 1Zm5 0a1 1 0 0 0 1-1V6a1 1 0 1 0-2 0v10a1 1 0 0 0 1 1Zm5 0a1 1 0 0 0 1-1v-4a1 1 0 1 0-2 0v4a1 1 0 0 0 1 1Z"/></svg>',
        'users' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M16 11a4 4 0 1 0-8 0 4 4 0 0 0 8 0Zm-4 6c-4.4 0-8 2-8 4.5A2.5 2.5 0 0 0 6.5 24h11A2.5 2.5 0 0 0 20 21.5C20 19 16.4 17 12 17Z"/></svg>',
        'briefcase' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M9 2a2 2 0 0 0-2 2v2H5a3 3 0 0 0-3 3v3h20V9a3 3 0 0 0-3-3h-2V4a2 2 0 0 0-2-2H9Zm6 4H9V4h6v2Zm7 8H2v5a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-5Z"/></svg>',
        default => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Z"/></svg>',
    };
};
?>

<aside class="h-full w-80 bg-base-100 border-r border-base-200">
    <div class="h-full overflow-y-auto p-3 space-y-3">
        <div class="flex items-center justify-between px-2">
            <div class="text-sm font-semibold">Admin</div>
            <div class="flex items-center gap-2">
                <span class="badge badge-outline">v1</span>
                <button type="button" class="btn btn-ghost btn-xs lg:hidden" aria-label="Close sidebar"
                        onclick="window.ROXWOOD && window.ROXWOOD.drawer && window.ROXWOOD.drawer.set(false)">
                    Close
                </button>
            </div>
        </div>

        <div class="card bg-base-200">
            <div class="card-body p-3">
                <div class="text-sm font-semibold">ROXWOOD HOSPITAL SYSTEM</div>
                <div class="text-xs opacity-70">Medical SaaS Admin Dashboard</div>
            </div>
        </div>

        <ul class="menu menu-md bg-base-100 rounded-box">
            <li class="menu-title"><span>Dashboard</span></li>
            <?= $menuItem('Dashboard', '/admin', $icon('dashboard')) ?>

            <li class="menu-title"><span>Events</span></li>
            <?= $menuItem('Event Management', '/admin/event/management', $icon('calendar')) ?>

            <li class="menu-title"><span>Medical Services</span></li>
            <?= $menuItem('Medical Regulations', '/admin/medical-services/regulations', $icon('document')) ?>

            <li class="menu-title"><span>Pharmacy</span></li>
            <?= $menuItem('Pharmacy Recap', '/admin/pharmacy/recap', $icon('pharmacy')) ?>
            <?= $menuItem('Pharmacy Regulations', '/admin/pharmacy/regulations', $icon('document')) ?>
            <?= $menuItem('Consumer Pharmacy Recap', '/admin/pharmacy/consumer-recap', $icon('pharmacy')) ?>

            <li class="menu-title"><span>Finance</span></li>
            <?= $menuItem('Reimbursement', '/admin/finance/reimbursement', $icon('wallet')) ?>
            <?= $menuItem('Restaurant Consumption', '/admin/finance/restaurant-consumption', $icon('wallet')) ?>
            <?= $menuItem('Pharmacy Salary Recap', '/admin/finance/pharmacy-salary-recap', $icon('wallet')) ?>

            <li class="menu-title"><span>Medical Operations</span></li>
            <?= $menuItem('Plastic Surgery', '/admin/medical-operations/plastic-surgery', $icon('medical'), 'Medics Only') ?>

            <li class="menu-title"><span>Analytics</span></li>
            <?= $menuItem('Duty Hour Ranking', '/admin/analytics/duty-hour-ranking', $icon('chart')) ?>
            <?= $menuItem('Transaction Ranking', '/admin/analytics/transaction-ranking', $icon('chart')) ?>
            <?= $menuItem('Website Usage', '/admin/analytics/website-usage-hours', $icon('chart')) ?>

            <li class="menu-title"><span>Recruitment</span></li>
            <?= $menuItem('Candidate Registration', '/admin/recruitment/candidate-registration', $icon('briefcase')) ?>
            <?= $menuItem('Candidate Exam', '/admin/recruitment/candidate-exam', $icon('briefcase')) ?>
            <?= $menuItem('Interview Stage', '/admin/recruitment/interview-stage', $icon('briefcase')) ?>
            <?= $menuItem('Final Decision', '/admin/recruitment/final-decision', $icon('briefcase')) ?>

            <li class="menu-title"><span>User Management</span></li>
            <?= $menuItem('User Validation', '/admin/user-management/validation', $icon('users')) ?>
            <?= $menuItem('User Management', '/admin/user-management/users', $icon('users')) ?>
            <?= $menuItem('Account Settings', '/admin/account', $icon('users')) ?>
        </ul>
    </div>
</aside>

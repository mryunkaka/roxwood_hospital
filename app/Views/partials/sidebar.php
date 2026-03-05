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

$navBtn = static function (string $label, string $href, ?string $badge = null) use ($isActive): string {
    $activeClass = $isActive($href) ? 'btn-active' : '';
    $badgeHtml = $badge ? '<span class="badge badge-outline ml-auto">' . esc($badge) . '</span>' : '';

    return '<a class="btn btn-ghost justify-start w-full ' . $activeClass . '" href="' . esc($href) . '">'
        . '<span class="truncate">' . esc($label) . '</span>'
        . $badgeHtml
        . '</a>';
};
?>

<aside class="h-full w-80 bg-base-100 border-r border-base-200">
    <div class="h-full overflow-y-auto p-3 space-y-3">
        <div class="card bg-base-100">
            <div class="card-body p-3">
                <div class="flex items-center justify-between gap-2">
                    <div class="font-semibold">Admin Panel</div>
                    <div class="flex items-center gap-2">
                        <span class="badge badge-outline">v1</span>
                        <button type="button" class="btn btn-ghost btn-xs lg:hidden" aria-label="Close sidebar"
                                onclick="window.ROXWOOD && window.ROXWOOD.drawer && window.ROXWOOD.drawer.set(false)">
                            Close
                        </button>
                    </div>
                </div>
                <div class="text-xs opacity-70">ROXWOOD HOSPITAL SYSTEM</div>
            </div>
        </div>

        <div class="space-y-2" x-data="roxwoodSidebar()" x-init="init()">
            <div class="card bg-base-200">
                <div class="card-body p-2">
                    <?= $navBtn('Dashboard', '/admin', 'Home') ?>
                </div>
            </div>

            <div class="card bg-base-200">
                <div class="card-body p-2 space-y-1">
                    <button class="btn btn-ghost justify-start w-full" type="button"
                            @click="toggle('event')">
                        <span>Event</span>
                        <span class="badge badge-outline ml-auto" x-text="open.event ? 'Open' : 'Closed'"></span>
                    </button>
                    <div class="pl-2 space-y-1" x-show="open.event" x-cloak>
                        <?= $navBtn('Event Management', '/admin/event/management') ?>
                    </div>
                </div>
            </div>

            <div class="card bg-base-200">
                <div class="card-body p-2 space-y-1">
                    <button class="btn btn-ghost justify-start w-full" type="button"
                            @click="toggle('medical_services')">
                        <span>Medical Services</span>
                        <span class="badge badge-outline ml-auto" x-text="open.medical_services ? 'Open' : 'Closed'"></span>
                    </button>
                    <div class="pl-2 space-y-1" x-show="open.medical_services" x-cloak>
                        <?= $navBtn('Medical Service Regulations', '/admin/medical-services/regulations') ?>
                    </div>
                </div>
            </div>

            <div class="card bg-base-200">
                <div class="card-body p-2 space-y-1">
                    <button class="btn btn-ghost justify-start w-full" type="button"
                            @click="toggle('pharmacy')">
                        <span>Pharmacy Recap</span>
                        <span class="badge badge-outline ml-auto" x-text="open.pharmacy ? 'Open' : 'Closed'"></span>
                    </button>
                    <div class="pl-2 space-y-1" x-show="open.pharmacy" x-cloak>
                        <?= $navBtn('Pharmacy Regulations', '/admin/pharmacy/regulations') ?>
                        <?= $navBtn('Pharmacy Consumer Recap', '/admin/pharmacy/consumer-recap') ?>
                    </div>
                </div>
            </div>

            <div class="card bg-base-200">
                <div class="card-body p-2 space-y-1">
                    <button class="btn btn-ghost justify-start w-full" type="button"
                            @click="toggle('finance')">
                        <span>Finance</span>
                        <span class="badge badge-outline ml-auto" x-text="open.finance ? 'Open' : 'Closed'"></span>
                    </button>
                    <div class="pl-2 space-y-1" x-show="open.finance" x-cloak>
                        <?= $navBtn('Reimbursement', '/admin/finance/reimbursement') ?>
                        <?= $navBtn('Restaurant Consumption', '/admin/finance/restaurant-consumption') ?>
                        <?= $navBtn('Pharmacy Salary Recap', '/admin/finance/pharmacy-salary-recap') ?>
                    </div>
                </div>
            </div>

            <div class="card bg-base-200">
                <div class="card-body p-2 space-y-1">
                    <button class="btn btn-ghost justify-start w-full" type="button"
                            @click="toggle('medical_ops')">
                        <span>Medical Operations</span>
                        <span class="badge badge-outline ml-auto" x-text="open.medical_ops ? 'Open' : 'Closed'"></span>
                    </button>
                    <div class="pl-2 space-y-1" x-show="open.medical_ops" x-cloak>
                        <?= $navBtn('Plastic Surgery', '/admin/medical-operations/plastic-surgery', 'Medics Only') ?>
                    </div>
                </div>
            </div>

            <div class="card bg-base-200">
                <div class="card-body p-2 space-y-1">
                    <button class="btn btn-ghost justify-start w-full" type="button"
                            @click="toggle('analytics')">
                        <span>Analytics</span>
                        <span class="badge badge-outline ml-auto" x-text="open.analytics ? 'Open' : 'Closed'"></span>
                    </button>
                    <div class="pl-2 space-y-1" x-show="open.analytics" x-cloak>
                        <?= $navBtn('Duty Hour Ranking', '/admin/analytics/duty-hour-ranking') ?>
                        <?= $navBtn('Transaction Ranking', '/admin/analytics/transaction-ranking') ?>
                        <?= $navBtn('Website Usage Hours', '/admin/analytics/website-usage-hours') ?>
                    </div>
                </div>
            </div>

            <div class="card bg-base-200">
                <div class="card-body p-2 space-y-1">
                    <button class="btn btn-ghost justify-start w-full" type="button"
                            @click="toggle('users')">
                        <span>User Management</span>
                        <span class="badge badge-outline ml-auto" x-text="open.users ? 'Open' : 'Closed'"></span>
                    </button>
                    <div class="pl-2 space-y-1" x-show="open.users" x-cloak>
                        <?= $navBtn('User Validation', '/admin/user-management/validation') ?>
                        <?= $navBtn('User Management', '/admin/user-management/users') ?>
                        <?= $navBtn('Account Settings', '/admin/account') ?>
                    </div>
                </div>
            </div>

            <div class="card bg-base-200">
                <div class="card-body p-2 space-y-1">
                    <button class="btn btn-ghost justify-start w-full" type="button"
                            @click="toggle('recruitment')">
                        <span>Recruitment</span>
                        <span class="badge badge-outline ml-auto" x-text="open.recruitment ? 'Open' : 'Closed'"></span>
                    </button>
                    <div class="pl-2 space-y-1" x-show="open.recruitment" x-cloak>
                        <?= $navBtn('Medical Register', '/admin/recruitment/medical-register') ?>
                        <?= $navBtn('Medical Login', '/admin/recruitment/medical-login') ?>
                        <?= $navBtn('Candidate Registration', '/admin/recruitment/candidate-registration') ?>
                        <?= $navBtn('Candidate Exam', '/admin/recruitment/candidate-exam') ?>
                        <?= $navBtn('Candidate Evaluation', '/admin/recruitment/candidate-evaluation') ?>
                        <?= $navBtn('Interview Stage', '/admin/recruitment/interview-stage') ?>
                        <?= $navBtn('Final Decision', '/admin/recruitment/final-decision') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

<script>
    function roxwoodSidebar() {
        const key = 'roxwood.ui.sidebar.open';
        const defaults = {
            event: true,
            medical_services: true,
            pharmacy: true,
            finance: true,
            medical_ops: true,
            analytics: true,
            users: true,
            recruitment: true,
        };

        return {
            open: { ...defaults },
            init() {
                const cached = window.ROXWOOD?.storage?.get(key, null);
                if (cached && typeof cached === 'object') {
                    this.open = { ...defaults, ...cached };
                }
            },
            toggle(section) {
                if (!Object.prototype.hasOwnProperty.call(this.open, section)) return;
                this.open[section] = !this.open[section];
                window.ROXWOOD?.storage?.set(key, this.open);
            }
        };
    }
</script>

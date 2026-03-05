<?php
    $auth = session()->get('roxwood.auth');
    $fullName = is_array($auth) ? (string) ($auth['full_name'] ?? '') : '';
    $role = is_array($auth) ? (string) ($auth['role'] ?? '') : '';
?>

<div class="navbar bg-base-100/90 backdrop-blur border-b border-base-200">
    <div class="flex-none">
        <label for="roxwood-admin-drawer" class="btn btn-ghost btn-square lg:hidden" aria-label="Open menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </label>
        <button type="button" class="btn btn-ghost btn-square hidden lg:inline-flex" aria-label="Toggle sidebar"
                onclick="window.ROXWOOD && window.ROXWOOD.drawer && window.ROXWOOD.drawer.toggle()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <div class="flex-1 min-w-0">
        <a class="btn btn-ghost text-base sm:text-lg gap-2" href="/admin" aria-label="ROXWOOD Dashboard">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary/10 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11 2a1 1 0 0 1 1 1v1.07A7.002 7.002 0 0 1 19.93 12H21a1 1 0 1 1 0 2h-1.07A7.002 7.002 0 0 1 12 19.93V21a1 1 0 1 1-2 0v-1.07A7.002 7.002 0 0 1 4.07 14H3a1 1 0 1 1 0-2h1.07A7.002 7.002 0 0 1 10 4.07V3a1 1 0 0 1 1-1Zm1 4a5 5 0 1 0 0 10 5 5 0 0 0 0-10Z"/>
                </svg>
            </span>
            <span class="font-semibold truncate">ROXWOOD</span>
            <span class="badge badge-outline hidden sm:inline-flex">Hospital System</span>
        </a>
    </div>

    <div class="flex-none gap-2">
        <?php if ($fullName !== ''): ?>
            <div class="hidden md:flex items-center gap-2">
                <span class="badge badge-outline truncate max-w-44"><?= esc($fullName) ?></span>
                <?php if ($role !== ''): ?>
                    <span class="badge badge-ghost"><?= esc($role) ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm">Theme</div>
            <ul tabindex="0" class="dropdown-content z-[1] card card-compact bg-base-100 shadow-sm p-2 w-44">
                <li>
                    <button class="btn btn-ghost btn-sm justify-start w-full" type="button"
                            onclick="window.ROXWOOD && window.ROXWOOD.theme && window.ROXWOOD.theme.set('emerald')">
                        Medical Green
                    </button>
                </li>
                <li>
                    <button class="btn btn-ghost btn-sm justify-start w-full" type="button"
                            onclick="window.ROXWOOD && window.ROXWOOD.theme && window.ROXWOOD.theme.set('light')">
                        Light
                    </button>
                </li>
            </ul>
        </div>

        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm">Account</div>
            <ul tabindex="0" class="dropdown-content z-[1] card card-compact bg-base-100 shadow-sm p-2 w-56">
                <li class="md:hidden">
                    <div class="px-3 py-2">
                        <div class="text-sm font-semibold truncate"><?= esc($fullName ?: 'Signed in') ?></div>
                        <div class="text-xs opacity-70 truncate"><?= esc($role) ?></div>
                    </div>
                </li>
                <li><a class="btn btn-ghost btn-sm justify-start w-full" href="/admin/account">Account Settings</a></li>
                <li><a class="btn btn-ghost btn-sm justify-start w-full" href="/admin/logout">Sign Out</a></li>
            </ul>
        </div>
    </div>
</div>

<?php
    $auth = session()->get('roxwood.auth');
    $fullName = is_array($auth) ? (string) ($auth['full_name'] ?? '') : '';
    $role = is_array($auth) ? (string) ($auth['role'] ?? '') : '';

    $initials = '';
    if ($fullName !== '') {
        $parts = preg_split('/\s+/u', trim($fullName)) ?: [];
        $initials = strtoupper(mb_substr((string) ($parts[0] ?? ''), 0, 1, 'UTF-8'));
        if (count($parts) > 1) {
            $initials .= strtoupper(mb_substr((string) ($parts[count($parts) - 1] ?? ''), 0, 1, 'UTF-8'));
        }
        $initials = mb_substr($initials, 0, 2, 'UTF-8');
    }
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
        <a class="btn btn-ghost text-base sm:text-lg gap-3 px-2" href="/admin" aria-label="ROXWOOD Dashboard">
            <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-primary text-primary-content">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2a1 1 0 0 1 1 1v2.06A7 7 0 0 1 18.94 11H21a1 1 0 1 1 0 2h-2.06A7 7 0 0 1 13 18.94V21a1 1 0 1 1-2 0v-2.06A7 7 0 0 1 5.06 13H3a1 1 0 1 1 0-2h2.06A7 7 0 0 1 11 5.06V3a1 1 0 0 1 1-1Zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10Z"/>
                </svg>
            </span>
            <span class="min-w-0">
                <span class="font-semibold truncate block leading-tight">ROXWOOD</span>
                <span class="text-xs opacity-70 hidden sm:block leading-tight">Hospital System</span>
            </span>
        </a>
    </div>

    <div class="flex-none gap-2">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm">Theme</div>
            <ul tabindex="0" class="dropdown-content z-[1] card card-compact bg-base-100 shadow-sm p-2 w-44">
                <li>
                    <button class="btn btn-ghost btn-sm justify-start w-full" type="button"
                            onclick="window.ROXWOOD && window.ROXWOOD.theme && window.ROXWOOD.theme.set('roxwood')">
                        ROXWOOD (Medical)
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
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm gap-2">
                <span class="badge badge-primary badge-outline"><?= esc($initials ?: 'U') ?></span>
                <span class="hidden sm:inline">Account</span>
            </div>
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

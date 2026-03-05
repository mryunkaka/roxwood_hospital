<div class="navbar bg-base-100 shadow-sm">
    <div class="flex-none lg:hidden">
        <label for="roxwood-admin-drawer" class="btn btn-ghost btn-square" aria-label="Open menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </label>
    </div>
    <div class="flex-1">
        <a class="btn btn-ghost text-lg" href="/admin">ROXWOOD</a>
        <span class="badge badge-outline">Hospital System</span>
    </div>
    <div class="flex-none gap-2">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm">Theme</div>
            <ul tabindex="0" class="dropdown-content z-[1] card card-compact bg-base-100 shadow-sm p-2 w-40">
                <li>
                    <button class="btn btn-ghost btn-sm justify-start w-full" type="button"
                            onclick="window.ROXWOOD && window.ROXWOOD.theme && window.ROXWOOD.theme.set('light')">
                        Light
                    </button>
                </li>
                <li>
                    <button class="btn btn-ghost btn-sm justify-start w-full" type="button"
                            onclick="window.ROXWOOD && window.ROXWOOD.theme && window.ROXWOOD.theme.set('dark')">
                        Dark
                    </button>
                </li>
            </ul>
        </div>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm">Account</div>
            <ul tabindex="0" class="dropdown-content z-[1] card card-compact bg-base-100 shadow-sm p-2 w-56">
                <li><a class="btn btn-ghost btn-sm justify-start w-full" href="/admin/account">Account Settings</a></li>
                <li><a class="btn btn-ghost btn-sm justify-start w-full" href="/admin/logout">Sign Out</a></li>
            </ul>
        </div>
    </div>
</div>

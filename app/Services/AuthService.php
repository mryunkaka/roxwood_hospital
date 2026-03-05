<?php

namespace App\Services;

use App\Models\UserRhModel;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Session\Session;
use CodeIgniter\Throttle\ThrottlerInterface;
use Throwable;

class AuthService
{
    private const SESSION_KEY = 'roxwood.auth';

    public function __construct(
        private readonly Session $session,
        private readonly IncomingRequest $request,
        private readonly ThrottlerInterface $throttler,
    ) {
    }

    public function isLoggedIn(): bool
    {
        $auth = $this->session->get(self::SESSION_KEY);
        return is_array($auth) && ($auth['logged_in'] ?? false) === true;
    }

    /**
     * @return list<string>
     */
    public function roles(): array
    {
        $auth = $this->session->get(self::SESSION_KEY);
        if (! is_array($auth)) {
            return [];
        }

        $roles = $auth['roles'] ?? [];
        if (! is_array($roles)) {
            return [];
        }

        return array_values(array_filter(array_map('strval', $roles)));
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->roles(), true);
    }

    public function loginUserRh(string $fullName, string $pin): bool
    {
        $ip = (string) $this->request->getIPAddress();
        $key = 'roxwood-admin-login-' . $ip;

        // Basic brute-force protection (shared hosting friendly)
        if (! $this->throttler->check($key, 10, MINUTE)) {
            return false;
        }

        try {
            $user = (new UserRhModel())
                ->where('full_name', $fullName)
                ->first();
        } catch (Throwable) {
            // DB not configured / unavailable
            return false;
        }

        if (! is_array($user) || empty($user['pin'])) {
            return false;
        }

        if (($user['is_active'] ?? 0) != 1) {
            return false;
        }

        if (! password_verify($pin, (string) $user['pin'])) {
            return false;
        }

        $roleEnum = (string) ($user['role'] ?? 'Staff');
        $roles = [
            'staff',
            strtolower(str_replace(' ', '_', $roleEnum)),
        ];

        $position = (string) ($user['position'] ?? '');
        $isMedic = stripos($position, 'dokter') !== false || stripos($position, 'paramedic') !== false;
        if ($isMedic) {
            $roles[] = 'medic';
        }

        $roles = array_values(array_unique(array_filter($roles)));

        $this->session->regenerate(true);
        $this->session->set(self::SESSION_KEY, [
            'logged_in' => true,
            'user_type' => 'admin',
            'user_id'   => (int) ($user['id'] ?? 0),
            'full_name' => (string) ($user['full_name'] ?? ''),
            'role'      => $roleEnum,
            'roles'     => $roles,
            'logged_in_at' => time(),
        ]);

        return true;
    }

    public function logout(): void
    {
        $this->session->remove(self::SESSION_KEY);
        $this->session->regenerate(true);
    }
}

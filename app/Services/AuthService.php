<?php

namespace App\Services;

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Session\Session;
use CodeIgniter\Throttle\ThrottlerInterface;

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

    public function loginAdmin(string $email, string $password): bool
    {
        $ip = (string) $this->request->getIPAddress();
        $key = 'roxwood-admin-login-' . $ip;

        // Basic brute-force protection (shared hosting friendly)
        if (! $this->throttler->check($key, 10, MINUTE)) {
            return false;
        }

        $expectedEmail = (string) (getenv('ROXWOOD_ADMIN_EMAIL') ?: 'admin@example.com');
        $expectedPassword = (string) (getenv('ROXWOOD_ADMIN_PASSWORD') ?: '');
        $expectedPasswordHash = (string) (getenv('ROXWOOD_ADMIN_PASSWORD_HASH') ?: '');

        $emailOk = hash_equals(mb_strtolower($expectedEmail), mb_strtolower($email));

        $passwordOk = false;
        if ($expectedPasswordHash !== '') {
            $passwordOk = password_verify($password, $expectedPasswordHash);
        } elseif ($expectedPassword !== '') {
            $passwordOk = hash_equals($expectedPassword, $password);
        }

        if (! ($emailOk && $passwordOk)) {
            return false;
        }

        $this->session->regenerate(true);
        $this->session->set(self::SESSION_KEY, [
            'logged_in' => true,
            'user_type' => 'admin',
            'email'     => $expectedEmail,
            'roles'     => ['admin'],
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


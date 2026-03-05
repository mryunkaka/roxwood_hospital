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
    private ?string $lastError = null;

    private function normalizeFullName(string $fullName): string
    {
        $fullName = trim($fullName);
        $fullName = preg_replace('/\s+/u', ' ', $fullName) ?? $fullName;
        return $fullName;
    }

    private function verifyPin(string $inputPin, string $storedPin): bool
    {
        $inputPin = trim($inputPin);
        $storedPin = trim($storedPin);

        // Prefer bcrypt/argon hashes (CodeIgniter dump uses bcrypt for `user_rh.pin`).
        if ($storedPin !== '' && str_starts_with($storedPin, '$')) {
            return password_verify($inputPin, $storedPin);
        }

        // Fallback for legacy/plain PIN storage.
        return hash_equals($storedPin, $inputPin);
    }

    public function __construct(
        private readonly Session $session,
        private readonly IncomingRequest $request,
        private readonly ThrottlerInterface $throttler,
    ) {
    }

    public function lastError(): ?string
    {
        return $this->lastError;
    }

    public function lastErrorMessage(): ?string
    {
        return match ($this->lastError) {
            'throttled' => 'Too many attempts. Please wait a moment and try again.',
            'db_error' => 'Database connection failed. Check your database settings in `.env`.',
            'user_not_found' => 'User not found.',
            'inactive' => 'Account is inactive.',
            'invalid_pin' => 'Invalid PIN.',
            default => null,
        };
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
        $this->lastError = null;
        $fullName = $this->normalizeFullName($fullName);

        $ip = (string) $this->request->getIPAddress();
        // Throttler keys are stored in cache and must not contain reserved characters.
        // IPs like "::1" (IPv6 localhost) contain ":" which breaks CI cache key validation.
        $key = 'roxwood_admin_login_' . hash('sha256', $ip);

        // Basic brute-force protection (shared hosting friendly)
        if (! $this->throttler->check($key, 10, MINUTE)) {
            $this->lastError = 'throttled';
            return false;
        }

        try {
            $model = new UserRhModel();

            // 1) Exact match first (fast path).
            $user = $model->where('full_name', $fullName)->first();

            // 2) Case-insensitive fallback (handles case-sensitive collations).
            if (! is_array($user)) {
                $builder = $model->builder();
                $builder->where('LOWER(full_name)', mb_strtolower($fullName, 'UTF-8'), false);
                $user = $builder->get(1)->getRowArray();
            }
        } catch (Throwable) {
            // DB not configured / unavailable
            $this->lastError = 'db_error';
            return false;
        }

        if (! is_array($user) || empty($user['pin'])) {
            $this->lastError = 'user_not_found';
            return false;
        }

        if (($user['is_active'] ?? 0) != 1) {
            $this->lastError = 'inactive';
            return false;
        }

        if (! $this->verifyPin($pin, (string) $user['pin'])) {
            $this->lastError = 'invalid_pin';
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

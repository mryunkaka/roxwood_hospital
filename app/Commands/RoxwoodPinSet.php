<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Throwable;

class RoxwoodPinSet extends BaseCommand
{
    protected $group       = 'Roxwood';
    protected $name        = 'roxwood:pin-set';
    protected $description = 'Set (reset) a PIN for a user_rh record by full_name.';
    protected $usage       = 'roxwood:pin-set "<full_name>" <pin>';
    protected $arguments   = [
        'full_name' => 'Exact full_name in user_rh (use quotes if it contains spaces).',
        'pin'       => 'New PIN in plain text. Will be stored as bcrypt.',
    ];

    public function run(array $params)
    {
        $fullName = (string) ($params[0] ?? '');
        $pin      = (string) ($params[1] ?? '');

        $fullName = trim(preg_replace('/\s+/u', ' ', $fullName) ?? $fullName);
        $pin      = trim($pin);

        if ($fullName === '' || $pin === '') {
            CLI::error('Usage: php spark roxwood:pin-set "Full Name" 8141');
            return;
        }

        $db = db_connect();

        try {
            $builder = $db->table('user_rh');
            $user = $builder->select('id, full_name')->where('full_name', $fullName)->get(1)->getRowArray();
        } catch (Throwable $e) {
            CLI::error('Database error: ' . $e->getMessage());
            return;
        }

        if (! is_array($user)) {
            CLI::error('User not found in user_rh.full_name: ' . $fullName);
            return;
        }

        $hash = password_hash($pin, PASSWORD_BCRYPT);

        $data = ['pin' => $hash];
        if ($db->fieldExists('pin_changed', 'user_rh')) {
            $data['pin_changed'] = 1;
        }

        try {
            $db->table('user_rh')->where('id', (int) $user['id'])->update($data);
        } catch (Throwable $e) {
            CLI::error('Failed to update PIN: ' . $e->getMessage());
            return;
        }

        CLI::write('PIN updated for: ' . $user['full_name'] . ' (id=' . $user['id'] . ')');
    }
}


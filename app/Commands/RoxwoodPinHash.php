<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class RoxwoodPinHash extends BaseCommand
{
    protected $group       = 'Roxwood';
    protected $name        = 'roxwood:pin-hash';
    protected $description = 'Generate bcrypt hash for a PIN (for user_rh.pin).';
    protected $usage       = 'roxwood:pin-hash <pin>';
    protected $arguments   = [
        'pin' => 'PIN in plain text.',
    ];

    public function run(array $params)
    {
        $pin = (string) ($params[0] ?? '');
        $pin = trim($pin);

        if ($pin === '') {
            CLI::error('Missing <pin>. Example: php spark roxwood:pin-hash 8141');
            return;
        }

        $hash = password_hash($pin, PASSWORD_BCRYPT);
        CLI::write($hash);
    }
}


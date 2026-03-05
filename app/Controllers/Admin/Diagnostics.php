<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Throwable;

class Diagnostics extends BaseController
{
    public function db()
    {
        if (! defined('ENVIRONMENT') || ENVIRONMENT === 'production') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $dbConfig = (array) (config('Database')->default ?? []);
        unset($dbConfig['password']);

        $result = [
            'connected' => false,
            'error'     => null,
            'tables'    => [],
            'user_rh'   => [
                'exists' => false,
                'count'  => null,
                'sample' => [],
                'columns_ok' => false,
                'missing_columns' => [],
            ],
        ];

        try {
            $db = db_connect();
            $db->initialize();
            $result['connected'] = true;

            $result['tables'] = $db->listTables() ?? [];

            if (in_array('user_rh', $result['tables'], true)) {
                $result['user_rh']['exists'] = true;

                $fields = $db->getFieldNames('user_rh') ?? [];
                $required = ['full_name', 'pin', 'is_active'];
                $missing = array_values(array_diff($required, $fields));
                $result['user_rh']['missing_columns'] = $missing;
                $result['user_rh']['columns_ok'] = count($missing) === 0;

                $row = $db->table('user_rh')->selectCount('id', 'c')->get()->getRowArray();
                $result['user_rh']['count'] = isset($row['c']) ? (int) $row['c'] : null;

                $sample = $db->table('user_rh')
                    ->select('id, full_name, role, is_active, updated_at')
                    ->orderBy('id', 'ASC')
                    ->get(5)
                    ->getResultArray();
                $result['user_rh']['sample'] = is_array($sample) ? $sample : [];
            }
        } catch (Throwable $e) {
            $result['error'] = $e->getMessage();
        }

        return view('admin/diagnostics_db', [
            'title'        => 'Database Check',
            'assetVersion' => '1',
            'dbConfig'     => $dbConfig,
            'result'       => $result,
        ]);
    }
}


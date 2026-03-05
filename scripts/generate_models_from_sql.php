<?php

/**
 * Generate CodeIgniter 4 Models from a SQL schema dump.
 *
 * Usage (PowerShell):
 *   php scripts/generate_models_from_sql.php hark8423_ems.sql
 *
 * Notes:
 * - This script DOES NOT modify the database schema.
 * - It reads CREATE TABLE + ALTER TABLE PRIMARY KEY/AUTO_INCREMENT statements.
 */

declare(strict_types=1);

if ($argc < 2) {
    fwrite(STDERR, "Usage: php scripts/generate_models_from_sql.php <schema.sql>\n");
    exit(1);
}

$schemaPath = $argv[1];
if (!is_file($schemaPath)) {
    fwrite(STDERR, "Schema not found: {$schemaPath}\n");
    exit(1);
}

$sql = file_get_contents($schemaPath);
if ($sql === false) {
    fwrite(STDERR, "Failed to read schema: {$schemaPath}\n");
    exit(1);
}

// 1) Parse CREATE TABLE blocks
$tables = [];
if (preg_match_all('/CREATE TABLE `([^`]+)`\\s*\\((.*?)\\) ENGINE=/s', $sql, $matches, PREG_SET_ORDER)) {
    foreach ($matches as $m) {
        $table = $m[1];
        $body = $m[2];
        $columns = [];

        foreach (preg_split("/\\r?\\n/", $body) as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] !== '`') {
                continue;
            }
            if (!preg_match('/^`([^`]+)`\\s+(.+?)(,)?$/', $line, $cm)) {
                continue;
            }
            $colName = $cm[1];
            $colDef  = $cm[2];
            $columns[$colName] = $colDef;
        }

        $tables[$table] = [
            'columns' => $columns,
            'primaryKey' => null,
            'autoIncrement' => false,
        ];
    }
}

// 2) Parse primary keys from ALTER TABLE statements
if (preg_match_all('/ALTER TABLE `([^`]+)`\\s+ADD PRIMARY KEY \\(`([^`]+)`\\)/', $sql, $pkMatches, PREG_SET_ORDER)) {
    foreach ($pkMatches as $m) {
        $table = $m[1];
        $pk = $m[2];
        if (isset($tables[$table])) {
            $tables[$table]['primaryKey'] = $pk;
        }
    }
}

// 3) Parse auto increment
if (preg_match_all('/ALTER TABLE `([^`]+)`\\s+MODIFY `([^`]+)`[^;]*AUTO_INCREMENT/mi', $sql, $aiMatches, PREG_SET_ORDER)) {
    foreach ($aiMatches as $m) {
        $table = $m[1];
        $col = $m[2];
        if (isset($tables[$table]) && ($tables[$table]['primaryKey'] === $col)) {
            $tables[$table]['autoIncrement'] = true;
        }
    }
}

// 4) Generate model files
$modelsDir = __DIR__ . '/../app/Models';
if (!is_dir($modelsDir)) {
    mkdir($modelsDir, 0777, true);
}

// Convert snake_case to PascalCase, preserve common acronyms lightly
function modelClassName(string $table): string
{
    $parts = preg_split('/_+/', $table);
    $parts = array_map(static function ($p) {
        return ucfirst($p);
    }, $parts);
    return implode('', $parts) . 'Model';
}

function phpArrayList(array $items): string
{
    $out = [];
    foreach ($items as $i) {
        $out[] = "        '" . str_replace("'", "\\'", $i) . "',";
    }
    return implode("\n", $out);
}

$count = 0;
foreach ($tables as $tableName => $info) {
    $columns = array_keys($info['columns']);
    if ($columns === []) {
        continue;
    }

    $pk = $info['primaryKey'] ?? 'id';
    $autoIncrement = $info['autoIncrement'] ? 'true' : 'false';

    $useSoftDeletes = in_array('deleted_at', $columns, true) ? 'true' : 'false';
    $useTimestamps = (in_array('created_at', $columns, true) && in_array('updated_at', $columns, true)) ? 'true' : 'false';

    $allowedFields = array_values(array_filter($columns, static fn ($c) => $c !== $pk));

    $className = modelClassName($tableName);
    $path = $modelsDir . '/' . $className . '.php';

    $allowedFieldsBlock = $allowedFields ? phpArrayList($allowedFields) : "        // no writable fields\n";

    $php = <<<PHP
<?php

namespace App\\Models;

use CodeIgniter\\Model;

class {$className} extends Model
{
    protected \$table            = '{$tableName}';
    protected \$primaryKey       = '{$pk}';
    protected \$useAutoIncrement = {$autoIncrement};
    protected \$returnType       = 'array';
    protected \$protectFields    = true;
    protected \$allowedFields    = [
{$allowedFieldsBlock}
    ];

    protected \$useSoftDeletes   = {$useSoftDeletes};

    protected \$useTimestamps    = {$useTimestamps};
    protected \$dateFormat       = 'datetime';
    protected \$createdField     = 'created_at';
    protected \$updatedField     = 'updated_at';
    protected \$deletedField     = 'deleted_at';
}

PHP;

    file_put_contents($path, $php);
    $count++;
}

echo "Generated {$count} model(s) into app/Models.\n";

<?php

/**
 * Generate docs/database_structure.md from SQL schema dump.
 *
 * Usage:
 *   php scripts/generate_database_structure_md.php hark8423_ems.sql docs/database_structure.md
 */

declare(strict_types=1);

if ($argc < 3) {
    fwrite(STDERR, "Usage: php scripts/generate_database_structure_md.php <schema.sql> <output.md>\n");
    exit(1);
}

$schemaPath = $argv[1];
$outPath = $argv[2];

if (!is_file($schemaPath)) {
    fwrite(STDERR, "Schema not found: {$schemaPath}\n");
    exit(1);
}

$sql = file_get_contents($schemaPath);
if ($sql === false) {
    fwrite(STDERR, "Failed to read schema: {$schemaPath}\n");
    exit(1);
}

$tables = [];
if (preg_match_all('/CREATE TABLE `([^`]+)`\\s*\\((.*?)\\) ENGINE=([^;]+);/s', $sql, $matches, PREG_SET_ORDER)) {
    foreach ($matches as $m) {
        $table = $m[1];
        $body = $m[2];
        $engineTail = trim($m[3]);

        $columns = [];
        foreach (preg_split("/\\r?\\n/", $body) as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] !== '`') {
                continue;
            }
            if (preg_match('/^`([^`]+)`\\s+(.+?)(,)?$/', $line, $cm)) {
                $columns[] = [
                    'name' => $cm[1],
                    'def'  => rtrim($cm[2], ','),
                ];
            }
        }

        $tables[$table] = [
            'engine' => $engineTail,
            'columns' => $columns,
            'primary' => null,
        ];
    }
}

if (preg_match_all('/ALTER TABLE `([^`]+)`\\s+ADD PRIMARY KEY \\(([^\\)]+)\\)/', $sql, $pkMatches, PREG_SET_ORDER)) {
    foreach ($pkMatches as $m) {
        $table = $m[1];
        $pkRaw = trim($m[2]);
        if (!isset($tables[$table])) {
            continue;
        }
        $tables[$table]['primary'] = $pkRaw;
    }
}

ksort($tables);

$lines = [];
$lines[] = '# Struktur Database (Berdasarkan SQL)';
$lines[] = '';
$lines[] = 'Sumber kebenaran: `hark8423_ems.sql` (dump phpMyAdmin, 2026-03-05).';
$lines[] = '';
$lines[] = 'Aturan: **dilarang mengubah schema**; Model harus mengikuti struktur ini 1:1.';
$lines[] = '';
$lines[] = '## Ringkasan tabel';
$lines[] = '';
$lines[] = '- Total tabel: **' . count($tables) . '**';
$lines[] = '';

foreach ($tables as $table => $info) {
    $lines[] = '### `' . $table . '`';
    $lines[] = '';
    if (!empty($info['primary'])) {
        $lines[] = '- Primary key: ' . $info['primary'];
    }
    $lines[] = '- Engine/charset: ' . $info['engine'];
    $lines[] = '';
    $lines[] = '| Column | Definition |';
    $lines[] = '|---|---|';
    foreach ($info['columns'] as $col) {
        $lines[] = '| `' . $col['name'] . '` | ' . str_replace('|', '\\|', $col['def']) . ' |';
    }
    $lines[] = '';
}

file_put_contents($outPath, implode("\n", $lines) . "\n");
echo "Wrote: {$outPath}\n";


<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../Common/ClassLoader.php';
require_once __DIR__ . '/../Common/DependencyInjection.php';

$status = 'ok';
$database = 'ok';

try {
    DependencyInjection::boot();
    $pdo = DependencyInjection::getPdo();
    $pdo->query('SELECT 1');
} catch (Throwable $exception) {
    $status = 'error';
    $database = 'error';
}

if ($status !== 'ok') {
    http_response_code(503);
}

echo json_encode(
    array(
        'status' => $status,
        'database' => $database,
        'time' => date('c'),
    ),
    JSON_UNESCAPED_UNICODE
);

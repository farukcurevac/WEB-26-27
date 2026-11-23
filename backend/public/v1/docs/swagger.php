<?php
ini_set('display_errors', 0);
error_reporting(0);

require __DIR__ . '/../../../vendor/autoload.php';

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/backend/public/v1/docs/swagger.php'));
$basePath = preg_replace('#/public/v1/docs$#', '', $scriptDir);
define('API_BASE_URL', $scheme . '://' . $host . rtrim($basePath, '/') . '/');

require_once __DIR__ . '/doc_setup.php';
foreach (glob(__DIR__ . '/paths/*.php') as $pathFile) {
    require_once $pathFile;
}

use OpenApi\Generator;

$openapi = (new Generator())->generate([
    __DIR__ . '/doc_setup.php',
    __DIR__ . '/paths'
]);

header('Content-Type: application/json');
echo $openapi->toJson();
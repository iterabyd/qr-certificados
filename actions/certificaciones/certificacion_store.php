<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../config/config.php';
require_once '../../controllers/CertificacionController.php';

header('Content-Type: application/json; charset=utf-8');

$controller = new CertificacionController();

echo json_encode(
    $controller->crear(),
    JSON_UNESCAPED_UNICODE
);
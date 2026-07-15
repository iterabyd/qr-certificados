<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../config/config.php';
require_once '../../controllers/CertificacionController.php';

header('Content-Type: application/json; charset=utf-8');

$controller = new CertificacionController();

echo json_encode(
    $controller->cambiarEstado(),
    JSON_UNESCAPED_UNICODE
);
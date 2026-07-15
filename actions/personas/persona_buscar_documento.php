<?php

require_once '../../config/config.php';
require_once '../../controllers/PersonaController.php';

header('Content-Type: application/json; charset=utf-8');

$numero_documento = $_GET['numero_documento'] ?? '';

$controller = new PersonaController();

echo json_encode(
    $controller->buscarPorDocumento($numero_documento),
    JSON_UNESCAPED_UNICODE
);
<?php

require_once '../../config/config.php';
require_once '../../controllers/PersonaController.php';

header('Content-Type: application/json; charset=utf-8');

$controller = new PersonaController();

echo json_encode(
    $controller->cambiarEstado(),
    JSON_UNESCAPED_UNICODE
);
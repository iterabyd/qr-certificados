<?php

require_once '../../config/config.php';
require_once '../../controllers/PersonaController.php';

header('Content-Type: application/json; charset=utf-8');

$controller = new PersonaController();

echo json_encode(
    $controller->actualizar(),
    JSON_UNESCAPED_UNICODE
);
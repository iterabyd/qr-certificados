<?php

require_once '../../config/config.php';
require_once '../../controllers/UsuarioController.php';

header('Content-Type: application/json; charset=utf-8');

$controller = new UsuarioController();

echo json_encode(
    $controller->actualizar(),
    JSON_UNESCAPED_UNICODE
);
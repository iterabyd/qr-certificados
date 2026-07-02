<?php

require_once '../../config/config.php';
require_once '../../controllers/UsuarioController.php';

header('Content-Type: application/json; charset=utf-8');

$controller = new UsuarioController();

echo json_encode(
    $controller->crear(),
    JSON_UNESCAPED_UNICODE
);
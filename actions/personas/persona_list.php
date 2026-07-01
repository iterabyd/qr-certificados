<?php

require_once '../../config/config.php';
require_once '../../controllers/PersonaController.php';

// Indicar que la respuesta será JSON
header('Content-Type: application/json; charset=utf-8');

// Crear controlador
$controller = new PersonaController();

// Devolver listado de personas en formato JSON
echo json_encode(
    $controller->listar(),
    JSON_UNESCAPED_UNICODE
);
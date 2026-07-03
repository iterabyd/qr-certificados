<?php

require_once '../../config/config.php';
require_once '../../controllers/UsuarioController.php';

header('Content-Type: application/json; charset=utf-8');

try {

    $controller = new UsuarioController();

    $response = $controller->crear();

    echo json_encode(
        $response,
        JSON_UNESCAPED_UNICODE
    );

} catch (Exception $e) {

    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);

}
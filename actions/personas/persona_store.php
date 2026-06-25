<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controllers/PersonaController.php';

// Solo procesar si es una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/views/personas/index.php');
    exit;
}

$controller = new PersonaController();

$controller->crear();
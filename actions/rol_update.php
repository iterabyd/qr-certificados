<?php

// Cargar controlador
require_once '../controllers/RolController.php';

// Crear instancia del controlador
$controller = new RolController();

// Registrar rol
$controller->crear();
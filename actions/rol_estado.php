<?php

// Cargar controlador
require_once '../controllers/RolController.php';

// Crear instancia
$controller = new RolController();

// Cambiar estado
$controller->cambiarEstado();
<?php

// Cargar controlador
require_once '../controllers/RolController.php';

// Instanciar controlador
$controller = new RolController();

// Actualizar rol
$controller->actualizar();
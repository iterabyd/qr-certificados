<?php

// Cargar controlador
require_once '../controllers/LoginController.php';

// Crear instancia
$controller =
    new LoginController();

// Ejecutar login
$controller->login();
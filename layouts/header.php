<?php

// Validar sesión activa
if (!isset($_SESSION)) {
    session_start();
}

// Asegurar que BASE_URL y demás constantes estén definidas,
// sin importar desde qué vista se incluya este header.
if (!defined('BASE_URL')) {
    require_once __DIR__ . '/../config/config.php';
}

if (!isset($_SESSION['usuario'])) {
    header('Location: /qr-certificados/views/auth/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <!-- Fuente moderna -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

    <title>Sistema QR</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="/qr-certificados/assets/css/app.css?v=<?= time(); ?>">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-gray-100 font-[Inter] overflow-x-hidden">

    <!-- Contenedor principal -->

    <div class="flex min-h-screen relative">
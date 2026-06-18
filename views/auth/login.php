<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/config.php';

if(isset($_SESSION['usuario']))
{
    header('Location: ' . BASE_URL . '/views/dashboard/index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <script src="https://cdn.tailwindcss.com"></script>

    <title>Login</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">

    <h1 class="text-2xl font-bold text-center mb-6">
        Sistema QR
    </h1>

    <form method="POST" action="<?= BASE_URL ?>/actions/login.php">

        <div class="mb-4">

            <label class="block mb-2">
                Usuario
            </label>

            <input
                type="text"
                name="usuario"
                required
                class="w-full border rounded-lg px-3 py-2"
            >

        </div>

        <div class="mb-6">

            <label class="block mb-2">
                Contraseña
            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full border rounded-lg px-3 py-2"
            >

        </div>

        <button
            type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700"
        >
            Ingresar
        </button>

    </form>

</div>

</body>
</html>
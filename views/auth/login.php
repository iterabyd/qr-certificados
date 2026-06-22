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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <title>Login</title>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#3E2723] to-[#5C4033] px-4 py-8">

<div class="bg-white p-6 sm:p-8 md:p-10 rounded-2xl sm:rounded-3xl shadow-2xl w-full max-w-sm sm:max-w-md md:max-w-lg">

    <h1 class="text-2xl sm:text-3xl font-bold text-center text-[#3E2723] mb-2">
        Sistema QR
    </h1>

    <p class="text-center text-gray-500 mb-6 text-sm sm:text-base">
        Iniciar sesión
    </p>

    <form method="POST" action="<?= BASE_URL ?>/actions/login.php" class="space-y-4">

        <div>

            <label class="block mb-1.5 text-sm sm:text-base font-medium text-gray-700">
                Usuario
            </label>

            <input
                type="text"
                name="usuario"
                required
                autocomplete="username"
                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-[#5C4033] focus:border-transparent transition"
            >

        </div>

        <div>

            <label class="block mb-1.5 text-sm sm:text-base font-medium text-gray-700">
                Contraseña
            </label>

            <input
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-base focus:outline-none focus:ring-2 focus:ring-[#5C4033] focus:border-transparent transition"
            >

        </div>

        <button
            type="submit"
            class="w-full bg-[#3E2723] text-white py-2.5 sm:py-3 rounded-lg font-medium hover:bg-[#5C4033] active:scale-[0.98] transition-all"
        >
            Ingresar
        </button>

    </form>

</div>

</body>
</html>

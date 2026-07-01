<?php
// Cargar layout
require_once '../../layouts/header.php';
require_once '../../layouts/sidebar.php';

// Título usado por navbar.php
$tituloPagina = 'Dashboard';
require_once '../../layouts/navbar.php';
?>

<!-- Contenido -->
<main class="p-4 md:p-6">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">

        <!-- Tarjeta -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500">
                Usuarios
            </h3>
            <p class="text-3xl font-bold text-[#C9A227]">
                0
            </p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500">
                Certificaciones
            </h3>
            <p class="text-3xl font-bold text-[#C9A227]">
                0
            </p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500">
                Verificaciones
            </h3>
            <p class="text-3xl font-bold text-[#C9A227]">
                0
            </p>
        </div>

    </div>

</main>

<?php
require_once '../../layouts/footer.php';
?>
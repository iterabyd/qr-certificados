<?php

// Cargar layout
require_once '../../layouts/header.php';
require_once '../../layouts/sidebar.php';

?>

<div class="flex-1">

    <!-- Cabecera -->

    <header class="header-app shadow p-4">

        <h2
            class="text-xl font-semibold text-[#3E2723]"
        >
            Dashboard
        </h2>

        <span
            class="text-gray-600"
        >
            <?= $_SESSION['usuario']; ?>
        </span>

    </header>

    <!-- Contenido -->

    <main class="p-6">

        <div
            class="grid grid-cols-1 md:grid-cols-3 gap-6"
        >

            <!-- Tarjeta -->

            <div
                class="bg-white rounded-lg shadow p-6"
            >

                <h3
                    class="text-gray-500"
                >
                    Usuarios
                </h3>

                <p
                    class="text-3xl font-bold text-[#C9A227]"
                >
                    0
                </p>

            </div>

            <div
                class="bg-white rounded-lg shadow p-6"
            >

                <h3
                    class="text-gray-500"
                >
                    Certificaciones
                </h3>

                <p
                    class="text-3xl font-bold text-[#C9A227]"
                >
                    0
                </p>

            </div>

            <div
                class="bg-white rounded-lg shadow p-6"
            >

                <h3
                    class="text-gray-500"
                >
                    Verificaciones
                </h3>

                <p
                    class="text-3xl font-bold text-[#C9A227]"
                >
                    0
                </p>

            </div>

        </div>

    </main>

</div>

<?php

require_once '../../layouts/footer.php';

?>
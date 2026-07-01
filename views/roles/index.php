<?php

require_once '../../config/config.php';

require_once '../../layouts/header.php';
require_once '../../layouts/sidebar.php';

require_once '../../controllers/RolController.php';

$jsModulo = 'roles'; 

// Título de la página
$tituloPagina = 'Roles';

// Instanciar controlador
$controller = new RolController();

// Obtener roles
$roles = $controller->listar();

?>

<div id="mainContent" class="flex-1 transition-all duration-300">

     <?php require_once '../../layouts/navbar.php'; ?>
    <main class="p-6">

        <div class="mb-4">

        <button onclick="abrirModal('modalCrearRol')" class="btn-primary px-4 py-2 rounded-lg inline-flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Nuevo Rol</span>
        </button>

        </div>

        <div class="card p-4">
            <div id="tablaRoles"></div>

        </div>

    </main>

</div>

<!-- modales -->

<!-- Modal Crear -->
<div id="modalCrearRol" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl w-[95%] md:w-full max-w-lg p-6">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-semibold text-[#3E2723]">Nuevo Rol</h3>
            <button type="button" onclick="cerrarModal('modalCrearRol')"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/actions/rol_store.php">
            <div class="mb-4">
                <label class="block mb-2 font-medium">Nombre</label>
                <input type="text" name="nombre" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Descripción</label>
                <textarea name="descripcion" rows="4" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="cerrarModal('modalCrearRol')" class="px-4 py-2 border rounded-lg">Cancelar</button>
                <button type="submit" class="bg-[#C9A227] hover:bg-[#b38f1f] text-white px-4 py-2 rounded-lg">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar -->
<div id="modalEditarRol" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl w-[95%] md:w-full max-w-lg p-6">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-semibold text-[#3E2723]">Editar Rol</h3>
            <button type="button" onclick="cerrarModal('modalEditarRol')"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/actions/rol_update.php">
            <input type="hidden" id="edit_id" name="id">

            <div class="mb-4">
                <label class="block mb-2 font-medium">Nombre</label>
                <input type="text" id="edit_nombre" name="nombre" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Descripción</label>
                <textarea id="edit_descripcion" name="descripcion" rows="4" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="cerrarModal('modalEditarRol')" class="px-4 py-2 border rounded-lg">Cancelar</button>
                <button type="submit" class="bg-[#C9A227] hover:bg-[#b38f1f] text-white px-4 py-2 rounded-lg">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<script>

const roles = <?= json_encode($roles); ?>;

</script>


<?php require_once '../../layouts/footer.php'; ?>
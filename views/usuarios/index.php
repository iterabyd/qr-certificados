<?php

require_once '../../config/config.php';

require_once '../../layouts/header.php';
require_once '../../layouts/sidebar.php';

require_once '../../controllers/UsuarioController.php';
require_once '../../controllers/RolController.php';

$jsModulo = 'usuarios'; 
// Título de la página
$tituloPagina = 'Usuarios';

// Instanciar controladores
$controller = new UsuarioController();
$rolController = new RolController();

// Obtener usuarios y roles (para el select de rol)
$usuarios = $controller->listar();
$roles = $rolController->listar();

require_once '../../layouts/navbar.php';

?>

<main class="p-4 md:p-6">

    <div class="mb-4">

        <button onclick="abrirModal('modalCrearUsuario')" class="btn-primary px-4 py-2 rounded-lg inline-flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Nuevo Usuario</span>
        </button>

    </div>

    <div class="card p-4 overflow-x-auto">
        <div id="tablaUsuarios"></div>
    </div>

</main>

<!-- modales -->

<!-- Modal Crear -->
<div id="modalCrearUsuario" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">

        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-semibold text-[#3E2723]">Nuevo Usuario</h3>
            <button type="button" onclick="cerrarModal('modalCrearUsuario')"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/actions/usuarios/usuario_store.php" class="space-y-4">

            <div>
                <label class="block mb-1.5 font-medium">Rol</label>
                <select name="rol_id" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
                    <option value="">Seleccione un rol</option>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?= $rol['id'] ?>"><?= htmlspecialchars($rol['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block mb-1.5 font-medium">Nombre de Usuario</label>
                    <input type="text" name="usuario" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
                </div>

                <div>
                    <label class="block mb-1.5 font-medium">Contraseña</label>
                    <input type="password" name="password" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
                </div>

            </div>

            <div>
                <label class="block mb-1.5 font-medium">Nombres</label>
                <input type="text" name="nombres" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block mb-1.5 font-medium">Apellido Paterno</label>
                    <input type="text" name="ap_paterno" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
                </div>

                <div>
                    <label class="block mb-1.5 font-medium">Apellido Materno</label>
                    <input type="text" name="ap_materno" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
                </div>

            </div>

            <div>
                <label class="block mb-1.5 font-medium">Email</label>
                <input type="email" name="email" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="cerrarModal('modalCrearUsuario')" class="px-4 py-2 border rounded-lg">Cancelar</button>
                <button type="submit" class="bg-[#C9A227] hover:bg-[#b38f1f] text-white px-4 py-2 rounded-lg">Guardar</button>
            </div>

        </form>
    </div>
</div>

<!-- Modal Editar -->
<div id="modalEditarUsuario" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">

        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-semibold text-[#3E2723]">Editar Usuario</h3>
            <button type="button" onclick="cerrarModal('modalEditarUsuario')"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/actions/usuarios/usuario_update.php" class="space-y-4">

            <input type="hidden" id="edit_id" name="id">

            <div>
                <label class="block mb-1.5 font-medium">Rol</label>
                <select id="edit_rol_id" name="rol_id" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
                    <option value="">Seleccione un rol</option>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?= $rol['id'] ?>"><?= htmlspecialchars($rol['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block mb-1.5 font-medium">Nombre de Usuario</label>
                <input type="text" id="edit_usuario" name="usuario" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
            </div>

            <div>
                <label class="block mb-1.5 font-medium">Nombres</label>
                <input type="text" id="edit_nombres" name="nombres" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block mb-1.5 font-medium">Apellido Paterno</label>
                    <input type="text" id="edit_ap_paterno" name="ap_paterno" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
                </div>

                <div>
                    <label class="block mb-1.5 font-medium">Apellido Materno</label>
                    <input type="text" id="edit_ap_materno" name="ap_materno" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
                </div>

            </div>

            <div>
                <label class="block mb-1.5 font-medium">Email</label>
                <input type="email" id="edit_email" name="email" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="cerrarModal('modalEditarUsuario')" class="px-4 py-2 border rounded-lg">Cancelar</button>
                <button type="submit" class="bg-[#C9A227] hover:bg-[#b38f1f] text-white px-4 py-2 rounded-lg">Actualizar</button>
            </div>

        </form>
    </div>
</div>

<!-- Modal Cambiar Contraseña -->
<div id="modalPasswordUsuario" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">

        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-semibold text-[#3E2723]">Cambiar Contraseña</h3>
            <button type="button" onclick="cerrarModal('modalPasswordUsuario')"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/actions/usuarios/usuario_password.php" class="space-y-4">

            <input type="hidden" id="password_id" name="id">

            <div>
                <label class="block mb-1.5 font-medium">Nueva Contraseña</label>
                <input type="password" name="password" required minlength="6" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="cerrarModal('modalPasswordUsuario')" class="px-4 py-2 border rounded-lg">Cancelar</button>
                <button type="submit" class="bg-[#C9A227] hover:bg-[#b38f1f] text-white px-4 py-2 rounded-lg">Actualizar Contraseña</button>
            </div>

        </form>
    </div>
</div>

<script>
const usuarios = <?= json_encode($usuarios); ?>;
</script>

<?php require_once '../../layouts/footer.php'; ?>
<?php

require_once '../../config/config.php';

require_once '../../layouts/header.php';
require_once '../../layouts/sidebar.php';

require_once '../../controllers/PersonaController.php';
require_once '../../controllers/TipoDocumentoController.php';

$jsModulo = 'personas'; 

// Título de la página
$tituloPagina = 'Personas';

// Instanciar controladores
$controller = new PersonaController();
$tipoDocumentoController = new TipoDocumentoController();

// Obtener personas y tipos de documento (para el select de tipo de documento)
$personas = $controller->listar();
$tiposDocumento = $tipoDocumentoController->listar();

require_once '../../layouts/navbar.php';

?>

<main class="p-4 md:p-6">

    <div class="mb-4">

        <button onclick="abrirModal('modalCrearPersona')" class="btn-primary px-4 py-2 rounded-lg inline-flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Nueva Persona</span>
        </button>

    </div>
    <!-- Tabla de Personas -->
    <div class="card p-4 overflow-x-auto">
        <div id="tablaPersonas"></div>
    </div>

</main>

<!-- modales -->

<!-- Modal Crear -->
<div id="modalCrearPersona" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">

        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-semibold text-[#3E2723]">Nueva Persona</h3>
            <button type="button" onclick="cerrarModal('modalCrearPersona')"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/actions/personas/persona_store.php" class="space-y-4">

            <div>
                <label class="block mb-1.5 font-medium">Tipo de Documento</label>
                <select name="tipo_documento_id" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
                    <option value="">Seleccione un tipo de documento</option>
                    <?php foreach ($tiposDocumento as $tipoDocumento): ?>
                        <option value="<?= $tipoDocumento['id'] ?>"><?= htmlspecialchars($tipoDocumento['descripcion']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block mb-1.5 font-medium">Numero de Documento</label>
                    <input type="text" name="numero_documento" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
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

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="cerrarModal('modalCrearPersona')" class="px-4 py-2 border rounded-lg">Cancelar</button>
                <button type="submit" class="bg-[#C9A227] hover:bg-[#b38f1f] text-white px-4 py-2 rounded-lg">Guardar</button>
            </div>

        </form>
    </div>
</div>

<!-- Modal Editar -->
<div id="modalEditarPersona" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">

        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-semibold text-[#3E2723]">Editar Persona</h3>
            <button type="button" onclick="cerrarModal('modalEditarPersona')"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>

        <form method="POST" action="<?= BASE_URL ?>/actions/personas/persona_update.php" class="space-y-4">

            <input type="hidden" id="edit_id" name="id">

            <div>
                <label class="block mb-1.5 font-medium">Tipo de Documento</label>
                <select id="edit_tipo_documento_id" name="tipo_documento_id" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
                    <option value="">Seleccione un tipo de documento</option>
                    <?php foreach ($tiposDocumento as $tipoDocumento): ?>
                        <option value="<?= $tipoDocumento['id'] ?>"><?= htmlspecialchars($tipoDocumento['descripcion']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block mb-1.5 font-medium">Numero de Documento</label>
                <input type="text" id="edit_numero_documento" name="numero_documento" required class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
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
                <button type="button" onclick="cerrarModal('modalEditarPersona')" class="px-4 py-2 border rounded-lg">Cancelar</button>
                <button type="submit" class="bg-[#C9A227] hover:bg-[#b38f1f] text-white px-4 py-2 rounded-lg">Actualizar</button>
            </div>

        </form>
    </div>
</div>



<script>
const personas = <?= json_encode($personas); ?>;
console.log(personas);
</script>

<?php require_once '../../layouts/footer.php'; ?>
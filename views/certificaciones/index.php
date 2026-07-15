<?php

require_once '../../config/config.php';

require_once '../../layouts/header.php';
require_once '../../layouts/sidebar.php';

require_once '../../controllers/CertificacionController.php';
require_once '../../controllers/PersonaController.php';
require_once '../../controllers/ObjetoLegalizacionController.php';
require_once '../../controllers/EstadoController.php';

require_once '../../controllers/TipoDocumentoController.php';

$tipoDocumentoController = new TipoDocumentoController();
$tiposDocumento = $tipoDocumentoController->listar();

$jsModulo = 'certificaciones';

$tituloPagina = 'Certificaciones';

$controller = new CertificacionController();
$personaController = new PersonaController();
$objetoController = new ObjetoLegalizacionController();
$estadoController = new EstadoController();

$certificaciones = $controller->listar();
$personas = $personaController->listar();
$objetos = $objetoController->listar();
$estados = $estadoController->listar();

require_once '../../layouts/navbar.php';

?>

<main class="p-4 md:p-6">

    <div class="mb-4">

        <button
            onclick="abrirModal('modalCrearCertificacion')"
            class="btn-primary px-4 py-2 rounded-lg inline-flex items-center gap-2">

            <i class="fa-solid fa-plus"></i>

            <span>Nueva Certificación</span>

        </button>

    </div>

    <div class="card p-4 overflow-x-auto">

        <div id="tablaCertificaciones"></div>

    </div>

</main>

<!-- ========================================= -->
<!-- MODAL CREAR -->
<!-- ========================================= -->

<div
    id="modalCrearCertificacion"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">

    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl p-6 max-h-[90vh] overflow-y-auto">

        <div class="flex justify-between items-center mb-5">

            <h3 class="text-xl font-semibold text-[#3E2723]">

                Nueva Certificación

            </h3>

            <button
                type="button"
                onclick="cerrarModal('modalCrearCertificacion')">

                <i class="fa-solid fa-xmark text-xl"></i>

            </button>

        </div>

        <form
            id="formCrearCertificacion"
            method="POST"
            action="<?= BASE_URL ?>/actions/certificaciones/certificacion_store.php"
            class="space-y-4">

            <div>
                <label class="block mb-1.5 font-medium">Buscar Persona por Documento</label>

                <input type="hidden" id="persona_id" name="persona_id">

                <div class="flex gap-2">
                    <input type="text" id="buscar_numero_documento" class="w-full border rounded-lg px-3 py-2" placeholder="Ingrese DNI/RUC/CE/Pasaporte">

                    <button type="button" onclick="CertificacionForm.buscarPersona()" class="bg-[#3E2723] text-white px-4 py-2 rounded-lg">
                        <i class="fa-solid fa-search"></i>
                    </button>

                    <button type="button" onclick="abrirModal('modalCrearPersonaRapida')" class="bg-[#C9A227] text-white px-4 py-2 rounded-lg">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <div id="personaSeleccionada" class="hidden mt-3 bg-green-50 border border-green-200 text-green-700 rounded-lg p-3 text-sm"></div>
            </div>

            <div>

                <label class="block mb-1.5 font-medium">

                    Objeto de Legalización

                </label>

                <select
                    name="objeto_legalizacion_id"
                    required
                    class="w-full border rounded-lg px-3 py-2">

                    <option value="">Seleccione...</option>

                    <?php foreach ($objetos as $objeto): ?>

                        <option value="<?= $objeto['id'] ?>">

                            <?= htmlspecialchars($objeto['descripcion']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div>

                <label class="block mb-1.5 font-medium">

                    Estado

                </label>

                <select
                    name="estado_id"
                    required
                    class="w-full border rounded-lg px-3 py-2">

                    <?php foreach ($estados as $estado): ?>

                        <option value="<?= $estado['id'] ?>">

                            <?= htmlspecialchars($estado['descripcion']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div>

                <label class="block mb-1.5 font-medium">

                    Observaciones

                </label>

                <textarea
                    name="observaciones"
                    rows="4"
                    class="w-full border rounded-lg px-3 py-2"></textarea>

            </div>

            <div class="flex justify-end gap-2">

                <button
                    type="button"
                    onclick="cerrarModal('modalCrearCertificacion')"
                    class="px-4 py-2 border rounded-lg">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="bg-[#C9A227] hover:bg-[#b38f1f] text-white px-4 py-2 rounded-lg">

                    Guardar

                </button>

            </div>

        </form>

    </div>

</div>

<!-- ========================================= -->
<!-- MODAL CREAR PERSONA RAPDIDA -->
<!-- ========================================= -->
<div id="modalCrearPersonaRapida" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[60] p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 max-h-[90vh] overflow-y-auto">

        <div class="flex justify-between items-center mb-5">
            <h3 class="text-xl font-semibold text-[#3E2723]">Registrar Persona</h3>
            <button type="button" onclick="cerrarModal('modalCrearPersonaRapida')"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>

        <form id="formCrearPersonaRapida" class="space-y-4">

            <div>
                <label class="block mb-1.5 font-medium">Tipo de Documento</label>
                <select name="tipo_documento_id" required class="w-full border rounded-lg px-3 py-2">
                    <option value="">Seleccione...</option>
                    <?php foreach ($tiposDocumento as $tipoDocumento): ?>
                        <option value="<?= $tipoDocumento['id'] ?>"><?= htmlspecialchars($tipoDocumento['descripcion']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block mb-1.5 font-medium">Número de Documento</label>
                <input type="text" name="numero_documento" required class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block mb-1.5 font-medium">Nombres</label>
                <input type="text" name="nombres" required class="w-full border rounded-lg px-3 py-2">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1.5 font-medium">Apellido Paterno</label>
                    <input type="text" name="ap_paterno" required class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1.5 font-medium">Apellido Materno</label>
                    <input type="text" name="ap_materno" required class="w-full border rounded-lg px-3 py-2">
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="cerrarModal('modalCrearPersonaRapida')" class="px-4 py-2 border rounded-lg">Cancelar</button>
                <button type="submit" class="bg-[#C9A227] text-white px-4 py-2 rounded-lg">Guardar Persona</button>
            </div>

        </form>
    </div>
</div>

<!-- ========================================= -->
<!-- MODAL EDITAR -->
<!-- ========================================= -->

<div
    id="modalEditarCertificacion"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">

    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl p-6 max-h-[90vh] overflow-y-auto">

        <div class="flex justify-between items-center mb-5">

            <h3 class="text-xl font-semibold text-[#3E2723]">

                Editar Certificación

            </h3>

            <button
                type="button"
                onclick="cerrarModal('modalEditarCertificacion')">

                <i class="fa-solid fa-xmark text-xl"></i>

            </button>

        </div>

        <form
            id="formEditarCertificacion"
            method="POST"
            action="<?= BASE_URL ?>/actions/certificaciones/certificacion_update.php"
            class="space-y-4">

            <input
                type="hidden"
                id="edit_id"
                name="id">

            <div>

                <label class="block mb-1.5 font-medium">

                    Persona

                </label>

                <select
                    id="edit_persona_id"
                    name="persona_id"
                    required
                    class="w-full border rounded-lg px-3 py-2">

                    <option value="">Seleccione una persona</option>

                    <?php foreach ($personas as $persona): ?>

                        <option value="<?= $persona['id'] ?>">

                            <?= htmlspecialchars(
                                $persona['numero_documento'] . ' - ' .
                                    $persona['ap_paterno'] . ' ' .
                                    $persona['ap_materno'] . ', ' .
                                    $persona['nombres']
                            ) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div>

                <label class="block mb-1.5 font-medium">

                    Objeto de Legalización

                </label>

                <select
                    id="edit_objeto_legalizacion_id"
                    name="objeto_legalizacion_id"
                    required
                    class="w-full border rounded-lg px-3 py-2">

                    <option value="">Seleccione...</option>

                    <?php foreach ($objetos as $objeto): ?>

                        <option value="<?= $objeto['id'] ?>">

                            <?= htmlspecialchars($objeto['descripcion']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div>

                <label class="block mb-1.5 font-medium">

                    Estado

                </label>

                <select
                    id="edit_estado_id"
                    name="estado_id"
                    required
                    class="w-full border rounded-lg px-3 py-2">

                    <?php foreach ($estados as $estado): ?>

                        <option value="<?= $estado['id'] ?>">

                            <?= htmlspecialchars($estado['descripcion']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div>

                <label class="block mb-1.5 font-medium">

                    Observaciones

                </label>

                <textarea
                    id="edit_observaciones"
                    name="observaciones"
                    rows="4"
                    class="w-full border rounded-lg px-3 py-2"></textarea>

            </div>

            <div class="flex justify-end gap-2">

                <button
                    type="button"
                    onclick="cerrarModal('modalEditarCertificacion')"
                    class="px-4 py-2 border rounded-lg">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="bg-[#C9A227] hover:bg-[#b38f1f] text-white px-4 py-2 rounded-lg">

                    Actualizar

                </button>

            </div>

        </form>

    </div>

</div>

<script>

const certificaciones =
<?= json_encode($certificaciones); ?>;

</script>

<?php require_once '../../layouts/footer.php'; ?>
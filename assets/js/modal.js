// ======================================================
// MODALES
// ======================================================
function abrirModal(idModal) {
    const modal = document.getElementById(idModal);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function cerrarModal(idModal) {
    const modal = document.getElementById(idModal);
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

function abrirModalEditar(id, nombre, descripcion) {

    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nombre').value = nombre;
    document.getElementById('edit_descripcion').value = descripcion;

    abrirModal('modalEditarRol');
}


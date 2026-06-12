// Abrir modal
function abrirModal(idModal) {
    const modal = document.getElementById(idModal);

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// Cerrar modal
function cerrarModal(idModal) {
    const modal = document.getElementById(idModal);

    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

// Abrir modal de edición de rol
function abrirModalEditar(id, nombre, descripcion) {

    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nombre').value = nombre;
    document.getElementById('edit_descripcion').value = descripcion;

    abrirModal('modalEditarRol');
}

// Mostrar/Ocultar menú lateral
document.addEventListener('DOMContentLoaded', function () {

    const btnToggle = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    if (btnToggle && sidebar) {

        btnToggle.addEventListener('click', function () {

            sidebar.classList.toggle('hidden');

        });

    }

});
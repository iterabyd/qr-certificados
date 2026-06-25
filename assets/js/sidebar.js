// ======================================================
// SIDEBAR: abrir/cerrar en móvil + colapsar en desktop
// (único bloque - antes había listeners duplicados)
// ======================================================
document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const mobileBtn = document.getElementById('mobileMenu');
    const toggleBtn = document.getElementById('toggleSidebar');

    if (!sidebar) return;

    function abrirSidebarMovil() {
        sidebar.classList.remove('-translate-x-full');
        if (overlay) overlay.classList.remove('hidden');
    }

    function cerrarSidebarMovil() {
        sidebar.classList.add('-translate-x-full');
        if (overlay) overlay.classList.add('hidden');
    }

    if (mobileBtn) {
        mobileBtn.addEventListener('click', abrirSidebarMovil);
    }

    if (overlay) {
        overlay.addEventListener('click', cerrarSidebarMovil);
    }

    // Colapsar/expandir sidebar SOLO en desktop
    if (toggleBtn) {

        toggleBtn.addEventListener('click', function () {

            if (window.innerWidth >= 768) {
                sidebar.classList.toggle('sidebar-collapsed');
            }
        });
    }

    // Si la pantalla cambia de tamaño, aseguramos un estado coherente
    window.addEventListener('resize', function () {

        if (window.innerWidth >= 768) {
            // En desktop el sidebar siempre visible, sin clase de móvil
            sidebar.classList.remove('-translate-x-full');
            if (overlay) overlay.classList.add('hidden');
        } else {
            // Al volver a móvil, quitamos el colapsado de desktop
            sidebar.classList.remove('sidebar-collapsed');
        }
    });

});


function abrirModalEditarUsuario(id, rol_id, usuario, nombres, ap_paterno, ap_materno, email) {

    document.getElementById('edit_id').value = id;
    document.getElementById('edit_rol_id').value = rol_id;
    document.getElementById('edit_usuario').value = usuario;
    document.getElementById('edit_nombres').value = nombres;
    document.getElementById('edit_ap_paterno').value = ap_paterno;
    document.getElementById('edit_ap_materno').value = ap_materno;
    document.getElementById('edit_email').value = email;

    abrirModal('modalEditarUsuario');
}

function abrirModalPassword(id) {

    document.getElementById('password_id').value = id;

    abrirModal('modalPasswordUsuario');
}
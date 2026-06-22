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

// ======================================================
// TABLA ROLES GRID.JS
// ======================================================
document.addEventListener('DOMContentLoaded', function () {

    const tablaRoles = document.getElementById('tablaRoles');

    if (!tablaRoles || typeof roles === 'undefined') {
        return;
    }

    new gridjs.Grid({

        columns: [

            {
                name: 'ID',
                width: '80px'
            },

            {
                name: 'Nombre'
            },

            {
                name: 'Descripción'
            },

            {
                name: 'Estado',
                formatter: (_, row) => {

                    if (row.cells[3].data == 1) {

                        return gridjs.html(`
                            <span class="badge-active px-2 py-1 rounded">
                                Activo
                            </span>
                        `);

                    }

                    return gridjs.html(`
                        <span class="badge-inactive px-2 py-1 rounded">
                            Inactivo
                        </span>
                    `);
                }
            },

            {
                name: 'Acciones',
                formatter: (_, row) => {

                    const id = row.cells[0].data;
                    const nombre = row.cells[1].data;
                    const descripcion = row.cells[2].data;
                    const estado = row.cells[3].data;

                    let botones = `
                        <button
                            onclick="abrirModalEditar(
                                '${id}',
                                '${nombre}',
                                '${descripcion}'
                            )"
                            class="text-blue-600 hover:text-blue-800 mr-3">
                            Editar
                        </button>
                    `;

                    if (estado == 1) {

                        botones += `
                            <a
                                href="${BASE_URL}/actions/rol_estado.php?id=${id}&estado=0"
                                class="text-red-600 hover:text-red-800">
                                Inactivar
                            </a>
                        `;

                    } else {

                        botones += `
                            <a
                                href="${BASE_URL}/actions/rol_estado.php?id=${id}&estado=1"
                                class="text-green-600 hover:text-green-800">
                                Activar
                            </a>
                        `;
                    }

                    return gridjs.html(botones);
                }
            }

        ],

        data: roles.map(rol => [

            rol.id,
            rol.nombre,
            rol.descripcion,
            rol.estado

        ]),

        search: true,

        sort: true,

        pagination: {
            limit: 10
        },

        language: {

            search: {
                placeholder: 'Buscar...'
            },

            pagination: {
                previous: 'Anterior',
                next: 'Siguiente',
                showing: 'Mostrando',
                results: () => 'registros'
            }

        }

    }).render(tablaRoles);

});

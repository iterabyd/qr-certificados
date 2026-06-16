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

// Mostrar/Ocultar sidebar
document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('toggleSidebar');

    if (!sidebar || !toggle) return;

    toggle.addEventListener('click', function () {

        sidebar.classList.toggle('sidebar-collapsed');

    });

});


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
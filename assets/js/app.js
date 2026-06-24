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

// ======================================================
// TABLA USUARIOS GRID.JS
// ======================================================
document.addEventListener('DOMContentLoaded', function () {

    const tablaUsuarios = document.getElementById('tablaUsuarios');

    if (!tablaUsuarios || typeof usuarios === 'undefined') {
        return;
    }

    new gridjs.Grid({

        columns: [

            {
                name: 'ID',
                width: '60px'
            },

            {
                name: 'Rol ID',
                hidden: true
            },

            {
                name: 'Usuario'
            },

            {
                name: 'Nombres',
                formatter: (_, row) => {
                    const nombres = row.cells[3].data;
                    const apPaterno = row.cells[4].data;
                    const apMaterno = row.cells[5].data;
                    return `${nombres} ${apPaterno} ${apMaterno}`;
                }
            },

            {
                name: 'Email'
            },

            {
                name: 'Rol'
            },

            {
                name: 'Estado',
                formatter: (_, row) => {

                    if (row.cells[9].data == 1) {

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
                    const rolId = row.cells[1].data;
                    const usuario = row.cells[2].data;
                    const nombres = row.cells[3].data;
                    const apPaterno = row.cells[4].data;
                    const apMaterno = row.cells[5].data;
                    const email = row.cells[6].data;
                    const estado = row.cells[9].data;

                    let botones = `
                        <button
                            onclick="abrirModalEditarUsuario(
                                '${id}',
                                '${rolId}',
                                '${usuario}',
                                '${nombres}',
                                '${apPaterno}',
                                '${apMaterno}',
                                '${email}'
                            )"
                            class="text-blue-600 hover:text-blue-800 mr-3">
                            Editar
                        </button>

                        <button
                            onclick="abrirModalPassword('${id}')"
                            class="text-amber-600 hover:text-amber-800 mr-3">
                            Contraseña
                        </button>
                    `;

                    if (estado == 1) {

                        botones += `
                            <a
                                href="${BASE_URL}/actions/usuarios/usuario_estado.php?id=${id}&estado=0"
                                class="text-red-600 hover:text-red-800">
                                Inactivar
                            </a>
                        `;

                    } else {

                        botones += `
                            <a
                                href="${BASE_URL}/actions/usuarios/usuario_estado.php?id=${id}&estado=1"
                                class="text-green-600 hover:text-green-800">
                                Activar
                            </a>
                        `;
                    }

                    return gridjs.html(botones);
                }
            }

        ],

        data: usuarios.map(u => [

            u.id,
            u.rol_id,
            u.usuario,
            u.nombres,
            u.ap_paterno,
            u.ap_materno,
            u.email,
            u.rol,
            u.rol,
            u.estado

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

    }).render(tablaUsuarios);

});
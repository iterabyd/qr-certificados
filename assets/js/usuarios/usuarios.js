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
                name: 'Ap. Paterno',
                hidden: true
            },

            {
                name: 'Ap. Materno',
                hidden: true
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

                    if (row.cells[8].data == 1) {

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
                    const estado = row.cells[8].data;

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
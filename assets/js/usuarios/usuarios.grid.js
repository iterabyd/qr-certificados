const UsuarioGrid = {

    grid: null,

    render(usuarios) {

        const contenedor = document.getElementById('tablaUsuarios');

        if (!contenedor) return;

        if (this.grid) {
            this.grid.destroy();
            contenedor.innerHTML = '';
        }

        this.grid = new gridjs.Grid({

            columns: [

                { name: 'ID', width: '60px' },
                { name: 'Rol ID', hidden: true },
                { name: 'Rol' },
                { name: 'Usuario' },

                {
                    name: 'Nombres',
                    formatter: (_, row) =>
                        `${row.cells[4].data} ${row.cells[5].data} ${row.cells[6].data}`
                },

                { name: 'Ap. Paterno', hidden: true },
                { name: 'Ap. Materno', hidden: true },
                { name: 'Email' },

                {
                    name: 'Estado',
                    formatter: (_, row) => {

                        const estado = row.cells[8].data;

                        return estado == 1
                            ? gridjs.html('<span class="px-2 py-1 rounded-full bg-green-100 text-green-700">Activo</span>')
                            : gridjs.html('<span class="px-2 py-1 rounded-full bg-red-100 text-red-700">Inactivo</span>');
                    }
                },

                {
                    name: 'Acciones',

                    formatter: (_, row) => {

                        const id = row.cells[0].data;
                        const rolId = row.cells[1].data;
                        const usuario = row.cells[3].data;
                        const nombres = row.cells[4].data;
                        const apPaterno = row.cells[5].data;
                        const apMaterno = row.cells[6].data;
                        const email = row.cells[7].data;
                        const estado = row.cells[8].data;

                        const textoEstado = estado == 1 ? 'Inactivar' : 'Activar';
                        const nuevoEstado = estado == 1 ? 0 : 1;

                        return gridjs.html(`

                            <button
                                class="text-blue-600 hover:text-blue-800 mr-3"
                                onclick="abrirModalEditarUsuario('${id}','${rolId}','${usuario}','${nombres}','${apPaterno}','${apMaterno}','${email}')">
                                <i class="fa-solid fa-pen"></i> Editar
                            </button>

                            <button
                                class="text-yellow-600 hover:text-yellow-800 mr-3"
                                onclick="abrirModalPassword('${id}')">
                                <i class="fa-solid fa-key"></i> Contraseña
                            </button>

                            <button
                                class="text-red-600 hover:text-red-800"
                                onclick="UsuarioForm.cambiarEstado('${id}','${nuevoEstado}')">
                                <i class="fa-solid fa-power-off"></i> ${textoEstado}
                            </button>

                        `);

                    }

                }

            ],

            data: usuarios.map(usuario => [

                usuario.id,
                usuario.rol_id,
                usuario.rol,
                usuario.usuario,
                usuario.nombres,
                usuario.ap_paterno,
                usuario.ap_materno,
                usuario.email,
                usuario.estado

            ]),

            search: true,
            sort: true,
            pagination: { limit: 10 },

            language: {

                search: { placeholder: 'Buscar...' },

                pagination: {
                    previous: 'Anterior',
                    next: 'Siguiente',
                    showing: 'Mostrando',
                    to: 'a',
                    of: 'de',
                    results: () => 'registros'
                }

            }

        });

        this.grid.render(contenedor);

    }

};
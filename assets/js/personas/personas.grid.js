const PersonaGrid = {

    grid: null,

    render(personas) {

        const contenedor = document.getElementById('tablaPersonas');

        if (!contenedor) {
            return;
        }

        // Destruir la tabla anterior
        if (this.grid) {
            this.grid.destroy();
            contenedor.innerHTML = '';
        }

        this.grid = new gridjs.Grid({

            columns: [

                {
                    name: 'ID',
                    width: '60px'
                },

                {
                    name: 'Tipo Documento ID',
                    hidden: true
                },

                {
                    name: 'Tipo Documento'
                },

                {
                    name: 'Número Documento'
                },

                {
                    name: 'Nombres',
                    formatter: (_, row) => {

                        return `${row.cells[4].data} ${row.cells[5].data} ${row.cells[6].data}`;

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
                name: 'Estado',

                formatter: (_, row) => {

                    const estado = row.cells[7].data;

                    if (estado == 1) {

                        return gridjs.html(`
                            <span class="px-2 py-1 rounded-full bg-green-100 text-green-700">
                                Activo
                            </span>
                        `);

                    }

                    return gridjs.html(`
                        <span class="px-2 py-1 rounded-full bg-red-100 text-red-700">
                            Inactivo
                        </span>
                    `);

                }

            },
            {
                    name: 'Acciones',

                    formatter: (_, row) => {

                        const id = row.cells[0].data;
                        const tipoDocumentoId = row.cells[1].data;
                        const codigo = row.cells[2].data;
                        const numeroDocumento = row.cells[3].data;
                        const nombres = row.cells[4].data;
                        const apPaterno = row.cells[5].data;
                        const apMaterno = row.cells[6].data;
                        const estado = row.cells[7].data;   

                        const textoEstado = estado == 1
                            ? 'Inactivar'
                            : 'Activar';

                        const nuevoEstado = estado == 1
                            ? 0
                            : 1;

                        return gridjs.html(`

                            <button
                                type="button"
                                class="text-blue-600 hover:text-blue-800 mr-3"
                                onclick="abrirModalEditarPersona(
                                    '${id}',
                                    '${tipoDocumentoId}',
                                    '${codigo}',
                                    '${numeroDocumento}',
                                    '${nombres}',
                                    '${apPaterno}',
                                    '${apMaterno}'
                                )">

                                <i class="fa-solid fa-pen"></i>
                                Editar

                            </button>
                            <button
                                type="button"
                                class="text-red-600 hover:text-red-800"
                                onclick="PersonaForm.cambiarEstado('${id}', '${nuevoEstado}')">
                                ${textoEstado}
                            </button>                        

                            `);

                    }

                }

            ],

            data: personas.map(persona => [

                persona.id,
                persona.tipo_documento_id,
                persona.codigo,
                persona.numero_documento,
                persona.nombres,
                persona.ap_paterno,
                persona.ap_materno,
                persona.estado

            ]),

            search: true,

            sort: true,

            pagination: {
                limit: 5
            },

            language: {

                search: {
                    placeholder: 'Buscar...'
                },

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
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
                    name: 'Acciones',

                    formatter: (_, row) => {

                        const id = row.cells[0].data;
                        const tipoDocumentoId = row.cells[1].data;
                        const codigo = row.cells[2].data;
                        const numeroDocumento = row.cells[3].data;
                        const nombres = row.cells[4].data;
                        const apPaterno = row.cells[5].data;
                        const apMaterno = row.cells[6].data;

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
                persona.ap_materno

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
                    to: 'a',
                    of: 'de',

                    results: () => 'registros'

                }

            }

        });

        this.grid.render(contenedor);

    }

};
// ======================================================
// TABLA USUARIOS GRID.JS
// ======================================================
document.addEventListener('DOMContentLoaded', function () {

    const tablaPersonas = document.getElementById('tablaPersonas');

    if (!tablaPersonas || typeof personas === 'undefined') {
        return;
    }

    new gridjs.Grid({

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
                name: 'Numero Documento'
            },

            {
                name: 'Nombres',
                formatter: (_, row) => {
                    const nombres = row.cells[4].data;
                    const apPaterno = row.cells[5].data;
                    const apMaterno = row.cells[6].data;
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
                name: 'Acciones',
                formatter: (_, row) => {

                    const id = row.cells[0].data;
                    const tipoDocumentoId = row.cells[1].data;
                    const codigo = row.cells[2].data;
                    const numeroDocumento = row.cells[3].data;
                    const nombres = row.cells[4].data;
                    const apPaterno = row.cells[5].data;
                    const apMaterno = row.cells[6].data;

                    let botones = `
                        <button
                            onclick="abrirModalEditarPersona(
                                '${id}',
                                '${tipoDocumentoId}',
                                '${codigo}',
                                '${numeroDocumento}',
                                '${nombres}',
                                '${apPaterno}',
                                '${apMaterno}',aa
                            )"
                            class="text-blue-600 hover:text-blue-800 mr-3">
                            Editar
                        </button>  `;

                    return gridjs.html(botones);
                }
            }

        ],

        data: personas.map(u => [

            u.id,
            u.tipo_documento_id,
            u.codigo,
            u.numero_documento,
            u.nombres,
            u.ap_paterno,
            u.ap_materno,

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
                to: 'de',
                of: 'de',
                results: () => 'registros'
            }

        }

    }).render(tablaPersonas);

});
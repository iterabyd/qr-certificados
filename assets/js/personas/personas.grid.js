// ======================================================
// GRID PERSONAS
// ======================================================

let gridPersonas = null;

async function iniciarTablaPersonas() {

    const personas = await obtenerPersonas();

    renderizarTablaPersonas(personas);

}

function renderizarTablaPersonas(personas) {

    const tabla = document.getElementById("tablaPersonas");

    if (!tabla)
        return;

    if (gridPersonas) {

        tabla.innerHTML = "";

    }

    gridPersonas = new gridjs.Grid({

        columns: [

            {
                name: "ID",
                width: "60px"
            },

            {
                name: "Tipo Documento ID",
                hidden: true
            },

            {
                name: "Tipo Documento"
            },

            {
                name: "Número Documento"
            },

            {
                name: "Nombres",

                formatter: (_, row) => {

                    return `${row.cells[4].data} ${row.cells[5].data} ${row.cells[6].data}`;

                }

            },

            {
                name: "Ap. Paterno",
                hidden: true
            },

            {
                name: "Ap. Materno",
                hidden: true
            },

            {
                name: "Acciones",

                formatter: (_, row) => {

                    return gridjs.html(`
                        <button
                            class="text-blue-600 hover:text-blue-800">
                            Editar
                        </button>
                    `);

                }

            }

        ],

        data: personas.map(p => [

            p.id,
            p.tipo_documento_id,
            p.codigo,
            p.numero_documento,
            p.nombres,
            p.ap_paterno,
            p.ap_materno

        ]),

        search: true,

        sort: true,

        pagination: {

            limit: 10

        }

    });

    gridPersonas.render(tabla);

}
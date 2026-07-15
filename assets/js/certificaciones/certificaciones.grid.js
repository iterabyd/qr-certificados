const CertificacionGrid = {

    grid: null,

    render(certificaciones) {

        const contenedor = document.getElementById('tablaCertificaciones');

        if (!contenedor) return;

        if (this.grid) {
            this.grid.destroy();
            contenedor.innerHTML = '';
        }

        this.grid = new gridjs.Grid({

            columns: [

                { name: 'ID', hidden: true },
                { name: 'Persona ID', hidden: true },
                { name: 'Objeto ID', hidden: true },
                { name: 'Estado ID', hidden: true },
                { name: 'Token QR', hidden: true },
                { name: 'Observaciones', hidden: true },

                {
                    name: 'N° Certificación',
                    width: '180px'
                },

                {
                    name: 'Documento',
                    width: '140px'
                },

                {
                    name: 'Persona',
                    width: '220px',
                    formatter: (_, row) => {
                        const nombres = row.cells[8].data ?? '';
                        const apPaterno = row.cells[9].data ?? '';
                        const apMaterno = row.cells[10].data ?? '';
                        return `${nombres} ${apPaterno} ${apMaterno}`;
                    }
                },

                { name: 'Nombres', hidden: true },
                { name: 'Ap. Paterno', hidden: true },
                { name: 'Ap. Materno', hidden: true },

                {
                    name: 'Objeto',
                    width: '220px'
                },

                {
                    name: 'Estado',
                    width: '130px',
                    formatter: (_, row) => {
                        const estadoId = row.cells[3].data;

                        if (estadoId == 1) {
                            return gridjs.html('<span class="px-3 py-1 rounded-full bg-green-100 text-green-700">Activo</span>');
                        }

                        return gridjs.html('<span class="px-3 py-1 rounded-full bg-red-100 text-red-700">Inactivo</span>');
                    }
                },

                {
                    name: 'Fecha',
                    width: '170px',
                    formatter: (_, row) => {
                        return row.cells[13].data ?? '';
                    }
                },

                {
                    name: 'Acciones',
                    width: '180px',
                    formatter: (_, row) => {

                        const id = row.cells[0].data;
                        const personaId = row.cells[1].data;
                        const objetoId = row.cells[2].data;
                        const estadoId = row.cells[3].data;
                        const tokenQr = row.cells[4].data;
                        const observaciones = row.cells[5].data ?? '';

                        const nuevoEstado = estadoId == 1 ? 2 : 1;
                        const textoEstado = estadoId == 1 ? 'Inactivar' : 'Activar';
                        const claseEstado = estadoId == 1 ? 'text-red-600 hover:text-red-800' : 'text-green-600 hover:text-green-800';
                        const iconoEstado = estadoId == 1 ? 'fa-power-off' : 'fa-circle-check';

                        return gridjs.html(`

                            <div class="flex items-center gap-3">

                                <button
                                    type="button"
                                    class="text-blue-600 hover:text-blue-800"
                                    title="Editar"
                                    onclick="abrirModalEditarCertificacion('${id}','${personaId}','${objetoId}','${estadoId}', \`${observaciones}\`)">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <button
                                    type="button"
                                    class="text-purple-600 hover:text-purple-800"
                                    title="Ver QR"
                                    onclick="verQr('${tokenQr}')">
                                    <i class="fa-solid fa-qrcode"></i>
                                </button>

                                <button
                                    type="button"
                                    class="${claseEstado}"
                                    title="${textoEstado}"
                                    onclick="CertificacionForm.cambiarEstado('${id}','${nuevoEstado}')">
                                    <i class="fa-solid ${iconoEstado}"></i>
                                </button>

                            </div>

                        `);
                    }
                }

            ],

            data: certificaciones.map(c => [

                c.id,
                c.persona_id,
                c.objeto_legalizacion_id,
                c.estado_id,
                c.token_qr,
                c.observaciones,
                c.numero_certificacion,
                c.numero_documento,
                c.nombres,
                c.ap_paterno,
                c.ap_materno,
                c.objeto,
                c.estado,
                c.fecha_registro,
                null

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
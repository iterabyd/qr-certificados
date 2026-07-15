const CertificacionForm = {

    init() {

        const formCrear = document.getElementById('formCrearCertificacion');
        const formEditar = document.getElementById('formEditarCertificacion');

        const formPersonaRapida = document.getElementById('formCrearPersonaRapida');

        if (formCrear) {
            formCrear.addEventListener('submit', this.guardar);
        }

        if (formEditar) {
            formEditar.addEventListener('submit', this.actualizar);
        }

        if (formPersonaRapida) {
            formPersonaRapida.addEventListener('submit', this.guardarPersonaRapida);
        }

    },

    async guardar(e) {

        e.preventDefault();

        const form = e.target;

        const validacion = CertificacionValidation.validar(form);

        if (!validacion.success) {

            Swal.fire({
                icon: 'warning',
                title: 'Validación',
                text: validacion.message,
                confirmButtonColor: '#C9A227'
            });

            return;

        }

        const respuesta = await CertificacionService.guardar(
            new FormData(form)
        );

        if (!respuesta.success) {

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: respuesta.message,
                confirmButtonColor: '#C9A227'
            });

            return;

        }

        Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: respuesta.message,
            confirmButtonColor: '#C9A227'
        });

        cerrarModal('modalCrearCertificacion');

        form.reset();

        await CertificacionApp.cargar();

    },

    async actualizar(e) {

        e.preventDefault();

        const form = e.target;

        const validacion = CertificacionValidation.validar(form);

        if (!validacion.success) {

            Swal.fire({
                icon: 'warning',
                title: 'Validación',
                text: validacion.message,
                confirmButtonColor: '#C9A227'
            });

            return;

        }

        const respuesta = await CertificacionService.actualizar(
            new FormData(form)
        );

        if (!respuesta.success) {

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: respuesta.message,
                confirmButtonColor: '#C9A227'
            });

            return;

        }

        Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: respuesta.message,
            confirmButtonColor: '#C9A227'
        });

        cerrarModal('modalEditarCertificacion');

        await CertificacionApp.cargar();

    },

    async cambiarEstado(id, estado_id) {

        const accion = estado_id == 1 ? 'activar' : 'inactivar';

        const confirmar = await Swal.fire({

            title: `¿Desea ${accion} esta certificación?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#C9A227'

        });

        if (!confirmar.isConfirmed) return;

        const respuesta = await CertificacionService.cambiarEstado(
            id,
            estado_id
        );

        if (!respuesta.success) {

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: respuesta.message,
                confirmButtonColor: '#C9A227'
            });

            return;

        }

        Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: respuesta.message,
            confirmButtonColor: '#C9A227'
        });

        await CertificacionApp.cargar();

    },
    async buscarPersona() {
        const documento = document.getElementById('buscar_numero_documento').value.trim();

        if (!documento) {
            Swal.fire({ icon: 'warning', title: 'Validación', text: 'Ingrese un número de documento.', confirmButtonColor: '#C9A227' });
            return;
        }

        const respuesta = await fetch(BASE_URL + '/actions/personas/persona_buscar_documento.php?numero_documento=' + encodeURIComponent(documento));
        const resultado = await respuesta.json();

        if (!resultado.success) {
            document.getElementById('persona_id').value = '';
            document.getElementById('personaSeleccionada').classList.add('hidden');

            Swal.fire({ icon: 'warning', title: 'Persona no encontrada', text: 'Puede registrarla con el botón +.', confirmButtonColor: '#C9A227' });
            return;
        }

        this.seleccionarPersona(resultado.data);
    },

    seleccionarPersona(persona) {
        document.getElementById('persona_id').value = persona.id;

        const contenedor = document.getElementById('personaSeleccionada');

        contenedor.innerHTML = `
            <strong>Persona seleccionada:</strong><br>
            ${persona.codigo} ${persona.numero_documento} - ${persona.ap_paterno} ${persona.ap_materno}, ${persona.nombres}
        `;

        contenedor.classList.remove('hidden');
    },
    async guardarPersonaRapida(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        const respuesta = await fetch(BASE_URL + '/actions/personas/persona_store.php', {
            method: 'POST',
            body: formData
        });

        const resultado = await respuesta.json();

        if (!resultado.success) {
            Swal.fire({ icon: 'error', title: 'Error', text: resultado.message, confirmButtonColor: '#C9A227' });
            return;
        }

        const documento = form.numero_documento.value.trim();

        Swal.fire({ icon: 'success', title: 'Correcto', text: resultado.message, confirmButtonColor: '#C9A227' });

        cerrarModal('modalCrearPersonaRapida');

        form.reset();

        document.getElementById('buscar_numero_documento').value = documento;

        await CertificacionForm.buscarPersona();
    }

};

function abrirModalEditarCertificacion(
    id,
    personaId,
    objetoId,
    estadoId,
    observaciones
) {

    document.getElementById('edit_id').value = id;

    document.getElementById('edit_persona_id').value = personaId;

    document.getElementById('edit_objeto_legalizacion_id').value = objetoId;

    document.getElementById('edit_estado_id').value = estadoId;

    document.getElementById('edit_observaciones').value = observaciones;

    abrirModal('modalEditarCertificacion');

}

// Función para abrir la ventana del QR de una certificación
function verQr(tokenQr) {

    window.open(
        BASE_URL + '/views/certificaciones/qr.php?token=' + encodeURIComponent(tokenQr),
        '_blank'
    );

}


const PersonaForm = {

    init() {

        const formCrear = document.getElementById('formCrearPersona');

        if (formCrear) {

            formCrear.addEventListener(
                'submit',
                this.guardar
            );

        }

        const formEditar = document.getElementById('formEditarPersona');

        if (formEditar) {

            formEditar.addEventListener(
                'submit',
                this.actualizar
            );

        }

    },

    async guardar(e) {

        e.preventDefault();

        const form = e.target;

        // Validar formulario
        const validacion =
            PersonaValidation.validar(form);

        if (!validacion.success) {

            Swal.fire({
                icon: 'warning',
                title: 'Validación',
                text: validacion.message,
                confirmButtonColor: '#C9A227'
            });

            return;

        }

        // Enviar datos
        const formData =
            new FormData(form);

        const respuesta =
            await PersonaService.guardar(formData);

        if (respuesta.success) {

            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: respuesta.message,
                confirmButtonColor: '#C9A227'
            });

            cerrarModal('modalCrearPersona');

            form.reset();

            await PersonaApp.cargar();

            return;

        }

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: respuesta.message,
            confirmButtonColor: '#C9A227'
        });

    },

    async actualizar(e) {

        e.preventDefault();

        const form = e.target;

        const validacion =
            PersonaValidation.validar(form);

        if (!validacion.success) {

            Swal.fire({

                icon: 'warning',
                title: 'Validación',
                text: validacion.message,
                confirmButtonColor: '#C9A227'

            });

            return;

        }

        const formData =
            new FormData(form);

        const respuesta =
            await PersonaService.actualizar(formData);

        if (respuesta.success) {

            Swal.fire({

                icon: 'success',
                title: 'Correcto',
                text: respuesta.message,
                confirmButtonColor: '#C9A227'

            });

            cerrarModal('modalEditarPersona');

            await PersonaApp.cargar();

            return;

        }

        Swal.fire({

            icon: 'error',
            title: 'Error',
            text: respuesta.message,
            confirmButtonColor: '#C9A227'

        });

    },

    async cambiarEstado(id, estado) {

        const confirmar = await Swal.fire({

            title: estado == 1
                ? '¿Activar persona?'
                : '¿Inactivar persona?',

            text: estado == 1
                ? 'La persona volverá a estar disponible.'
                : 'La persona dejará de estar disponible.',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Sí',

            cancelButtonText: 'Cancelar',

            confirmButtonColor: '#C9A227'

        });

        if (!confirmar.isConfirmed) {
            return;
        }

        const respuesta =
            await PersonaService.cambiarEstado(
                id,
                estado
            );

        Swal.fire({

            icon: respuesta.success ? 'success' : 'error',

            title: respuesta.success ? 'Correcto' : 'Error',

            text: respuesta.message,

            confirmButtonColor: '#C9A227'

        });

        if (respuesta.success) {

            await PersonaApp.cargar();

        }

    }

};

function abrirModalEditarPersona(
    id,
    tipoDocumentoId,
    codigo,
    numeroDocumento,
    nombres,
    apPaterno,
    apMaterno
) {

    document.getElementById('edit_id').value = id;

    document.getElementById('edit_tipo_documento_id').value =
        tipoDocumentoId;

    document.getElementById('edit_numero_documento').value =
        numeroDocumento;

    document.getElementById('edit_nombres').value =
        nombres;

    document.getElementById('edit_ap_paterno').value =
        apPaterno;

    document.getElementById('edit_ap_materno').value =
        apMaterno;

    abrirModal('modalEditarPersona');

}
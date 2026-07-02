const UsuarioForm = {

    init() {

        const formCrear = document.getElementById('formCrearUsuario');
        const formEditar = document.getElementById('formEditarUsuario');
        const formPassword = document.getElementById('formPasswordUsuario');

        if (formCrear) {
            formCrear.addEventListener('submit', this.guardar);
        }

        if (formEditar) {
            formEditar.addEventListener('submit', this.actualizar);
        }

        if (formPassword) {
            formPassword.addEventListener('submit', this.actualizarPassword);
        }

    },

    async guardar(e) {

        e.preventDefault();

        const form = e.target;

        const validacion = UsuarioValidation.validar(form);

        if (!validacion.success) {

            Swal.fire({
                icon: 'warning',
                title: 'Validación',
                text: validacion.message,
                confirmButtonColor: '#C9A227'
            });

            return;
        }

        const respuesta = await UsuarioService.guardar(new FormData(form));

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

        cerrarModal('modalCrearUsuario');

        form.reset();

        await UsuarioApp.cargar();

    },

    async actualizar(e) {

        e.preventDefault();

        const form = e.target;

        const validacion = UsuarioValidation.validar(form);

        if (!validacion.success) {

            Swal.fire({
                icon: 'warning',
                title: 'Validación',
                text: validacion.message,
                confirmButtonColor: '#C9A227'
            });

            return;
        }

        const respuesta = await UsuarioService.actualizar(new FormData(form));

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

        cerrarModal('modalEditarUsuario');

        await UsuarioApp.cargar();

    },

    async actualizarPassword(e) {

        e.preventDefault();

        const form = e.target;

        const password = form.password.value.trim();

        if (password.length < 6) {

            Swal.fire({
                icon: 'warning',
                title: 'Validación',
                text: 'La contraseña debe tener al menos 6 caracteres.',
                confirmButtonColor: '#C9A227'
            });

            return;

        }

        const respuesta = await UsuarioService.actualizarPassword(new FormData(form));

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

        cerrarModal('modalPasswordUsuario');

        form.reset();

    },

    async cambiarEstado(id, estado) {

        const accion = estado == 1 ? 'activar' : 'inactivar';

        const confirmar = await Swal.fire({

            title: `¿Desea ${accion} este usuario?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#C9A227'

        });

        if (!confirmar.isConfirmed) return;

        const respuesta = await UsuarioService.cambiarEstado(id, estado);

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

        await UsuarioApp.cargar();

    }

};

function abrirModalEditarUsuario(
    id,
    rolId,
    usuario,
    nombres,
    apPaterno,
    apMaterno,
    email
){

    document.getElementById('edit_id').value = id;

    document.getElementById('edit_rol_id').value =
        rolId;

    document.getElementById('edit_usuario').value =
        usuario;

    document.getElementById('edit_nombres').value =
        nombres;

    document.getElementById('edit_ap_paterno').value =
        apPaterno;

    document.getElementById('edit_ap_materno').value =
        apMaterno;

    document.getElementById('edit_email').value =
        email;

    abrirModal(
        'modalEditarUsuario'
    );

}

function abrirModalPassword(id){

    document.getElementById(
        'password_id'
    ).value = id;

    document.getElementById(
        'password'
    ).value = '';

    abrirModal(
        'modalPasswordUsuario'
    );

}
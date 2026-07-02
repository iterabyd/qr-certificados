const UsuarioValidation = {

    validar(form) {

        const rol = form.rol_id.value.trim();
        const usuario = form.usuario.value.trim();
        const password = form.password?.value.trim();
        const nombres = form.nombres.value.trim();
        const apPaterno = form.ap_paterno.value.trim();
        const apMaterno = form.ap_materno.value.trim();
        const email = form.email.value.trim();

        if (rol === '') {
            return { success: false, message: 'Seleccione un rol.' };
        }

        if (usuario === '') {
            return { success: false, message: 'Ingrese el usuario.' };
        }

        if (usuario.length < 4) {
            return { success: false, message: 'El usuario debe tener al menos 4 caracteres.' };
        }

        // Solo obligatorio al crear
        if (form.id === undefined && password === '') {
            return { success: false, message: 'Ingrese una contraseña.' };
        }

        if (password && password.length < 6) {
            return { success: false, message: 'La contraseña debe tener al menos 6 caracteres.' };
        }

        if (nombres === '') {
            return { success: false, message: 'Ingrese los nombres.' };
        }

        if (apPaterno === '') {
            return { success: false, message: 'Ingrese el apellido paterno.' };
        }

        if (apMaterno === '') {
            return { success: false, message: 'Ingrese el apellido materno.' };
        }

        if (email === '') {
            return { success: false, message: 'Ingrese el correo electrónico.' };
        }

        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regexEmail.test(email)) {
            return { success: false, message: 'Ingrese un correo electrónico válido.' };
        }

        return { success: true };

    }

};
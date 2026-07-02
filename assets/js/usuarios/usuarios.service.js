const UsuarioService = {

    async obtenerTodos() {

        const respuesta = await fetch(
            BASE_URL + '/actions/usuarios/usuario_list.php'
        );

        return await respuesta.json();

    },

    async guardar(formData) {
        const respuesta = await fetch(
            BASE_URL + '/actions/usuarios/usuario_store.php',

            {

                method: 'POST',
                body: formData

            }

        );

        return await respuesta.json();

    },

    async actualizar(formData) {

        const respuesta = await fetch(

            BASE_URL + '/actions/usuarios/usuario_update.php',

            {

                method: 'POST',

                body: formData

            }

        );

        return await respuesta.json();

    },

    async actualizarPassword(formData) {

        const respuesta = await fetch(

            BASE_URL + '/actions/usuarios/usuario_password.php',

            {

                method: 'POST',

                body: formData

            }

        );

        return await respuesta.json();

    },

    async cambiarEstado(id, estado) {

        const formData = new FormData();

        formData.append('id', id);

        formData.append('estado', estado);

        const respuesta = await fetch(

            BASE_URL + '/actions/usuarios/usuario_estado.php',

            {

                method: 'POST',

                body: formData

            }

        );

        return await respuesta.json();

    }

};
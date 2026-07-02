const PersonaService = {

    /**
     * Obtener listado de personas
     */
    async listar() {

        try {

            const response = await fetch(
                BASE_URL + '/actions/personas/persona_list.php'
            );

            return await response.json();

        } catch (error) {

            console.error(error);

            return [];

        }

    },

    /**
     * Registrar persona
     */
    async guardar(formData) {

        try {

            const response = await fetch(
                BASE_URL + '/actions/personas/persona_store.php',
                {
                    method: 'POST',
                    body: formData
                }
            );

            return await response.json();

        } catch (error) {

            console.error(error);

            return {
                success: false,
                message: 'Ocurrió un error al guardar la persona.'
            };

        }

    },

    /**
     * Actualizar persona
     */
    async actualizar(formData) {

        const response = await fetch(

            BASE_URL + '/actions/personas/persona_update.php',

            {

                method: 'POST',

                body: formData

            }

        );

        return await response.json();

    },

    /**
     * Cambiar estado de persona
     */
    async cambiarEstado(id, estado) {

        const formData = new FormData();

        formData.append('id', id);

        formData.append('estado', estado);

        const response = await fetch(

            BASE_URL + '/actions/personas/persona_estado.php',

            {

                method: 'POST',

                body: formData

            }

        );

        return await response.json();

    }

};
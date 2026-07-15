const CertificacionService = {

    async obtenerTodos() {

        const respuesta = await fetch(

            BASE_URL + '/actions/certificaciones/certificacion_list.php'

        );

        return await respuesta.json();

    },

    async guardar(formData) {
    try {
        const respuesta = await fetch(BASE_URL + '/actions/certificaciones/certificacion_store.php', {
            method: 'POST',
            body: formData
        });

        const texto = await respuesta.text();
        //console.log(texto);

        return JSON.parse(texto);

    } catch (error) {
        console.error('Error guardar certificación:', error);

        return {
            success: false,
            message: 'No se pudo procesar la respuesta del servidor.'
        };
    }
},

    async actualizar(formData) {

        const respuesta = await fetch(

            BASE_URL + '/actions/certificaciones/certificacion_update.php',

            {

                method: 'POST',

                body: formData

            }

        );

        return await respuesta.json();

    },

    async cambiarEstado(id, estado_id) {

        const formData = new FormData();

        formData.append('id', id);
        formData.append('estado_id', estado_id);

        const respuesta = await fetch(

            BASE_URL + '/actions/certificaciones/certificacion_estado.php',

            {

                method: 'POST',

                body: formData

            }

        );

        return await respuesta.json();

    }

};
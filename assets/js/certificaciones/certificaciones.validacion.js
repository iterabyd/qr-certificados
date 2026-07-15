const CertificacionValidation = {

    validar(form) {

        if (!form.persona_id.value) {

            return {
                success: false,
                message: 'Seleccione una persona.'
            };

        }

        if (!form.objeto_legalizacion_id.value) {

            return {
                success: false,
                message: 'Seleccione el objeto de legalización.'
            };

        }

        if (!form.estado_id.value) {

            return {
                success: false,
                message: 'Seleccione el estado.'
            };

        }

        return {
            success: true
        };

    }

};
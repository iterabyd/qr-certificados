const PersonaValidation = {

    init() {

        const tipoDocumento = document.querySelector('[name="tipo_documento_id"]');
        const numeroDocumento = document.querySelector('[name="numero_documento"]');

        if (!tipoDocumento || !numeroDocumento) {
            return;
        }

        tipoDocumento.addEventListener('change', () => {

            numeroDocumento.value = '';

        });

        numeroDocumento.addEventListener('input', () => {

            const tipo = tipoDocumento.value;

            switch (tipo) {

                case '1': // DNI
                    numeroDocumento.value = numeroDocumento.value
                        .replace(/\D/g, '')
                        .slice(0, 8);
                    break;

                case '2': // RUC
                    numeroDocumento.value = numeroDocumento.value
                        .replace(/\D/g, '')
                        .slice(0, 11);
                    break;

                case '3': // Carnet de Extranjería
                case '4': // Pasaporte
                    numeroDocumento.value = numeroDocumento.value
                        .replace(/[^a-zA-Z0-9]/g, '')
                        .toUpperCase();
                    break;

            }

        });

    },

    validar(form) {

        const tipoDocumento = form.tipo_documento_id.value.trim();
        const numeroDocumento = form.numero_documento.value.trim();
        const nombres = form.nombres.value.trim();
        const apPaterno = form.ap_paterno.value.trim();
        const apMaterno = form.ap_materno.value.trim();

        if (
            !tipoDocumento ||
            !numeroDocumento ||
            !nombres ||
            !apPaterno ||
            !apMaterno
        ) {

            return {
                success: false,
                message: 'Todos los campos son obligatorios.'
            };

        }

        switch (tipoDocumento) {

            case '1':

                if (!/^[0-9]{8}$/.test(numeroDocumento)) {

                    return {
                        success: false,
                        message: 'El DNI debe contener exactamente 8 dígitos.'
                    };

                }

                break;

            case '2':

                if (!/^[0-9]{11}$/.test(numeroDocumento)) {

                    return {
                        success: false,
                        message: 'El RUC debe contener exactamente 11 dígitos.'
                    };

                }

                break;

            case '3':
            case '4':

                if (!/^[A-Za-z0-9]+$/.test(numeroDocumento)) {

                    return {
                        success: false,
                        message: 'El documento solo admite letras y números.'
                    };

                }

                break;

        }

        return {
            success: true
        };

    }

};
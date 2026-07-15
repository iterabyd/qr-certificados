const CertificacionApp = {

    async cargar() {

        const certificaciones =
            await CertificacionService.obtenerTodos();

        CertificacionGrid.render(
            certificaciones
        );

    },

    async iniciar() {

        await this.cargar();

        CertificacionForm.init();

    }

};

document.addEventListener(

    'DOMContentLoaded',

    () => CertificacionApp.iniciar()

);
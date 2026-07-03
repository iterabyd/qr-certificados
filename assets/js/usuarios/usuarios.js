const UsuarioApp = {

    async cargar() {

        const usuarios =
            await UsuarioService.obtenerTodos();

        UsuarioGrid.render(
            usuarios
        );

    },

    async iniciar() {
        console.log('UsuarioApp iniciado');
        await this.cargar();

        UsuarioForm.init();

    }

};

document.addEventListener(

    'DOMContentLoaded',

    () => UsuarioApp.iniciar()

);
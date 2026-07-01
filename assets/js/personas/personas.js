const PersonaApp = {

    personas: [],

    async init() {

        PersonaValidation.init();

        PersonaForm.init();

        await this.cargar();

    },

    async cargar() {

        this.personas = await PersonaService.listar();

        PersonaGrid.render(this.personas);

    }

};

document.addEventListener('DOMContentLoaded', () => {

    PersonaApp.init();

});
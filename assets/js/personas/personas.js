// ======================================================
// MÓDULO PERSONAS
// Inicializa todos los componentes del módulo.
// ======================================================

document.addEventListener("DOMContentLoaded", async () => {

    await iniciarModuloPersonas();

});

async function iniciarModuloPersonas() {

    // Inicializar tabla
    await iniciarTablaPersonas();

    // Inicializar formularios
    iniciarFormularioPersona();

    // Inicializar validaciones
    iniciarValidacionesPersona();

}


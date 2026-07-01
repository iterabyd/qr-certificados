// ======================================================
// SERVICIO PERSONAS
// Todas las llamadas AJAX del módulo.
// ======================================================

async function guardarPersona(datos) {

    const respuesta = await fetch(
        BASE_URL + "/actions/personas/persona_store.php",
        {
            method: "POST",
            body: datos
        }
    );

    return await respuesta.json();

}
// script.js
function buscarEnvio() {
    const codigoSeguimiento = document.getElementById('tracking-code').value;

    // Aquí realizarías una solicitud real a una API de seguimiento de envío
    // Simularemos una respuesta con un estado ficticio y una ubicación ficticia.
    const estadoEnvio = 'En tránsito';
    const ubicacionEnvio = 'Ciudad XYZ, País ABC';

    // Actualizamos la página con los resultados simulados
    document.getElementById('tracking-status').textContent = estadoEnvio;
    mostrarMapa(ubicacionEnvio);
}

function mostrarMapa(ubicacion) {
    // Aquí puedes usar una librería de mapas como Google Maps para mostrar la ubicación
    // Simularemos la ubicación en este ejemplo.
    const mapElement = document.getElementById('map');
    mapElement.innerHTML = `<iframe
        width="100%"
        height="300"
        frameborder="0"
        src="https://www.google.com/maps/embed/v1/place?q=${encodeURIComponent(
            ubicacion
        )}&key=TU_CLAVE_DE_API_AQUI"
    ></iframe>`;
}

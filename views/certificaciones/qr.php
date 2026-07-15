<?php

require_once '../../config/config.php';
require_once '../../controllers/CertificacionController.php';

// Validar token recibido
$token = $_GET['token'] ?? '';

if (empty($token)) {
    die('Token no válido.');
}

// Obtener certificación
$controller = new CertificacionController();
$certificacion = $controller->obtenerPorToken($token);

if (!$certificacion) {
    die('Certificación no encontrada.');
}

// Construir URL pública de validación
$protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$dominio = $_SERVER['HTTP_HOST'];
$urlValidacion = $protocolo . '://' . $dominio . BASE_URL . '/verificar.php?token=' . urlencode($token);

// URL del QR
$urlQr = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($urlValidacion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Código QR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 text-center">

        <h1 class="text-2xl font-bold text-[#3E2723] mb-2">
            Código QR
        </h1>

        <p class="text-gray-500 mb-4">
            <?= htmlspecialchars($certificacion['numero_certificacion']) ?>
        </p>

        <div class="flex justify-center mb-5">
            <img
                src="<?= $urlQr ?>"
                alt="Código QR"
                class="w-72 h-72 border rounded-xl p-3 bg-white"
            >
        </div>

        <div class="text-left bg-gray-50 border rounded-lg p-3 mb-4">
            <p class="text-sm font-semibold text-gray-700 mb-1">
                URL de validación:
            </p>

            <input
                id="urlValidacion"
                type="text"
                readonly
                value="<?= htmlspecialchars($urlValidacion) ?>"
                class="w-full border rounded px-3 py-2 text-sm"
            >
        </div>

        <div class="flex justify-center gap-2">

            <button
                onclick="copiarUrl()"
                class="bg-[#C9A227] hover:bg-[#b38f1f] text-white px-4 py-2 rounded-lg">
                Copiar enlace
            </button>

            <a
                href="<?= $urlQr ?>"
                download="qr-certificacion.png"
                class="bg-[#3E2723] hover:opacity-90 text-white px-4 py-2 rounded-lg">
                Descargar QR
            </a>

        </div>

    </div>

<script>
function copiarUrl() {
    const input = document.getElementById('urlValidacion');
    input.select();
    document.execCommand('copy');
    alert('Enlace copiado correctamente.');
}
</script>

</body>
</html>
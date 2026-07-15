<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/controllers/CertificacionController.php';

// Función para escapar texto
function e($valor)
{
    return htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8');
}

// Función para mostrar fecha en formato largo
function fechaLarga($fecha)
{
    $meses = [
        1 => 'ENERO',
        2 => 'FEBRERO',
        3 => 'MARZO',
        4 => 'ABRIL',
        5 => 'MAYO',
        6 => 'JUNIO',
        7 => 'JULIO',
        8 => 'AGOSTO',
        9 => 'SETIEMBRE',
        10 => 'OCTUBRE',
        11 => 'NOVIEMBRE',
        12 => 'DICIEMBRE'
    ];

    $timestamp = strtotime($fecha);

    $dia = date('d', $timestamp);
    $mes = $meses[(int) date('m', $timestamp)];
    $anio = date('Y', $timestamp);

    return "AYACUCHO, {$dia} DE {$mes} DEL {$anio}.";
}

// Obtener token
$token = $_GET['token'] ?? '';

$controller = new CertificacionController();

$certificacion = null;

if (!empty($token)) {
    $certificacion = $controller->obtenerPorToken($token);
}

// Construir URL actual para mostrar QR en la página
$protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$urlActual = $protocolo . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$urlQr = 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($urlActual);

$esValido = $certificacion && $certificacion['estado_id'] == 1;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validación de Certificación</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<header class="bg-[#3E2723] text-white py-4 shadow">
    <div class="max-w-4xl mx-auto px-4 flex items-center justify-between">
        <h1 class="text-lg md:text-2xl font-bold">
            NOTARÍA HINOSTROZA AUCASIME
        </h1>
        <span class="text-sm opacity-80">
            Verificación QR
        </span>
    </div>
</header>

<main class="max-w-4xl mx-auto px-4 py-6">

<?php if (!$esValido): ?>

    <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center">
        <div class="text-red-600 text-5xl mb-3">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>

        <h2 class="text-2xl font-bold text-red-700 mb-2">
            Documento no válido
        </h2>

        <p class="text-red-700">
            No se encontró una certificación vigente asociada a este código QR.
        </p>
    </div>

<?php else: ?>

    <div class="bg-green-50 border border-green-200 rounded-xl p-5 mb-6">
        <h2 class="text-2xl font-bold text-green-700 mb-1">
            Documento válido
        </h2>

        <p class="text-green-700">
            La información corresponde a una certificación registrada en el sistema.
        </p>
    </div>

    <section class="bg-white rounded-2xl shadow-xl p-6 md:p-10 border">

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-[#3E2723]">
                NOTARÍA HINOSTROZA AUCASIME
            </h2>
        </div>

        <div class="text-sm md:text-base leading-relaxed text-gray-900">

            <p class="mb-4 text-justify uppercase">
                CERTIFICO: QUE, LA FIRMA QUE APARECE EN EL PRESENTE DOCUMENTO
                CORRESPONDE A:
                <strong>
                    <?= e($certificacion['ap_paterno']) ?>
                    <?= e($certificacion['ap_materno']) ?>,
                    <?= e($certificacion['nombres']) ?>
                </strong>
                IDENTIFICADO(A) CON
                <?= e($certificacion['tipo_documento']) ?>
                N°
                <strong><?= e($certificacion['numero_documento']) ?></strong>.
                OBJETO DE LEGALIZACIÓN:
                <strong><?= e($certificacion['objeto']) ?></strong>.
            </p>

            <?php if (!empty($certificacion['observaciones'])): ?>
                <p class="mb-4">
                    <strong>Observaciones:</strong>
                    <?= e($certificacion['observaciones']) ?>
                </p>
            <?php endif; ?>

            <p class="font-bold text-lg mt-6 mb-6">
                <?= fechaLarga($certificacion['fecha_registro']) ?>
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mt-8">

            <div class="text-sm text-gray-700">
                <p>
                    <strong>N° Certificación:</strong>
                    <?= e($certificacion['numero_certificacion']) ?>
                </p>

                <p>
                    <strong>Estado:</strong>
                    <?= e($certificacion['estado']) ?>
                </p>

                <p>
                    <strong>Fecha Registro:</strong>
                    <?= e($certificacion['fecha_registro']) ?>
                </p>

                <p class="break-all">
                    <strong>Token:</strong>
                    <?= e($certificacion['token_qr']) ?>
                </p>
            </div>

            <div class="flex justify-center">
                <img
                    src="<?= $urlQr ?>"
                    alt="Código QR"
                    class="w-40 h-40 border rounded-lg p-2 bg-white"
                >
            </div>

        </div>

        <div class="border-t mt-8 pt-4 text-xs text-gray-600 text-justify">
            Artículo 108 del decreto legislativo N° 1049: el notario no asume
            responsabilidad sobre el contenido del documento de lo que deberá
            dejar constancia en la certificación, salvo que constituya en sí
            un acto ilícito o contrario a la moral o a las buenas costumbres.
        </div>

    </section>

<?php endif; ?>

</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>

</body>
</html>
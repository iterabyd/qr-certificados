<?php

require_once __DIR__ . '/../models/Certificacion.php';
require_once __DIR__ . '/../core/Response.php';

class CertificacionController
{
    private $certificacionModel;

    public function __construct()
    {
        $this->certificacionModel = new Certificacion();
    }

    // Listar
    public function listar()
    {
        return $this->certificacionModel->listar();
    }

    // Obtener por ID
    public function obtenerPorId($id)
    {
        return $this->certificacionModel->obtenerPorId($id);
    }

    // Crear
    public function crear()
    {
        $persona_id = $_POST['persona_id'];
        $objeto_legalizacion_id = $_POST['objeto_legalizacion_id'];
        $estado_id = $_POST['estado_id'];
        $observaciones = trim($_POST['observaciones']);

        // Número de certificación
        $numero_certificacion = $this->generarNumeroCertificacion();

        // Token QR
        $token_qr = bin2hex(random_bytes(16));

        // Usuario logueado
        $usuario_id = $_SESSION['id_usuario'];

        $this->certificacionModel->crear(
            $numero_certificacion,
            $token_qr,
            $persona_id,
            $objeto_legalizacion_id,
            $estado_id,
            $usuario_id,
            $observaciones
        );
        

        return Response::success(
            'Certificación registrada correctamente.'
        );
    }

    // Actualizar
    public function actualizar()
    {
        $id = $_POST['id'];

        $persona_id = $_POST['persona_id'];
        $objeto_legalizacion_id = $_POST['objeto_legalizacion_id'];
        $estado_id = $_POST['estado_id'];
        $observaciones = trim($_POST['observaciones']);

        $this->certificacionModel->actualizar(
            $id,
            $persona_id,
            $objeto_legalizacion_id,
            $estado_id,
            $observaciones
        );

        return Response::success(
            'Certificación actualizada correctamente.'
        );
    }

    // Cambiar estado
    public function cambiarEstado()
    {
        $id = $_POST['id'];
        $estado_id = $_POST['estado_id'];

        $this->certificacionModel->cambiarEstado(
            $id,
            $estado_id
        );

        return Response::success(
            'Estado actualizado correctamente.'
        );
    }

    // Buscar por token
    public function obtenerPorToken($token)
    {
        return $this->certificacionModel->obtenerPorToken($token);
    }

    // Generar número de certificación
    private function generarNumeroCertificacion()
    {
        return 'CERT-' . date('Y') . '-' . date('His');
    }

}
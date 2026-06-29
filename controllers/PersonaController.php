<?php

require_once __DIR__ . '/../models/Persona.php';

// Controlador encargado de procesar las solicitudes de personas
class PersonaController
{
    private $personaModel;

    public function __construct()
    {
        $this->personaModel = new Persona();
    }

    // Obtener listado de personas
    public function listar()
    {
        return $this->personaModel->listar();
    }

    // Obtener un persona por ID
    public function obtenerPorId($id)
    {
        return $this->personaModel->obtenerPorId($id);
    }

    // Crear persona
    public function crear()
    {
        $tipo_documento_id = $_POST['tipo_documento_id'];
        $numero_documento = trim($_POST['numero_documento']);
        $nombres = trim($_POST['nombres']);
        $ap_paterno = trim($_POST['ap_paterno']);
        $ap_materno = trim($_POST['ap_materno']);

        // Evitar usuarios duplicados
        if ($this->personaModel->existePersona($numero_documento)) {
            header('Location: ' . BASE_URL . '/views/personas/index.php?error=persona_existe');
            exit;
        }

        $this->personaModel->crear(
            $tipo_documento_id,
            $numero_documento,
            $nombres,
            $ap_paterno,
            $ap_materno
        );

        header('Location: ' . BASE_URL . '/views/personas/index.php');
        exit;
    }

    // Actualizar persona
    public function actualizar()
    {
        $id = $_POST['id'];

        $tipo_documento_id = $_POST['tipo_documento_id'];
        $numero_documento = trim($_POST['numero_documento']);
        $nombres = trim($_POST['nombres']);
        $ap_paterno = trim($_POST['ap_paterno']);
        $ap_materno = trim($_POST['ap_materno']);

        $this->personaModel->actualizar(
            $id,
            $tipo_documento_id,
            $numero_documento,
            $nombres,
            $ap_paterno,
            $ap_materno
        );

        header('Location: ' . BASE_URL . '/views/personas/index.php');
        exit;
    }

}
<?php

require_once __DIR__ . '/../models/Persona.php';
require_once __DIR__ . '/../core/Response.php';


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
        try {

            $tipo_documento_id = trim($_POST['tipo_documento_id']);
            $numero_documento = trim($_POST['numero_documento']);
            $nombres = trim($_POST['nombres']);
            $ap_paterno = trim($_POST['ap_paterno']);
            $ap_materno = trim($_POST['ap_materno']);

            // Validar campos obligatorios
            if (
                empty($tipo_documento_id) ||
                empty($numero_documento) ||
                empty($nombres) ||
                empty($ap_paterno) ||
                empty($ap_materno)
            ) {
                return Response::error('Todos los campos son obligatorios.');
            }

            // Validar documento según tipo
            switch ($tipo_documento_id) {

                case 1: // DNI
                    if (!preg_match('/^[0-9]{8}$/', $numero_documento)) {
                        return Response::error('El DNI debe contener 8 dígitos.');
                    }
                    break;

                case 2: // RUC
                    if (!preg_match('/^[0-9]{11}$/', $numero_documento)) {
                        return Response::error('El RUC debe contener 11 dígitos.');
                    }
                    break;

                case 3: // Carnet de Extranjería
                case 4: // Pasaporte
                    if (!preg_match('/^[A-Za-z0-9]+$/', $numero_documento)) {
                        return Response::error('El documento contiene caracteres no permitidos.');
                    }
                    break;
            }

            // Verificar duplicado
            if ($this->personaModel->existePersona($numero_documento)) {
                return Response::error('La persona ya se encuentra registrada.');
            }

            $this->personaModel->crear(
                $tipo_documento_id,
                $numero_documento,
                $nombres,
                $ap_paterno,
                $ap_materno
            );

            return Response::success(
                'Persona registrada correctamente.'
            );

        } catch (Exception $e) {

            return Response::error(
                $e->getMessage()
            );

        }
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
        if(
            $this->personaModel->existePersonaActualizar(
                $numero_documento,
                $id
            )
        ){

            return Response::error(
                'El número de documento ya existe.'
            );

        }

        $this->personaModel->actualizar(

            $id,
            $tipo_documento_id,
            $numero_documento,
            $nombres,
            $ap_paterno,
            $ap_materno

        );

        return Response::success(
            'Persona actualizada correctamente.'
        );

    }

}

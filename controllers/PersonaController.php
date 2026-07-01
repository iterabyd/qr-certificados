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

        //validar tipo de documento

        switch ($tipo_documento_id) {

            case 1: // DNI

                if (!preg_match('/^\d{8}$/', $numero_documento)) {
                    $error = 'El DNI debe tener 8 dígitos.';
                }

                break;

            case 2: // RUC

                if (!preg_match('/^\d{11}$/', $numero_documento)) {
                    $error = 'El RUC debe tener 11 dígitos.';
                }

                break;

            case 3: // CE

                if (!preg_match('/^[A-Za-z0-9]+$/', $numero_documento)) {
                    $error = 'El Carnet de Extranjería es inválido.';
                }

                break;

            case 4: // Pasaporte

                if (!preg_match('/^[A-Za-z0-9]+$/', $numero_documento)) {
                    $error = 'El Pasaporte es inválido.';
                }

                break;
        }

        if (isset($error)) {

            $_SESSION['alerta'] = [
                'icon' => 'warning',
                'title' => 'Documento inválido',
                'text' => $error
            ];

            header(
                'Location: ' .
                BASE_URL .
                '/views/personas/index.php'
            );

            exit;
        }   

        // Evitar usuarios duplicados
        if ($this->personaModel->existePersona($numero_documento)) {
            
            
            $_SESSION['alerta'] = [
                'icon' => 'warning',
                'title' => 'Documento duplicado',
                'text' => 'Ya existe una persona con ese número de documento.'
            ];
            header('Location: ' . BASE_URL . '/views/personas/index.php');
            exit;
        }

        $this->personaModel->crear(
            $tipo_documento_id,
            $numero_documento,
            $nombres,
            $ap_paterno,
            $ap_materno
        );

        $_SESSION['alerta'] = [
            'icon' => 'success',
            'title' => 'Registro exitoso',
            'text' => 'La persona fue registrada correctamente.'
        ];

        header('Location: ' . BASE_URL . '/views/personas/index.php');
        exit;
    }

    // Actualizar persona
    public function actualizar()
    {
        $id = $_POST['id'];

        $nombre = trim($_POST['nombre']);

        $descripcion = trim($_POST['descripcion']);

        $this->rolModel->actualizar(
            $id,
            $nombre,
            $descripcion
        );

        header('Location: ' . BASE_URL . '/views/roles/index.php');
        exit;
    }

    // Eliminar rol
    public function eliminar()
    {
        $id = $_GET['id'];

        $this->rolModel->eliminar($id);

        header('Location: ../views/roles/index.php');
        exit;
    }
    
    // Cambiar estado de rol
    public function cambiarEstado()
    {
        $id = $_GET['id'];
        $estado = $_GET['estado'];

        $this->rolModel->cambiarEstado($id, $estado);

        header('Location: ../views/roles/index.php');
        exit;
    }
}
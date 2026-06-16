<?php

require_once __DIR__ . '/../models/Rol.php';

// Controlador encargado de procesar las solicitudes de roles
class RolController
{
    private $rolModel;

    public function __construct()
    {
        $this->rolModel = new Rol();
    }

    // Obtener listado de roles
    public function listar()
    {
        return $this->rolModel->listar();
    }

    // Crear rol
    public function crear()
    {
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);

        $this->rolModel->crear(
            $nombre,
            $descripcion
        );

        header('Location: ../views/roles/index.php');
        exit;
    }

    // Actualizar rol
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

        header('Location: ../views/roles/index.php');
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
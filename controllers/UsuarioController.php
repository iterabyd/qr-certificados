<?php

require_once __DIR__ . '/../models/Usuario.php';

// Controlador encargado de procesar las solicitudes de usuarios
class UsuarioController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Usuario();
    }

    // Obtener listado de usuarios
    public function listar()
    {
        return $this->usuarioModel->listar();
    }

    // Obtener un usuario por ID
    public function obtenerPorId($id)
    {
        return $this->usuarioModel->obtenerPorId($id);
    }

    // Registrar usuario
    public function crear()
    {
        $rol_id = $_POST['rol_id'];
        $usuario = trim($_POST['usuario']);
        $password = $_POST['password'];
        $nombres = trim($_POST['nombres']);
        $ap_paterno = trim($_POST['ap_paterno']);
        $ap_materno = trim($_POST['ap_materno']);
        $email = trim($_POST['email']);

        // Evitar usuarios duplicados
        if ($this->usuarioModel->existeUsuario($usuario)) {
            header('Location: ' . BASE_URL . '/views/usuarios/index.php?error=usuario_existe');
            exit;
        }

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $this->usuarioModel->crear(
            $rol_id,
            $usuario,
            $passwordHash,
            $nombres,
            $ap_paterno,
            $ap_materno,
            $email
        );

        header('Location: ' . BASE_URL . '/views/usuarios/index.php');
        exit;
    }

    // Actualizar usuario (sin tocar la contraseña)
    public function actualizar()
    {
        $id = $_POST['id'];

        $rol_id = $_POST['rol_id'];
        $usuario = trim($_POST['usuario']);
        $nombres = trim($_POST['nombres']);
        $ap_paterno = trim($_POST['ap_paterno']);
        $ap_materno = trim($_POST['ap_materno']);
        $email = trim($_POST['email']);

        $this->usuarioModel->actualizar(
            $id,
            $rol_id,
            $usuario,
            $nombres,
            $ap_paterno,
            $ap_materno,
            $email
        );

        header('Location: ' . BASE_URL . '/views/usuarios/index.php');
        exit;
    }

    // Cambiar contraseña
    public function actualizarPassword()
    {
        $id = $_POST['id'];
        $password = $_POST['password'];

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $this->usuarioModel->actualizarPassword(
            $id,
            $passwordHash
        );

        header('Location: ' . BASE_URL . '/views/usuarios/index.php');
        exit;
    }

    // Cambiar estado de usuario (activar/inactivar)
    public function cambiarEstado()
    {
        $id = $_GET['id'];
        $estado = $_GET['estado'];

        $this->usuarioModel->cambiarEstado($id, $estado);

        header('Location: ' . BASE_URL . '/views/usuarios/index.php');
        exit;
    }
}
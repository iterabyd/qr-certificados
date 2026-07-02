<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../core/Response.php';

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
        try{
            $rol_id = $_POST['rol_id'];
            $usuario = trim($_POST['usuario']);
            $password = $_POST['password'];
            $nombres = trim($_POST['nombres']);
            $ap_paterno = trim($_POST['ap_paterno']);
            $ap_materno = trim($_POST['ap_materno']);
            $email = trim($_POST['email']);

            // Evitar usuarios duplicados
            if ($this->usuarioModel->existeUsuario($usuario)) {
                return Response::error(
                    'El usuario ya existe.'
                );
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

            return Response::success(
                'Usuario registrado correctamente.'
            );
        } catch (Exception $e) {

            return Response::error(
                $e->getMessage()
            );

        }
            
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

            if ($this->usuarioModel->existeUsuarioActualizar($usuario, $id)) {
                return Response::error(
                    'El usuario ya existe.'
                );

            }

            $this->usuarioModel->actualizar(
                $id,
                $rol_id,
                $usuario,
                $nombres,
                $ap_paterno,
                $ap_materno,
                $email
            );

            return Response::success(
                'Usuario actualizado correctamente.'
            );
    }

    // Cambiar contraseña
    public function actualizarPassword()
    {
        $id = $_POST['id'];
        $password = trim($_POST['password']);

        if (empty($password)) {
            return Response::error(
                'Debe ingresar una contraseña.'
            );

        }

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $this->usuarioModel->actualizarPassword(
            $id,
            $passwordHash
        );

        return Response::success(
            'Contraseña actualizada correctamente.'
        );
    }

    // Cambiar estado de usuario (activar/inactivar)
    public function cambiarEstado()
    {
        $id = $_GET['id'];
        $estado = $_GET['estado'];

        $this->usuarioModel->cambiarEstado($id, $estado);

        return Response::success(

        $estado == 1
            ? 'Usuario activado correctamente.'
            : 'Usuario inactivado correctamente.'

        );
    }
}
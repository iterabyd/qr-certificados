<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/config.php';

// Controlador encargado de la autenticación
class LoginController
{
    private $conexion;

    // Constructor
    public function __construct()
    {
        $database = new Database();

        $this->conexion =
            $database->conectar();
    }

    // Validar credenciales del usuario
    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener datos enviados desde el formulario
        $usuario =
            trim($_POST['usuario']);

        $password =
            trim($_POST['password']);

        // Buscar usuario activo
        $sql = "
            SELECT *
            FROM usuarios
            WHERE usuario = ?
            AND estado = 1
        ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute([$usuario]);

        $registro =
            $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar existencia
        if(!$registro)
        {
            die('Usuario no encontrado');
        }

        // Verificar contraseña
        if(
            !password_verify(
                $password,
                $registro['password']
            )
        )
        {
            die('Contraseña incorrecta');
        }

        // Crear variables de sesión
        $_SESSION['id_usuario']
            = $registro['id'];

        $_SESSION['usuario']
            = $registro['usuario'];

        $_SESSION['rol_id']
            = $registro['rol_id'];

        // Redireccionar al dashboard
        header(
            'Location: ' . BASE_URL . '/views/dashboard/index.php'
        );

        exit;
    }
}
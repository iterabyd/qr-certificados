<?php

require_once __DIR__ . '/../config/database.php';

// Modelo encargado de las operaciones de usuarios
class Usuario
{
    private $conexion;

    // Constructor
    public function __construct()
    {
        $database = new Database();

        $this->conexion =
            $database->conectar();
    }

    // Obtener todos los usuarios
    public function listar()
    {
        $sql = "
            SELECT
                u.id,
                u.rol_id,
                u.usuario,
                u.nombres,
                u.ap_paterno,
                u.ap_materno,
                u.email,
                u.estado,
                r.nombre AS rol
            FROM usuarios u
            INNER JOIN roles r
                ON r.id = u.rol_id
            ORDER BY u.id DESC
        ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(
            PDO::FETCH_ASSOC
        );
    }

    // Obtener usuario por ID
    public function obtenerPorId($id)
    {
        $sql = "
            SELECT *
            FROM usuarios
            WHERE id = ?
        ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(
            PDO::FETCH_ASSOC
        );
    }

    // Registrar usuario
    public function crear(
        $rol_id,
        $usuario,
        $password,
        $nombres,
        $ap_paterno,
        $ap_materno,
        $email
    )
    {
        $sql = "
            INSERT INTO usuarios
            (
                rol_id,
                usuario,
                password,
                nombres,
                ap_paterno,
                ap_materno,
                email
            )
            VALUES
            (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            )
        ";

        $stmt =
            $this->conexion->prepare($sql);

        return $stmt->execute([
            $rol_id,
            $usuario,
            $password,
            $nombres,
            $ap_paterno,
            $ap_materno,
            $email
        ]);
    }

    // Actualizar usuario
    public function actualizar(
        $id,
        $rol_id,
        $usuario,
        $nombres,
        $ap_paterno,
        $ap_materno,
        $email
    )
    {
        $sql = "
            UPDATE usuarios
            SET
                rol_id = ?,
                usuario = ?,
                nombres = ?,
                ap_paterno = ?,
                ap_materno = ?,
                email = ?
            WHERE id = ?
        ";

        $stmt =
            $this->conexion->prepare($sql);

        return $stmt->execute([
            $rol_id,
            $usuario,
            $nombres,
            $ap_paterno,
            $ap_materno,
            $email,
            $id
        ]);
    }

    // Cambiar contraseña
    public function actualizarPassword(
        $id,
        $password
    )
    {
        $sql = "
            UPDATE usuarios
            SET password = ?
            WHERE id = ?
        ";

        $stmt =
            $this->conexion->prepare($sql);

        return $stmt->execute([
            $password,
            $id
        ]);
    }

    // Cambiar estado
    public function cambiarEstado(
        $id,
        $estado
    )
    {
        $sql = "
            UPDATE usuarios
            SET estado = ?
            WHERE id = ?
        ";

        $stmt =
            $this->conexion->prepare($sql);

        return $stmt->execute([
            $estado,
            $id
        ]);
    }

    // Verificar si existe el usuario
    public function existeUsuario(
        $usuario
    )
    {
        $sql = "
            SELECT id
            FROM usuarios
            WHERE usuario = ?
        ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute([
            $usuario
        ]);

        return $stmt->fetch();
    }
    // Verificar documento repetido al actualizar
    public function existeUsuarioActualizar(
        $usuario,
        $id
    )
    {
        $sql = "
            SELECT COUNT(*)
            FROM usuarios
            WHERE usuario = ?
            AND id <> ?
        ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            $usuario,
            $id
        ]);

        return $stmt->fetchColumn() > 0;
    }
}
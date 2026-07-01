<?php

require_once __DIR__ . '/../config/database.php';

// Modelo encargado de las operaciones sobre la tabla roles
class Rol
{
    private $conexion;

    // Constructor
    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    // Obtener todos los roles
    public function listar()
    {
        $sql = "
            SELECT *
            FROM roles
            ORDER BY id DESC
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar un rol por ID
    public function obtenerPorId($id)
    {
        $sql = "
            SELECT *
            FROM roles
            WHERE id = ?
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Registrar rol
    public function crear($nombre, $descripcion)
    {
        $sql = "
            INSERT INTO roles
            (
                nombre,
                descripcion
            )
            VALUES
            (
                ?,
                ?
            )
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $nombre,
            $descripcion
        ]);
    }

    // Actualizar rol
    public function actualizar(
        $id,
        $nombre,
        $descripcion
    )
    {
        $sql = "
            UPDATE roles
            SET
                nombre = ?,
                descripcion = ?
            WHERE id = ?
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $nombre,
            $descripcion,
            $id
        ]);
    }

    // Eliminar rol
    public function eliminar($id)
    {
        $sql = "
            DELETE FROM roles
            WHERE id = ?
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([$id]);
    }

    // Cambiar estado del rol
    public function cambiarEstado(
        $id,
        $estado
    )
    {
        $sql = "
            UPDATE roles
            SET estado = ?
            WHERE id = ?
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $estado,
            $id
        ]);
    }
}
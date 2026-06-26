<?php

require_once __DIR__ . '/../config/database.php';

// Modelo encargado de las operaciones sobre la tabla personas
class Persona
{
    private $conexion;

    // Constructor
    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    // Obtener todos las personas
    public function listar()
    {
        $sql = "
            SELECT 	p.id, 
                    p.tipo_documento_id,
                    t.codigo,
                    p.numero_documento, 
                    p.nombres, 
                    p.ap_paterno, 
                    p.ap_materno        
            FROM personas p 
            INNER JOIN tipos_documento t
            ON p.tipo_documento_id=t.id
            ORDER BY p.id DESC
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar una persona por ID
    public function obtenerPorId($id)
    {
        $sql = "
            SELECT *
            FROM personas
            WHERE id = ?
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Registrar persona
    public function crear(
        $tipo_documento_id,
        $numero_documento,
        $nombres,
        $ap_paterno,
        $ap_materno
    )
    {
        $sql = "
            INSERT INTO personas
            (
                tipo_documento_id,
                numero_documento,
                nombres,
                ap_paterno,
                ap_materno

            )
            VALUES
            (
                ?,
                ?,
                ?,
                ?,
                ?
            
            )
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $tipo_documento_id,
            $numero_documento,
            $nombres,
            $ap_paterno,
            $ap_materno
        ]);
    }

    // Actualizar persona
    public function actualizar(
        $id,
        $nombre,
        $descripcion
    )
    {
        $sql = "
            UPDATE personas
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

    // Verificar si existe la persona
    public function existePersona(
        $numero_documento
    )
    {
        $sql = "
            SELECT id
            FROM personas
            WHERE numero_documento = ?
        ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute([
            $numero_documento
        ]);

        return $stmt->fetch();
    }
}
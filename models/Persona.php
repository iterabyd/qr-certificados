<?php

require_once __DIR__ . '/../config/database.php';

// Modelo encargado de las operaciones sobre la tabla personas
class Persona
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    // Listar personas
    public function listar()
    {
        $sql = "
            SELECT
                p.id,
                p.tipo_documento_id,
                t.codigo,
                p.numero_documento,
                p.nombres,
                p.ap_paterno,
                p.ap_materno,
                p.estado
            FROM personas p
            INNER JOIN tipos_documento t
                ON p.tipo_documento_id = t.id
            ORDER BY p.id DESC
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una persona por ID
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
        $tipo_documento_id,
        $numero_documento,
        $nombres,
        $ap_paterno,
        $ap_materno
    )
    {
        $sql = "
            UPDATE personas
            SET
                tipo_documento_id = ?,
                numero_documento = ?,
                nombres = ?,
                ap_paterno = ?,
                ap_materno = ?
            WHERE id = ?
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $tipo_documento_id,
            $numero_documento,
            $nombres,
            $ap_paterno,
            $ap_materno,
            $id
        ]);
    }

    // Inactivar persona
    public function cambiarEstado($id, $estado)
    {
        $sql = "
            UPDATE personas
            SET estado = ?
            WHERE id = ?
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $estado,
            $id
        ]);
    }

    // Verificar si existe una persona
    public function existePersona($numero_documento)
    {
        $sql = "
            SELECT COUNT(*)
            FROM personas
            WHERE numero_documento = ?
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$numero_documento]);

        return $stmt->fetchColumn() > 0;
    }

    // Verificar documento repetido al actualizar
    public function existePersonaActualizar(
        $numero_documento,
        $id
    )
    {
        $sql = "
            SELECT COUNT(*)
            FROM personas
            WHERE numero_documento = ?
            AND id <> ?
        ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            $numero_documento,
            $id
        ]);

        return $stmt->fetchColumn() > 0;
    }
}
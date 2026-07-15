<?php

require_once __DIR__ . '/../config/database.php';

class Certificacion
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    // Listar certificaciones
    public function listar()
    {
        $sql = "
            SELECT
                c.id,
                c.numero_certificacion,
                c.token_qr,
                c.persona_id,
                c.objeto_legalizacion_id,
                c.estado_id,
                c.usuario_id,
                c.observaciones,
                c.fecha_registro,

                p.numero_documento,
                p.nombres,
                p.ap_paterno,
                p.ap_materno,

                td.descripcion AS tipo_documento,

                ol.descripcion AS objeto,

                e.descripcion AS estado,

                CONCAT(
                    u.nombres,' ',
                    u.ap_paterno,' ',
                    u.ap_materno
                ) AS usuario

            FROM certificaciones c

            INNER JOIN personas p
                ON p.id = c.persona_id

            INNER JOIN tipos_documento td
                ON td.id = p.tipo_documento_id

            INNER JOIN objetos_legalizacion ol
                ON ol.id = c.objeto_legalizacion_id

            INNER JOIN estados e
                ON e.id = c.estado_id

            INNER JOIN usuarios u
                ON u.id = c.usuario_id

            ORDER BY c.id DESC
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener certificación por ID
    public function obtenerPorId($id)
    {
        $sql = "
            SELECT *
            FROM certificaciones
            WHERE id = ?
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Registrar certificación
    public function crear(
        $numero_certificacion,
        $token_qr,
        $persona_id,
        $objeto_legalizacion_id,
        $estado_id,
        $usuario_id,
        $observaciones
    )
    {
        $sql = "
            INSERT INTO certificaciones
            (
                numero_certificacion,
                token_qr,
                persona_id,
                objeto_legalizacion_id,
                estado_id,
                usuario_id,
                observaciones
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

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $numero_certificacion,
            $token_qr,
            $persona_id,
            $objeto_legalizacion_id,
            $estado_id,
            $usuario_id,
            $observaciones
        ]);
    }

    // Actualizar certificación
    public function actualizar(
        $id,
        $persona_id,
        $objeto_legalizacion_id,
        $estado_id,
        $observaciones
    )
    {
        $sql = "
            UPDATE certificaciones
            SET
                persona_id=?,
                objeto_legalizacion_id=?,
                estado_id=?,
                observaciones=?
            WHERE id=?
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $persona_id,
            $objeto_legalizacion_id,
            $estado_id,
            $observaciones,
            $id
        ]);
    }

    // Cambiar estado
    public function cambiarEstado($id,$estado_id)
    {
        $sql = "
            UPDATE certificaciones
            SET estado_id=?
            WHERE id=?
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $estado_id,
            $id
        ]);
    }

    // Verificar número de certificación
    public function existeNumeroCertificacion($numero)
    {
        $sql = "
            SELECT id
            FROM certificaciones
            WHERE numero_certificacion=?
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$numero]);

        return $stmt->fetch();
    }


    // Buscar certificación por token QR
    public function obtenerPorToken($token)
    {
        $sql = "
            SELECT
                c.id,
                c.numero_certificacion,
                c.token_qr,
                c.fecha_registro,
                c.observaciones,
                c.estado_id,

                p.numero_documento,
                p.nombres,
                p.ap_paterno,
                p.ap_materno,

                td.descripcion AS tipo_documento,

                ol.descripcion AS objeto,

                e.codigo AS estado_codigo,
                e.descripcion AS estado

            FROM certificaciones c

            INNER JOIN personas p
                ON p.id = c.persona_id

            INNER JOIN tipos_documento td
                ON td.id = p.tipo_documento_id

            INNER JOIN objetos_legalizacion ol
                ON ol.id = c.objeto_legalizacion_id

            INNER JOIN estados e
                ON e.id = c.estado_id

            WHERE c.token_qr = ?
            LIMIT 1
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$token]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
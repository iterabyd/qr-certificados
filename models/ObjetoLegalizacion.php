<?php

require_once __DIR__ . '/../config/database.php';

class ObjetoLegalizacion
{

    private $conexion;

    public function __construct()
    {

        $database = new Database();

        $this->conexion = $database->conectar();

    }

    public function listar()
    {

        $sql = "
            SELECT
                id,
                descripcion,
                estado
            FROM objetos_legalizacion
            ORDER BY id DESC
        ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function obtenerPorId($id)
    {

        $stmt = $this->conexion->prepare(

            "SELECT * FROM objetos_legalizacion WHERE id=?"

        );

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function crear($descripcion)
    {

        $stmt = $this->conexion->prepare(

            "INSERT INTO objetos_legalizacion(descripcion) VALUES(?)"

        );

        return $stmt->execute([

            $descripcion

        ]);

    }

    public function actualizar(
        $id,
        $descripcion
    )
    {

        $stmt = $this->conexion->prepare(

            "UPDATE objetos_legalizacion
            SET descripcion=?
            WHERE id=?"

        );

        return $stmt->execute([

            $descripcion,
            $id

        ]);

    }

    public function cambiarEstado(
        $id,
        $estado
    )
    {

        $stmt = $this->conexion->prepare(

            "UPDATE objetos_legalizacion
            SET estado=?
            WHERE id=?"

        );

        return $stmt->execute([

            $estado,
            $id

        ]);

    }

    public function existe($descripcion)
    {

        $stmt = $this->conexion->prepare(

            "SELECT id
            FROM objetos_legalizacion
            WHERE descripcion=?"

        );

        $stmt->execute([

            $descripcion

        ]);

        return $stmt->fetch();

    }

    public function existeActualizar(
        $descripcion,
        $id
    )
    {

        $stmt = $this->conexion->prepare(

            "SELECT COUNT(*)
            FROM objetos_legalizacion
            WHERE descripcion=?
            AND id<>?"

        );

        $stmt->execute([

            $descripcion,
            $id

        ]);

        return $stmt->fetchColumn() > 0;

    }

}
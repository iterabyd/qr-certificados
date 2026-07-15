<?php

require_once __DIR__ . '/../config/database.php';

// Modelo encargado de consultar la tabla estados
class Estado
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    // Listar todos los estados
    public function listar()
    {
        $sql = "
            SELECT
                id,
                codigo,
                descripcion
            FROM estados
            ORDER BY id ASC
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener estado por ID
    public function obtenerPorId($id)
    {
        $sql = "
            SELECT
                id,
                codigo,
                descripcion
            FROM estados
            WHERE id = ?
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
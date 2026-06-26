<?php

require_once __DIR__ . '/../config/database.php';

// Modelo encargado de las operaciones sobre la tabla tipos_documento
class TipoDocumento
{
    private $conexion;

    // Constructor
    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    // Obtener todos los tipos de documento
    public function listar()
    {
        $sql = "
            SELECT *
            FROM tipos_documento
            ORDER BY id DESC
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar un tipo de documento por ID
    public function obtenerPorId($id)
    {
        $sql = "
            SELECT *
            FROM tipos_documento
            WHERE id = ?
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
}
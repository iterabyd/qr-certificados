<?php

require_once __DIR__ . '/../models/Estado.php';

// Controlador encargado de consultar estados
class EstadoController
{
    private $estadoModel;

    public function __construct()
    {
        $this->estadoModel = new Estado();
    }

    // Listar estados
    public function listar()
    {
        return $this->estadoModel->listar();
    }

    // Obtener estado por ID
    public function obtenerPorId($id)
    {
        return $this->estadoModel->obtenerPorId($id);
    }
}
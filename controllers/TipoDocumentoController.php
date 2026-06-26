<?php

require_once __DIR__ . '/../models/TipoDocumento.php';

// Controlador encargado de procesar las solicitudes de tipos de documento
class TipoDocumentoController
{
    private $tipoDocumentoModel;

    public function __construct()
    {
        $this->tipoDocumentoModel = new TipoDocumento();
    }

    // Obtener listado de tipos de documento
    public function listar()
    {
        return $this->tipoDocumentoModel->listar();
    }

    // Obtener un tipo de documento por ID
    public function obtenerPorId($id)
    {
        return $this->tipoDocumentoModel->obtenerPorId($id);
    }

    
}
<?php

require_once __DIR__ . '/../models/ObjetoLegalizacion.php';
require_once __DIR__ . '/../core/Response.php';

class ObjetoLegalizacionController
{

    private $model;

    public function __construct()
    {

        $this->model = new ObjetoLegalizacion();

    }

    public function listar()
    {

        return $this->model->listar();

    }

    public function obtenerPorId($id)
    {

        return $this->model->obtenerPorId($id);

    }

    public function crear()
    {

        $descripcion = trim($_POST['descripcion']);

        if ($this->model->existe($descripcion)) {

            return Response::error(
                'El objeto de legalización ya existe.'
            );

        }

        $this->model->crear($descripcion);

        return Response::success(
            'Objeto de legalización registrado correctamente.'
        );

    }

    public function actualizar()
    {

        $id = $_POST['id'];
        $descripcion = trim($_POST['descripcion']);

        if ($this->model->existeActualizar($descripcion, $id)) {

            return Response::error(
                'El objeto de legalización ya existe.'
            );

        }

        $this->model->actualizar(
            $id,
            $descripcion
        );

        return Response::success(
            'Objeto de legalización actualizado correctamente.'
        );

    }

    public function cambiarEstado()
    {

        $id = $_POST['id'];
        $estado = $_POST['estado'];

        $this->model->cambiarEstado(
            $id,
            $estado
        );

        return Response::success(

            $estado == 1
                ? 'Objeto activado correctamente.'
                : 'Objeto inactivado correctamente.'

        );

    }

}
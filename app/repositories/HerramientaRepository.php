<?php

namespace App\Repositories;

use App\Models\User;

class HerramientaRepository
{
    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function getModel()
    {
        return \App\Herramienta::class;
    }

    public function getHerramientas()
    {
        return $this->model->all();
    }

    public function getHerramienta($id)
    {
        return $this->model->find($id);
    }

    public function createHerramienta($request)
    {
        $herramienta = $this->model->create($request->all());
        return $herramienta;
    }

    public function updateHerramienta($request, $id)
    {
        $herramienta = $this->model->find($id);
        $herramienta->fill($request->all());
        $herramienta->save();
        return $herramienta;
    }

    public function deleteHerramienta($id)
    {
        $herramienta = $this->model->find($id);
        $herramienta->delete();
        return $herramienta;
    }
} {
}

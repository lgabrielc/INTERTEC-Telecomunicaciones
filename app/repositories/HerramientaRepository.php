<?php

namespace App\Repositories;

use App\Models\Herramienta;

class HerramientaRepository extends BaseRepository
{

    public function __construct(Herramienta $herramienta)
    {
        parent::__construct($herramienta);
    }

    public function getByNombre(string $nombre)
    {
        return $this->model->where('nombre', $nombre)->first();
    }  
}

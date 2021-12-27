<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function get($id)
    {
        return $this->model->find($id);
    }

    public function save(Model $model)
    {
        $model->save();
    }
    public function delete(Model $model)
    {
        return $model->delete();
    }
}

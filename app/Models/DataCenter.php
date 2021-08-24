<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCenter extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'ubicacion',
        'direccion',
        'encargado',
    ];
    public $table = 'datacenters';

    //Relaccion uno a muchos olts
    public function olts()
    {
        return $this->hasMany('App\Models\Olt');
    }
}

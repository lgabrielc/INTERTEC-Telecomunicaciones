<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centrodato extends Model
{
    use HasFactory;
    public $table ='centrodatos';
    protected $fillable = [
        'nombre',
        'ubicacion',
        'direccion',
        'encargado',
        'estado_id',
    ];

    //Relaccion uno a muchos olts
    public function olts()
    {
        return $this->hasMany('App\Models\Olt');
    }
    public function estado()
    {
        return $this->belongsTo('App\Models\Estado', 'estado_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descarga',
        'subida',
        'precio',
        'estado_id',
    ];
    public $table = 'planes';

    //Relaccion uno a muchos
    public function servicios()
    {
        return $this->hasMany('App\Models\Servicio');
    }
    public function estado()
    {
        return $this->belongsTo('App\Models\Estado', 'estado_id', 'id');
    }
}

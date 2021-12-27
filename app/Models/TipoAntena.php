<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAntena extends Model
{
    protected $fillable = [
        'nombre',
        'estado_id',
    ];
    public $table = 'tipoantena';
    use HasFactory;

    //Relaccion uno a muchos------------------------------------------
    public function antenas()
    {
        return $this->hasMany('App\Models\Antena');
    }
    public function estado()
    {
        return $this->belongsTo('App\Models\Estado', 'estado_id', 'id');
    }
}

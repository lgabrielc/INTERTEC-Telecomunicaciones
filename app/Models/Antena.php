<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antena extends Model
{
    protected $fillable = [
        'nombre',
        'ip',
        'mac',
        'frecuencia',
        'canal',
        'marca',
        'torre_id',
        'servidor_id',
        'tipoantena_id',
        'estado_id',
     ];
    use HasFactory;
    public $table = 'antenas';
     //Remove uno a uno con servicio
    public function servicio() {
        return $this->hasOne('App\Models\Servicio');
    }
    //Relación uno a muchos (inversa)
    public function torre(){
        return $this->belongsTo('App\Models\Torre');
    }
    public function servidor(){
        return $this->belongsTo('App\Models\Servidor');
    }
    public function tipoantena(){
        return $this->belongsTo('App\Models\Tipoantena');
    }
    public function estado()
    {
        return $this->belongsTo('App\Models\Estado', 'estado_id', 'id');
    }

}

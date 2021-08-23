<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $fillable = [
        'fechaInicio',
        'fechaVencimiento',
        'fechaCorte',
        'tiposervicio',
        'condicionAntena',
        'mac',
        'ip',
        'frecuencia',
        'clientegpon',
        'gponrelacionado',
        //Este debería de ser gpon_id pero aún no hay la tabla gpon
        'estado_id',
        'cliente_id',
        'antena_id',
        'plan_id',
    ];
    public $table = 'servicios';
    //Relacion uno a uno con cliente 
    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }
    public function antena()
    {
        return $this->belongsTo('App\Models\Antena', 'antena_id', 'id');
    }
    //Relacion uno a muchos (inversa)
    public function estado()
    {
        return $this->belongsTo('App\Models\Estado');
    }
    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $fillable = [
        'fechainicio',
        'fechavencimiento',
        'fechacorte',
        'fechacorteejecutado',
        'fechacongelado',
        'tiposervicio',
        'condicionAntena',
        'mac',
        'ip',
        'frecuencia',
        'deuda',
        'clientegpon',
        'cliente_id',
        'antena_id',
        'plan_id',
        'nap_id',
        'estado_id',
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
        return $this->belongsTo('App\Models\Estado', 'estado_id', 'id');
    }
    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }
    public function nap()
    {
        return $this->belongsTo('App\Models\Nap');
    }
}

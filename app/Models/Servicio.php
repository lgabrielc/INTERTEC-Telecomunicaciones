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
        'condicionAntena',
        'mac',
        'ip',
        'frecuencia',
        'estado_id',
        'cliente_id',
        'antena_id'
     ];
    public $table = 'servicios';
    //Relacion uno a uno con cliente 
    public function cliente(){
        return $this->belongsTo('App\Models\Cliente','cliente_id','id');
    }
    public function antena(){
        return $this->belongsTo('App\Models\Antena','antena_id','id');
    }    
    //Relacion uno a muchos (inversa)
    public function estado(){
        return $this->belongsTo('App\Models\Estado');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'correo'
     ];
    public $table = 'clientes';
    //Relacion uno a uno con servicio
    public function servicio() {
        return $this->hasOne('App\Models\Servicio');
    }
    //Relacion uno a muchos con Pagos
    public function pagos(){
        return $this->hasMany('App\Models\Pago');
    }
    //Relacion 1 a 1 polimorfica con direccion
    public function direccion(){
        return $this->morphOne('App\Models\Direccion','direcciones');
    }
    //Relacion uno a muchos polimorfica con telefono
    public function telefono(){
        return $this->morphMany('App\Models\Telefono','telefono');
    }
}
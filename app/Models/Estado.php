<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre'
     ];
    public $table = 'estados';

    //Relacion uno a uno
    
    //Relaccion uno a muchos
    public function servicios(){
        return $this->hasMany('App\Models\Servicio');
    }

    public function datacenters()
    {
        return $this->hasMany('App\Models\Datacenter');
    }
    public function olts()
    {
        return $this->hasMany('App\Models\Olt');
    }
    public function antenas()
    {
        return $this->hasMany('App\Models\Antena');
    }
    public function gpons()
    {
        return $this->hasMany('App\Models\Gpon');
    }
    public function naps()
    {
        return $this->hasMany('App\Models\Nap');
    }
    public function planes()
    {
        return $this->hasMany('App\Models\Plan');
    }
    public function servidores()
    {
        return $this->hasMany('App\Models\Servidor');
    }
    public function tarjetas()
    {
        return $this->hasMany('App\Models\Tarjeta');
    }
    public function tipoantenas()
    {
        return $this->hasMany('App\Models\TipoAntena');
    }
    public function torres()
    {
        return $this->hasMany('App\Models\Torre');
    }


}

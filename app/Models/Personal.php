<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'user_id'
     ];
    public $table = 'personal';

    //Relacion uno a uno con users
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torre extends Model
{
    public $table = "torres";
    use HasFactory;
    protected $fillable = [
        'nombre',
        'dueño',
        'mensualidad',
     ];
    //Relaccion uno a muchos
    public function antenas(){
        return $this->hasMany('App\Models\Antena');
    }


    //Relacion 1 a 1 polimorfica con direccion
    public function direccion(){
        return $this->morphMany('App\Models\Direccion','direccion');
    }
    //Relacion uno a muchos polimorfica con telefono
    public function telefono(){
        return $this->morphMany('App\Models\Telefono','telefono');
    }    
}

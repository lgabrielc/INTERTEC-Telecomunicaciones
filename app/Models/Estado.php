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

}

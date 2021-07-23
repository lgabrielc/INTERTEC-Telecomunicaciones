<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    protected $fillable = [
        'nombre',
        'ipEntrada',
        'ipSalida'
     ];
    public $table = 'servidores';
    use HasFactory;
    //Relaccion uno a muchos
    public function antenas(){
        return $this->hasMany('App\Models\Antena');
    }
}

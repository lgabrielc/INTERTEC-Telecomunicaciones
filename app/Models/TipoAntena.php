<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAntena extends Model
{
    protected $fillable = [
        'nombre'
     ];
    public $table = 'tipoantena';
    use HasFactory;
    
    //Relaccion uno a muchos------------------------------------------
    public function antenas(){
        return $this->hasMany('App\Models\Antena');
    }    
}

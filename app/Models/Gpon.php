<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpon extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'slots',
        'tarjeta_id',
    ];
    public $table = 'gpons';

    //Pertenece a una tarjeta relacion uno a muchos inversa
    public function tarjeta()
    {
        return $this->belongsTo('App\Models\Tarjeta');
    }
    //Tiene muchas cajas naps relación uno a muchos inversa
    public function naps()
    {
        return $this->hasMany('App\Models\Naps');
    }
}

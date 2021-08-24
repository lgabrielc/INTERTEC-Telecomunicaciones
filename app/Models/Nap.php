<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nap extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'slots',
        'gpon_id',
    ];
    public $table = 'naps';

    //Pertenece a un gpon relacion uno a muchos
    public function gpon()
    {
        return $this->belongsTo('App\Models\Gpon');
    }

    public function servicios()
    {
        return $this->hasMany('App\Models\Servicio');
    }
}

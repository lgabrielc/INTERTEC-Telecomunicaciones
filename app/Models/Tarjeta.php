<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'slots',
        'olt_id',
        'estado_id',
    ];
    public $table = 'tarjetas';

    //Relación uno a muchos
    public function olt()
    {
        return $this->belongsTo('App\Models\Olt');
    }
    public function gpons()
    {
        return $this->hasMany('App\Models\Gpon');
    }
    public function estado()
    {
        return $this->belongsTo('App\Models\Estado', 'estado_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olt extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'slots',
        'modelo',
        'marca',
        'datacenter_id',
        'estado_id',
    ];
    public $table = 'olts';

    //Relacion con Datacenter uno a muchos inversa
    public function datacenter()
    {
        return $this->belongsTo('App\Models\Datacenter','datacenter_id','id');
    }
    //Relacion con Tarjetas uno a muchos inversa
    public function tarjetas()
    {
        return $this->hasMany('App\Models\Tarjeta');
    }
    public function estado()
    {
        return $this->belongsTo('App\Models\Estado', 'estado_id', 'id');
    }
}

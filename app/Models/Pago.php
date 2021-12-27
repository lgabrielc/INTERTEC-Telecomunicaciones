<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'monto',
        'periodo',
        'cliente_id',
        'user_id',
     ];
    public $table = 'pagos';
    //Relacion uno a muchos inversa con users
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function cliente(){
        return $this->belongsTo('App\Models\Cliente');
    }
}

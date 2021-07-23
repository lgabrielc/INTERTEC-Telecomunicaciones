<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    protected $fillable = [
        'direccion',
        'direcciones_id',
        'direcciones_type',
     ];
    public $table = 'direcciones';

    //relacion 1 a 1 polimorfica
    public function direcciones(){
        return $this->morphTo();
    }
}

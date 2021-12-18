<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    use HasFactory;
    public $table ='herramientas';
    protected $fillable = [
        'nombre',
        'descripcion',
        'stock',
        'precio',
    ];
}

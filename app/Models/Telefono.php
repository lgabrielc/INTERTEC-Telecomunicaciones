<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $fillable = [
        'numero',
        'telefono_id',
        'telefono_type'
     ];
    use HasFactory;

    public function telefono(){
        return $this->morphTo();
    }
}

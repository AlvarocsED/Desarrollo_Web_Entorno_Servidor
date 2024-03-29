<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table='reserva';
    function viajes(){
        return this->belongsto(Viajes::class, 'id');
    }
}

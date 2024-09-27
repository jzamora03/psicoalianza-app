<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombres',
        'apellidos',
        'identificacion',
        'telefono',
        'ciudad',
        'departamento',
        'direccion'
    ];
 }

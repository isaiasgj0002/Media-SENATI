<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajos extends Model
{
    protected $table = "trabajos";
    protected $primarykey = "id";

    public $timestamps = false;

    protected $fillable=[
        'empresa',
        'puesto',
        'ciudad',
        'pais',
        'fecha_inicio',
        'fecha_fin',
        'id_usuario'
    ];

    protected $guarded=[

    ];
}

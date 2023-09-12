<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudios extends Model
{
    protected $table = "estudios";
    protected $primarykey = "id";

    public $timestamps = false;

    protected $fillable=[
        'nombre',
        'escuela',
        'ciudad',
        'pais',
        'fecha_inicio',
        'fecha_fin',
        'id_usuario'
    ];

    protected $guarded=[

    ];
}

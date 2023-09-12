<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = "comentario";
    protected $primarykey = "id";

    public $timestamps = false;

    protected $fillable=[
        'id_usuario',
        'id_video',
        'comentario'
    ];

    protected $guarded=[

    ];
}

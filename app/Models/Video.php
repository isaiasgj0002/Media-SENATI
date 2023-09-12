<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $primarykey = "id";
    public $timestamps = false;
    protected $fillable=[
        'ruta_video',
        'id_usuario'
    ];

    protected $guarded=[

    ];
}

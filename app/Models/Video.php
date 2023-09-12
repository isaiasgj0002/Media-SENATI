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
        'titulo',
        'descripcion',
        'ruta_video',
        'id_usuario'
    ];

    protected $guarded=[

    ];
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_video');
    }
}

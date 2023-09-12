<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Solicitudes extends Model
{
    protected $table = "solicitudes";
    protected $primarykey = "id";

    public $timestamps = false;

    protected $fillable=[
        'id_usuario_enviar',
        'id_usuario_recibir'
    ];

    protected $guarded=[

    ];
    public function usuarioEmisor()
    {
        return $this->belongsTo(User::class, 'id_usuario_enviar');
    }
}

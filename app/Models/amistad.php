<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class amistad extends Model
{
    protected $table = "amistad";
    protected $primarykey = "id";

    public $timestamps = false;

    protected $fillable=[
        'id_usuario1',
        'id_usuario2'
    ];

    protected $guarded=[

    ];
    public function usuario1()
    {
        return $this->belongsTo(User::class, 'id_usuario1');
    }

    public function usuario2()
    {
        return $this->belongsTo(User::class, 'id_usuario2');
    }
}

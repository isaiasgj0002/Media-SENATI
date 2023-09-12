<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Video;
use App\Models\Trabajos;
use App\Models\Estudios;
use App\Models\Solicitudes;
use App\Models\amistad;

class UserPerfilController extends Controller
{
    public function index($id)
    {
        $usuario = User::findOrfail($id);
        $videos = Video::where('id_usuario', $usuario->id)->get();
        $trabajo = Trabajos::where('id_usuario', $usuario->id)->first();
        $estudio = Estudios::where('id_usuario', $usuario->id)->first();
        $existeS = false;
        $solicitudExiste = Solicitudes::where('id_usuario_recibir', $usuario->id)
            ->where('id_usuario_enviar', auth()->user()->id)
            ->exists();
        $solicitudExiste2 = Solicitudes::where('id_usuario_enviar', $usuario->id)
            ->where('id_usuario_recibir', auth()->user()->id)
            ->exists();
        if($solicitudExiste){
            $existeS = true;
        }
        elseif($solicitudExiste2){
            $existeS = true;
        }
        $usuarioActualId = auth()->user()->id;
        $usuarioPerfilId = $usuario->id;
        $existeAmistad = amistad::where(function ($query) use ($usuarioActualId, $usuarioPerfilId) {
            $query->where('id_usuario1', $usuarioActualId)
                  ->where('id_usuario2', $usuarioPerfilId);
        })->orWhere(function ($query) use ($usuarioActualId, $usuarioPerfilId) {
            $query->where('id_usuario1', $usuarioPerfilId)
                  ->where('id_usuario2', $usuarioActualId);
        })->exists();
        return view('perfil.userperfil', compact('usuario', 'videos', 'trabajo', 'estudio', 'existeS', 'existeAmistad'));
    }
}

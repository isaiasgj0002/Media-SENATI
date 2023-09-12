<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Trabajos;
use App\Models\Estudios;


class PerfilController extends Controller
{
    public function index()
    {
        $usuario = auth()->user();

        $videos = Video::where('id_usuario', $usuario->id)->get();
        $trabajo = Trabajos::where('id_usuario', $usuario->id)->first();
        $estudio = Estudios::where('id_usuario', $usuario->id)->first();

        return view('perfil.perfil', compact('usuario', 'videos', 'trabajo', 'estudio'));
    }
}

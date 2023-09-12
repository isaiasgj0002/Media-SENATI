<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudios;
use App\Models\Trabajos;
use App\Models\Video;
use App\Models\Solicitudes;
use App\Models\amistad;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $estudiosExists = Estudios::where('id_usuario', $user->id)->exists();
        $trabajosExists = Trabajos::where('id_usuario', $user->id)->exists();
        $videos = Video::all();
        $videos->load('comentarios');
        $solicitudesRecibidas = Solicitudes::where('id_usuario_recibir', $user->id)
            ->with('usuarioEmisor')
            ->get();

        $usuarioAutenticadoId = auth()->user()->id;
        $amigos = amistad::where('id_usuario1', $usuarioAutenticadoId)
            ->orWhere('id_usuario2', $usuarioAutenticadoId)
            ->with(['usuario1', 'usuario2'])
            ->get();
        return view('home', compact('estudiosExists', 'trabajosExists', 'videos', 'solicitudesRecibidas', 'amigos'));
    }
}

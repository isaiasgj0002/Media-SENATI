<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitudes;
use App\Models\User;
use App\Models\amistad;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class SolicitudController extends Controller
{
    public function enviar($id){
        $usuario = User::findOrfail($id);
        $solicitud = new Solicitudes();
        $solicitud->id_usuario_enviar = auth()->user()->id;
        $solicitud->id_usuario_recibir = $usuario->id;
        $solicitud->save();
        Session::flash('status', 'Se envio la solicitud');
        return Redirect::to('/perfil/'.$usuario->id);
    }
    public function aceptar($id){
        $solicitud = Solicitudes::findOrFail($id);
        $amigo = new amistad();
        $amigo->id_usuario1 = $solicitud->id_usuario_enviar;
        $amigo->id_usuario2 = $solicitud->id_usuario_recibir;
        $amigo->save();
        $solicitud->delete();
        Session::flash('status', 'Se aceptó la solicitud');
        return Redirect::to('/home');
    }
    public function rechazar($id){
        $solicitud = Solicitudes::findOrFail($id);
        $solicitud->delete();
        Session::flash('status', 'Se rechazó la solicitud');
        return Redirect::to('/home');
    }
}

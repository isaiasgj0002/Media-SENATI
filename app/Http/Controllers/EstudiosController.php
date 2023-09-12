<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudios;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class EstudiosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request){
        $validate = $this->validate($request, [
            'nombre'=>'required',
            'escuela'=>'required',
            'ciudad'=>'required',
            'pais'=>'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required'
        ]);
        $estudios = new Estudios();
        $estudios->nombre = $request->get('nombre');
        $estudios->escuela = $request->get('escuela');
        $estudios->ciudad = $request->get('ciudad');
        $estudios->pais = $request->get('pais');
        $estudios->fecha_inicio = $request->get('fecha_inicio');
        $estudios->fecha_fin = $request->get('fecha_fin');
        $estudios->id_usuario = auth()->user()->id;
        $estudios->save();
        Session::flash('status', 'Se actualizó su perfil');
        return Redirect::to('/home');
    }
}

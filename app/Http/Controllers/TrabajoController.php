<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajos;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class TrabajoController extends Controller
{
    public function store(Request $request){
        $validate = $this->validate($request, [
            'empresa'=>'required',
            'puesto'=>'required',
            'ciudad'=>'required',
            'pais'=>'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required'
        ]);
        $trabajo = new Trabajos();
        $trabajo->empresa = $request->get('empresa');
        $trabajo->puesto = $request->get('puesto');
        $trabajo->ciudad = $request->get('ciudad');
        $trabajo->pais = $request->get('pais');
        $trabajo->fecha_inicio = $request->get('fecha_inicio');
        $trabajo->fecha_fin = $request->get('fecha_fin');
        $trabajo->id_usuario = auth()->user()->id;
        $trabajo->save();
        Session::flash('status', 'Se actualizó su perfil');
        return Redirect::to('/home');
    }
    public function update(Request $request, $id){
        $validate = $this->validate($request, [
            'empresa'=>'required',
            'puesto'=>'required',
            'ciudad'=>'required',
            'pais'=>'required'
        ]);
        $trabajo = Trabajos::findOrFail($id);
        $trabajo->empresa = $request->get('empresa');
        $trabajo->puesto = $request->get('puesto');
        $trabajo->ciudad = $request->get('ciudad');
        $trabajo->pais = $request->get('pais');
        $trabajo->fecha_inicio = $request->get('fecha_inicio');
        $trabajo->fecha_fin = $request->get('fecha_fin');
        $trabajo->id_usuario = auth()->user()->id;
        $trabajo->update();
        Session::flash('status', 'Se actualizo su perfil');
        return Redirect::to('/perfil');
    }
}

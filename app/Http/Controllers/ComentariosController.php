<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ComentariosController extends Controller
{
    public function create(Request $request){
        $validate = $this->validate($request, [
            'comentario'=>'required|max:800',
        ]);
        $comentario = new Comentario();
        $comentario->comentario = $request->get('comentario');
        $comentario->id_video = $request->get('id_video');
        $comentario->id_usuario = auth()->user()->id;
        $comentario->save();
        Session::flash('status', 'Se publico su comentario');
        return Redirect::to('/home');
    }
}

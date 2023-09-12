<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;


class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('video.create');
    }
    public function store(Request $request){
        $validate = $this->validate($request, [
            'titulo'=>'required',
            'descripcion'=>'required',
            'video'=>'required|mimes:mp4'
        ]);
        $videoArchivo = $request->file('video');
        $rutaArchivo = $videoArchivo->store('videos', 'public');
        $video = new Video();
        $video->titulo = $request->get('titulo');
        $video->descripcion = $request->get('descripcion');
        $video->ruta_video = $rutaArchivo;
        $video->id_usuario = auth()->user()->id;
        $video->save();
        Session::flash('status', 'Se publico el video');
        return Redirect::to('/home');
    }
}

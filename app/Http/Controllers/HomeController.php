<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudios;
use App\Models\Trabajos;
use App\Models\Video;
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
        return view('home', compact('estudiosExists', 'trabajosExists', 'videos'));
    }
}

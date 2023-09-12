@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Perfil de {{ $usuario->username }}</h1>
            @if ($usuario->id != auth()->user()->id && !$existeS && !$existeAmistad)
                <a class="btn btn-primary" href="{{route('enviar.solicitud',$usuario->id)}}">Enviar solicitud</a>
            @endif
            @if ($existeAmistad)
                <span>Ya eres amigo de: {{ $usuario->username }}</span>
            @endif
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                @if ($estudio)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Estudios del usuario</h5>
                            <ul class="list-group">
                                <li class="list-group-item">Nombre de Estudios: {{$estudio->nombre}}</li>
                                <li class="list-group-item">Escuela: {{$estudio->escuela}}</li>
                                <li class="list-group-item">Ciudad: {{$estudio->ciudad}}</li>
                                <li class="list-group-item">País: {{$estudio->pais}}</li>
                                <li class="list-group-item">Fecha de Inicio: {{$estudio->fecha_inicio}}</li>
                                <li class="list-group-item">Fecha de Fin: {{$estudio->fecha_fin}}</li>
                            </ul>
                        </div>
                    </div>

                </div>
                @endif
                @if ($trabajo)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Trabajo del usuario</h5>
                            <ul class="list-group">
                                <li class="list-group-item">Empresa: {{$trabajo->empresa}}</li>
                                <li class="list-group-item">Puesto: {{$trabajo->puesto}}</li>
                                <li class="list-group-item">Ciudad: {{$trabajo->ciudad}}</li>
                                <li class="list-group-item">País: {{$trabajo->pais}}</li>
                                <li class="list-group-item">Fecha de Inicio: {{$trabajo->fecha_inicio}}</li>
                                <li class="list-group-item">Fecha de Fin: {{$trabajo->fecha_fin}}</li>
                            </ul>
                        </div>
                    </div>

                </div>
                @endif
            </div>
            <div class="row" style="margin-top: 30px">
                <div class="col-lg-8">
                    <h1>Videos</h1>
                    @foreach ($videos as $item)
                        <div class="card">
                            <div class="card-header">
                                <h1>{{$item->titulo}}</h1>
                            </div>
                            <div class="card-body">
                                <video controls width="400" height="300">
                                    <source src="{{ asset('storage/' . $item->ruta_video) }}" type="video/mp4">
                                    Tu navegador no admite el elemento de video.
                                </video>
                                <p>{{$item->descripcion}}</p>
                            </div>
                            @if ($existeAmistad)
                                <form style="margin-top: 10px" action="{{route('create.comentario')}}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" name="comentario" placeholder="Escriba un comentatio">
                                    <input type="hidden" name="id_video" value="{{$item->id}}">
                                    <input type="submit" class="btn btn-primary" style="margin-top: 10px" value="Comentar">
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

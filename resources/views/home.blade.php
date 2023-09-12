@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!$estudiosExists && !$trabajosExists)
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Soy estudiante</h4>
                                <form action="{{route('estudios')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre de los estudios">
                                    </div>
                                    <div class="form-group mt-8">
                                        <input type="text" class="form-control" name="escuela" placeholder="Escuela donde los realizaste">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ciudad" placeholder="Ciudad donde los realizaste">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="pais" placeholder="País donde los realizaste">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="fecha_inicio">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="fecha_fin">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="Completar perfil">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h4>Soy trabajador</h4>
                                <form action="{{route('trabajos')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="empresa" placeholder="Empresa donde trabajaste">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="puesto" placeholder="Puesto">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="ciudad" placeholder="Ciudad donde trabajaste">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="pais" placeholder="País donde trabajaste">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="fecha_inicio">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="fecha_fin">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="Completar perfil">
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="{{route('index.video')}}">Publicar video</a>
                            @foreach ($videos as $item)
                                <div class="card">
                                    <div class="card-header">
                                        <h1>{{$item->titulo}}</h1>
                                        @if ($item->id_usuario==auth()->user()->id)
                                            <a class="btn btn-danger">Eliminar</a>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <video controls width="400" height="300">
                                            <source src="{{ asset('storage/' . $item->ruta_video) }}" type="video/mp4">
                                            Tu navegador no admite el elemento de video.
                                        </video>
                                        <p>{{$item->descripcion}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

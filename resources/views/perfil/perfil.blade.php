@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <h1>Perfil de {{ $usuario->username }}</h1>
            <div class="row">
                @if ($estudio)
                <div class="col-md-6">
                    <h4>Estudios</h4>
                    <form action="{{route('update.estudios',$estudio->id)}}" method="POST">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre de los estudios" value="{{$estudio->nombre}}">
                        </div>
                        <div class="form-group mt-8">
                            <input type="text" class="form-control" name="escuela" placeholder="Escuela donde los realizaste" value="{{$estudio->escuela}}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="ciudad" placeholder="Ciudad donde los realizaste" value="{{$estudio->ciudad}}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="pais" placeholder="País donde los realizaste" value="{{$estudio->pais}}">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="fecha_inicio" value="{{$estudio->fecha_inicio}}">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="fecha_fin" value="{{$estudio->fecha_fin}}">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Actualizar perfil">
                        </div>
                    </form>
                </div>
                @endif
                @if ($trabajo)
                <div class="col-md-6">
                    <h4>Trabajo:</h4>
                    <form action="{{route('update.trabajos', $trabajo->id)}}" method="POST">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="form-group">
                            <input type="text" class="form-control" name="empresa" placeholder="Empresa donde trabajaste" value="{{$trabajo->empresa}}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="puesto" placeholder="Puesto" value="{{$trabajo->puesto}}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="ciudad" placeholder="Ciudad donde trabajaste" value="{{$trabajo->ciudad}}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="pais" placeholder="País donde trabajaste" value="{{$trabajo->pais}}">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="fecha_inicio">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="fecha_fin">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Actualizar Perfil">
                        </div>
                    </form>
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
                                @if ($item->id_usuario==auth()->user()->id)
                                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$item->id}}">Eliminar</a>
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
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal-{{$item->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <form method="POST" action="{{ route('destroy.video',$item->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Eliminar video</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de que deseas eliminar el video?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

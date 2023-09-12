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
                    <div class="container">
                        <h1>Solicitudes Recibidas</h1>

                        @if ($solicitudesRecibidas->isEmpty())
                            <p>No tienes solicitudes recibidas.</p>
                        @else
                            <ul>
                                @foreach ($solicitudesRecibidas as $solicitud)
                                    <li>
                                        <strong>De: {{ $solicitud->usuarioEmisor->username }}</strong><br>
                                        <a href="{{route('aceptar.solicitud',$solicitud->id)}}">Aceptar</a><br>
                                        <a href="{{route('rechazar.solicitud',$solicitud->id)}}">Rechazar</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="container">
                                <a class="btn btn-primary" href="{{route('index.video')}}">Publicar video</a>
                            </div>
                            @foreach ($videos as $item)
                                <div class="card">
                                    <div class="card-header">
                                        <h1>{{$item->titulo}}</h1>
                                        <p>Publicado por: <a href="{{route('index.userpefil', $item->usuario->id)}}">{{ $item->usuario->username }}</a></p>
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
    </div>
</div>
@endsection

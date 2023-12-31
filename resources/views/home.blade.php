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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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
                    <div class="container">
                        <h1>Amigos agregados</h1>
                        @if ($amigos->isEmpty())
                            <p>No tienes amigos.</p>
                        @endif
                        @foreach ($amigos as $amistad)
                            @if ($amistad->id_usuario1 == auth()->user()->id)
                                <li><a href="{{route('index.userpefil', $amistad->usuario2->id)}}">{{ $amistad->usuario2->username }}</a></li>
                            @else
                                <li><a href="{{route('index.userpefil', $amistad->usuario1->id)}}">{{ $amistad->usuario1->username }}</a></li>
                            @endif
                        @endforeach
                    </div>
                    <div class="row" style="margin-top: 50px">
                        <div class="col-lg-8">
                            <div class="container" style="margin-bottom: 20px">
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
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#commentsModal-{{$item->id}}">
                                            Ver comentarios
                                        </button>
                                    </div>
                                </div>
                                <!-- Modal COMENTARIOS-->
                                <div class="modal fade" id="commentsModal-{{$item->id}}" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="commentsModalLabel">Comentarios</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                                <ul>
                                                    @foreach ($item->comentarios as $comentario)
                                                        <li>{{ $comentario->comentario }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
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

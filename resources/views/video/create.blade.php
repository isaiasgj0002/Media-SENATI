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
                <div class="card">
                    <div class="card-header">Crear video</div>
                    <div class="card-body">
                        <form action="{{route('create.video')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="titulo" placeholder="Titulo del video">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="descripcion" placeholder="Descripcion corta del video">
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control" name="video">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Publicar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('options')
<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{route('productos.create')}}">Crear Producto</a>
    </li>
</ul>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista de Productos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($productos as $producto)
                            <div class="col">
                                <div class="card h-100">
                                    <img src="{{asset('imgs/'.$producto->imagen)}}" class="card-img-top" style="width: 100%;height: 15vw; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$producto->nombre}}</h5>
                                        <p class="card-text text-muted">{{$producto->descripcion}}</p>
                                        <h6 class="text-success">$ {{$producto->precio}}</h6>
                                      </div>
                                      <div class="card-footer">
                                        <small class="text-muted">Creado {{$producto->created_at->diffForHumans()}}</small><br>
                                        <form action="{{route('productos.destroy', $producto)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="{{route('productos.edit', $producto)}}" class='btn btn-warning'><i class='fas fa-redo'></i></a>
                                            <button class='btn btn-danger'><i class='fas fa-trash'></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('productos.update', $producto)}}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('put')
        <label class="form-label">
            Nombre del producto<br>
            <input class="form-control" type="text" name="nombre" value="{{old('nombre', $producto->nombre)}}">
        </label><br>

        @error('nombre')
            <small style="color: red">*{{$message}}</small>
        <br><br>
        @enderror

        <label class="form-label">
            Descripción del producto<br>
            <textarea class="form-control" name="descripcion" cols="20" rows="5">{{old('nombre', $producto->descripcion)}}</textarea>
        </label><br>

        @error('descripcion')
            <small style="color: red">*{{$message}}</small>
        <br><br>
        @enderror

        <label class="form-label">
            Precio del Producto<br>
            <input class="form-control" type="number" name="precio" step="0.01" min="0"  value="{{old('precio', $producto->precio)}}">
        </label><br>

        @error('precio')
            <small style="color: red">*{{$message}}</small>
            <br><br>
        @enderror

        <label class="form-label">
            Imagen del Producto<br>
            <input class="form-control" type="file" name="imagen" value="{{old('imagen', $producto->imagen)}}">
        </label><br>

        @error('imagen')
            <small style="color: red">*{{$message}}</small>
            <br><br>
        @enderror

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
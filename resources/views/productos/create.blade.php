@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('productos.store')}}" enctype="multipart/form-data" method="POST">
        @csrf
        <label class="form-label">
            Nombre del producto<br>
            <input class="form-control" type="text" name="nombre" value="{{old('nombre')}}">
        </label><br>

        @error('nombre')
            <small style="color: red">*{{$message}}</small>
        <br><br>
        @enderror

        <label class="form-label">
            Descripción del producto<br>
            <textarea class="form-control" name="descripcion" cols="20" rows="5">{{old('descripcion')}}</textarea>
        </label><br>

        @error('descripcion')
            <small style="color: red">*{{$message}}</small>
        <br><br>
        @enderror

        <label class="form-label">
            Precio del Producto<br>
            <input class="form-control" type="number" name="precio" step="0.01" min="0"  value="{{old('precio')}}">
        </label><br>

        @error('precio')
            <small style="color: red">*{{$message}}</small>
            <br><br>
        @enderror

        <label class="form-label">
            Imagen del Producto<br>
            <input class="form-control" type="file" name="imagen" value="{{old('imagen')}}">
        </label><br>

        @error('imagen')
            <small style="color: red">*{{$message}}</small>
            <br><br>
        @enderror

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
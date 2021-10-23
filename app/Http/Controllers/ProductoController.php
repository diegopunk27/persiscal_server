<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoCreateRequest;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(){
        //return "Cursos";
        $productos= Producto::orderBy('id', 'desc')->get();
        //return $productos;

        return view("productos.index", compact("productos"));
    }

    public function create(){
        return view("productos.create");
    }

    public function store(ProductoCreateRequest $req){
        /*$producto= Producto::create($req->all());
        return redirect()->route("productos.index");*/
        if($req->has("imagen")){
            $image= $req->file('imagen');
            $reimage= time().'.'.$image->extension();
            $image->move(public_path('/imgs'), $reimage);
        }else{
            $reimage= "no_image.png";
        }
        $producto= new Producto();
        $producto->nombre= $req->nombre;
        $producto->descripcion= $req->descripcion;
        $producto->precio= $req->precio;
        $producto->imagen= $reimage;
        $producto->save();
        return redirect()->route("productos.index");
    }

    public function show(Producto $curso){
    }

    public function edit(Producto $producto){
        return view("productos.edit", compact('producto'));
    }

    public function update(ProductoCreateRequest $req, Producto $producto){
        /*$producto->update($req->all());

        return $producto;*/
        //return redirect()->route("productos.index");
        if($req->has("imagen")){
            $image= $req->file('imagen');
            $reimage= time().'.'.$image->extension();
            $image->move(public_path('/imgs'), $reimage);
           
            $producto->nombre= $req->nombre;
            $producto->descripcion= $req->descripcion;
            $producto->precio= $req->precio;
            $producto->imagen= $reimage;
            
        }else{
            $producto->nombre= $req->nombre;
            $producto->descripcion= $req->descripcion;
            $producto->precio= $req->precio;
        }
        $producto->save();
        return redirect()->route("productos.index");
    }

    public function destroy(Producto $producto){
        $producto->delete();
        return redirect()->route('productos.index');
    }
}

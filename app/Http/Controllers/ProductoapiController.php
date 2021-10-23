<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoapiController extends Controller
{
    public function index(){
        $productos= Producto::orderBy('id', 'desc')->get();
        foreach($productos as $producto){
            //$producto->imagen= env('APP_URL').":8000/imgs/".$producto->imagen;
            $producto->imagen= "http://".env('IP_LOCAL')."/imgs/".$producto->imagen;
            //$producto->imagen= "http://".$_SERVER['REMOTE_ADDR']."/imgs/".$producto->imagen;
        }
        //$productos->imagen= public_path().'/'.$productos->imagen;
        return $productos;
        //return $productos;
    }

    public function create(){        
    }

    public function store(Request $req){
        $reglas=array('nombre' => 'required|max:20',
        'descripcion' => 'required|min:10|max:100',
        'precio' => 'required',
        'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048');
        $validacion= Validator::make($req->all(), $reglas);
        if($validacion->fails()){
            return response()->json(["result"=>$validacion->errors()], 402);
        }else{
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
            try{
                $resultado= $producto->save();
            }
                catch(\Exception $e){
                return response()->json(["result"=>"Se produjo un error, consulte con el administrador"],400); 
             }
            if($resultado){
                return ["result"=>"El producto fue almacenado"];
            }else{
                return response()->json(["result"=>"Se produjo un error, consulte con el administrador"],400);
            }
        }
        
    }

    public function show($id){
        try{
            $resultado= Producto::find($id);
            //$resultado->imagen= env('APP_URL').":8000/imgs/".$resultado->imagen;
            $resultado->imagen= "http://".env('IP_LOCAL')."/imgs/".$resultado->imagen;
        }
            catch(\Exception $e){
            return response()->json(["result"=>"Se produjo un error, consulte con el administrador"],400); 
         }
        if($resultado){
            return $resultado;
        }else{
            return response()->json(["result"=>"Se produjo un error, consulte con el administrador"],400);
        }     
    }

    public function edit(){
    }

    public function update(){
    }

    public function destroy(){
    }
}

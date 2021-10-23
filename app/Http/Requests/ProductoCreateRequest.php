<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|max:20',
            'descripcion' => 'required|min:10|max:100',
            'precio' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

        /* 
        Permite personalizar como se muestran los nombres de los campos en la validación
    */
    public function attributes(){
        return [
            'nombre' => 'nombre del producto',
            'descripcion' => 'descripcion del producto',
            'precio' => 'precio del producto',
            'imagen' => 'imagen del producto',
        ];
    }

    /* 
        Permite personalizar los mensajes que se muestran segun el campo y el tipo de validacion
    */
    public function messages()
    {
        return [
            'descripcion.required' => 'La descripcion del producto es un campo obligatorio',
            'descripcion.min' => 'La descripcion del producto debe contener al menos 10 caracteres',
            'descripcion.max' => 'La descripcion del producto no debe contener más de 100 caracteres',
            'nombre.required' => 'El nombre del producto es es un campo obligatorio',
            'nombre.max' => 'El nombre del producto no debe contener más de 20 caracteres',
            'precio.required' => 'El precio del producto es un campo obligatorio',
        ];
    }
}

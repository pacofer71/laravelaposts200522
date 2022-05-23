<?php

namespace App\Http\Controllers\mail;

use App\Http\Controllers\Controller;
use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function pintarFormulario(){
        return view('contacto.index');
    }

    public function procesarFormulario(Request $request){
        $request->validate([
            'contenido'=>['required', 'string', 'min:5']
        ]);
        $correo = new ContactoMailable(ucfirst($request->contenido), auth()->user()->email);
        try{
            Mail::to('adminapp@correo.es')->send($correo);
            return redirect()->route('posts.index')->with('info', "Correo Enviado");
        }catch(\Exception $ex){
            return redirect()->route('posts.index')->with('info', "No se pudo enviar su correo, inténtelo más tarde.");
        }


    }
}

<?php

use App\Models\Idioma;

 class IdiomaController extends Controller
{
     public function index()
     {
         $idiomas = Idioma::where('ativo', true)->get();

         return view('idiomas.gestao', compact('idiomas'));
     }
}

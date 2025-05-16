<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    public function index()
    {
        $idiomas = Idioma::where('ativo', true)->get();
        return view('idiomas.gestao', compact('idiomas'));
    }
}

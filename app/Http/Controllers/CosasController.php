<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CosasController extends Controller
{

    public function index($pagina, $pagina2 = null)
    {
        return view('Cosa.Cosas2', [
            'pagina' => $pagina,
            'pagina2' => $pagina2,
        ]);
    }
    public function show()
    {
        return view('Cosa.Cosas');
    }
    public function create()
    {
        return "crear";
    }

}
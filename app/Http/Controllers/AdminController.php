<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsalmOfTheWeek; // <-- Añadido

class AdminController extends Controller
{
    public function create($pagina)
    {
        return view($pagina, [        ]);
    }

    public function dashboard()
    {
        $images = \App\Models\Gallery::all();
        $users = \App\Models\User::all();
        return view('admin.dashboard', compact('images', 'users'));
    }

    public function gallery()
    {
        $images = \App\Models\Gallery::all();
        return view('admin.gallery', compact('images'));
    }

    public function salmo()
    {
        return view('admin.salmo');
    }

    // Método añadido
    public function savePsalmOfTheWeek(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
            'book' => 'required|string',
            'verses' => 'required|string',
        ]);

        PsalmOfTheWeek::updateOrCreate(
            ['id' => 1],
            [
                'reference' => $request->reference,
                'book' => $request->book,
                'verses' => $request->verses,
            ]
        );

        return response()->json(['success' => true]);
    }
}

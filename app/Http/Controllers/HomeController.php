<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsalmOfTheWeek;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $psalm = PsalmOfTheWeek::find(1);
        // Obtener la última imagen de cada categoría
        $categories = Gallery::select('categoria')->distinct()->pluck('categoria');
        $lastImages = collect();
        foreach ($categories as $cat) {
            $img = Gallery::where('categoria', $cat)->orderByDesc('created_at')->first();
            if ($img) $lastImages->push($img);
        }
        return view('Church', [
            'images' => $lastImages,
            'psalm' => $psalm
        ]);
    }

    public function galeriasPorCategoria()
    {
        // Agrupar todas las imágenes por categoría
        $imagenesPorCategoria = Gallery::orderByDesc('created_at')->get()->groupBy('categoria');
        return view('gallery_by_category', [
            'imagenesPorCategoria' => $imagenesPorCategoria
        ]);
    }

    public function showGallery()
    {
        $psalm = PsalmOfTheWeek::find(1);
        $images = \App\Models\Gallery::all();
        $live = false; // O true si hay transmisión en vivo
        $videos = [
            [
                'embed' => 'https://www.youtube.com/embed/VIDEO_ID1',
                'url' => 'https://www.youtube.com/watch?v=VIDEO_ID1',
                'title' => 'Servicio Dominical 1'
            ],
            [
                'embed' => 'https://www.youtube.com/embed/VIDEO_ID2',
                'url' => 'https://www.youtube.com/watch?v=VIDEO_ID2',
                'title' => 'Servicio Dominical 2'
            ],
            // Más videos...
        ];
        return view('Church', compact('images', 'live', 'videos', 'psalm'));
    }

    public function galeriaCategoria($categoria)
    {
        $imagenes = Gallery::where('categoria', $categoria)->orderByDesc('created_at')->get();
        return view('gallery_category', [
            'categoria' => $categoria,
            'imagenes' => $imagenes
        ]);
    }
}
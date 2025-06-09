<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsalmOfTheWeek;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $psalm = PsalmOfTheWeek::find(1);
        $images = \App\Models\Gallery::all();
        return view('Church', compact('images', 'psalm'));
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
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SalmoController extends Controller
{
    public function index()
    {
        // Retorna la vista inicial para los Salmos
        return view('salmo'); // Asegúrate de que 'salmo.blade.php' exista en resources/views
    }

    public function show(Request $request)
    {
        $request->validate([
            'chapter' => 'required|integer|min:1|max:150',
        ]);

        $chapter = $request->input('chapter');
        $client  = new Client();
        $url     = "https://api.scripture.api.bible/v1/bibles/de4e12af7f28f599-02/chapters/psa.{$chapter}?content-type=html&include-notes=false&include-titles=true&include-chapter-numbers=false&include-verse-numbers=true&include-verse-spans=false";

        try {
            $response = $client->get($url, [
                'headers' => [
                    'api-key' => config('services.bible.token'),
                    'Accept'  => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() !== 200) {
                throw new \Exception("HTTP " . $response->getStatusCode());
            }

            $data    = json_decode($response->getBody(), true);
            $content = $data['data']['content'] ?? null;

        } catch (\Exception $e) {
            return view('salmo', [
                'chapter' => $chapter,
                'content' => null,
                'error'   => "No se pudo cargar el Salmo {$chapter}.",
            ]);
        }

        return view('salmo', [
            'chapter' => $chapter,
            'content' => $content,
            'error'   => null,
        ]);
    }
}
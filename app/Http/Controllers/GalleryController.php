<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::all();
        return view('gallery_edit', compact('images'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'categoria' => 'required|string',
        ]);

        $categoria = $request->input('categoria', 'especiales');

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);

                Gallery::create([
                    'filename' => $filename,
                    'categoria' => $categoria,
                ]);
            }
        }

        return redirect()->route('gallery.edit')->with('success', 'Imágenes subidas correctamente.');
    }

    public function delete($id)
    {
        $image = Gallery::findOrFail($id);
        $filePath = public_path('uploads/' . $image->filename);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $image->delete();

        return redirect()->route('gallery.edit')->with('success', 'Imagen eliminada.');
    }
        public function showGallery()
        {
            $images = \App\Models\Gallery::all();
            $live = false; // O true si hay transmisión en vivo
            $videos = [
                [
                    'embed' => 'https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F100064403693652%2Fvideos%2F529548933424127',
                    'url' => 'https://www.facebook.com/100064403693652/videos/529548933424127',
                    'title' => 'Servicio Dominical Reciente'
                ],
                [
                    'embed' => 'https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F100064403693652%2Fvideos%2F2440587952967733',
                    'url' => 'https://www.facebook.com/100064403693652/videos/2440587952967733',
                    'title' => 'Servicio Dominical Anterior'
                ],
                [
                    'embed' => 'https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F100064403693652%2Fvideos%2F685360310810453',
                    'url' => 'https://www.facebook.com/100064403693652/videos/685360310810453',
                    'title' => 'Servicio Dominical'
                ],
            ];
            return view('Church', compact('images', 'live', 'videos'));
        }
}
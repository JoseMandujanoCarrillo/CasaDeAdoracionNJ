<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventAdminController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'asc')->get();
        return response()->json($events);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'time' => 'required|string|max:100',
            'place' => 'required|string|max:255',
            'description' => 'required|string',
            'show_register_button' => 'nullable|boolean',
        ]);
        // If not present, default to 0
        $validated['show_register_button'] = $request->has('show_register_button') ? (int)$request->input('show_register_button') : 0;
        $event = Event::create($validated);
        return response()->json($event, 201);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $validated = $request->validate([
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'time' => 'required|string|max:100',
            'place' => 'required|string|max:255',
            'description' => 'required|string',
            'show_register_button' => 'nullable|boolean',
        ]);
        $validated['show_register_button'] = $request->has('show_register_button') ? (int)$request->input('show_register_button') : 0;
        $event->update($validated);
        return response()->json($event);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }
}

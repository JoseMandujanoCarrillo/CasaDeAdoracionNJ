<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventRegistration;

class EventRegistrationController extends Controller
{
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event_detail', compact('event'));
    }

    public function register(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
        ]);
        $validated['event_id'] = $event->id;
        EventRegistration::create($validated);
        return redirect()->route('event.detail', $event->id)->with('success', '¡Te has inscrito correctamente!');
    }
}

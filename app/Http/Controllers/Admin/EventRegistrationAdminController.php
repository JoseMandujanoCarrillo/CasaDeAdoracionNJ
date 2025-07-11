<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventRegistration;

class EventRegistrationAdminController extends Controller
{
    // List registrations for a given event
    public function index($eventId)
    {
        $registrations = EventRegistration::where('event_id', $eventId)->orderBy('created_at', 'desc')->get();
        return response()->json($registrations);
    }
}

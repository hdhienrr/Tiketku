<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::with('tickets')->latest('event_date')->get();

        return view('dashboard', compact('events'));
    }
    public function show($id)
    {
        $event = Event::with('tickets')->findOrFail($id);
        return view('events.show', compact('event'));
    }
}
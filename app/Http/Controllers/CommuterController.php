<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use App\Models\Ticket;

class CommuterController extends Controller
{
    public function dashboard()
    {
        // Get active announcements, ordered by priority and date
        $announcements = Announcement::active()
            ->orderBy('priority', 'desc')
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        // Get tickets for the current user
        $tickets = Ticket::where('user_id', Auth::id())->get();

        return view('commuter.index', compact('announcements', 'tickets'));
    }
}

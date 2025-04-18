<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommuterController extends Controller
{
    public function dashboard()
    {
        $announcements = []; // Replace with actual data when available
        $activeTickets = []; // Replace with actual data when available

        return view('commuter.index', compact('announcements', 'activeTickets'));
    }
}

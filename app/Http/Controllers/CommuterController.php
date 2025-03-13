<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommuterController extends Controller
{
    public function dashboard()
    {
        return view('commuter.dashboard');
    }

    public function buyTicket()
    {
        return view('commuter.buy-ticket');
    }

    public function viewSchedule()
    {
        return view('commuter.schedule');
    }
}

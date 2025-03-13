<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainMasterController extends Controller
{
    public function dashboard()
    {
        return view('train_master.dashboard');
    }

    public function editSchedule()
    {
        return view('train_master.edit-schedule');
    }

    public function postAnnouncement(Request $request)
    {
        // Logic to post an announcement
        return back()->with('success', 'Announcement posted successfully!');
    }
}

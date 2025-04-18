<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class TrainMasterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:train_master');
    }

    /**
     * Display the train master dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // Get recent announcements
        $recentAnnouncements = Announcement::latest()->take(3)->get();

        // Get total counts
        $announcementCount = Announcement::count();
        $scheduleCount = Schedule::count();

        return view('train_master.dashboard', compact('recentAnnouncements', 'announcementCount', 'scheduleCount'));
    }

    /**
     * Display a listing of the announcements.
     *
     * @return \Illuminate\Http\Response
     */
    public function announcements()
    {
        $announcements = Announcement::with('user')->latest()->paginate(10);
        return view('train_master.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new announcement.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAnnouncement()
    {
        return view('train_master.announcements.create');
    }

    /**
     * Store a newly created announcement in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'priority' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:published_at',
        ]);

        $announcement = new Announcement($validated);
        $announcement->user_id = Auth::id();
        $announcement->save();

        return redirect()->route('train_master.announcements')
            ->with('success', 'Announcement created successfully.');
    }

    /**
     * Show the form for editing the specified announcement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('train_master.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified announcement in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAnnouncement(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'priority' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:published_at',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update($validated);

        return redirect()->route('train_master.announcements')
            ->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified announcement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('train_master.announcements')
            ->with('success', 'Announcement deleted successfully.');
    }

    /**
     * Display a listing of the schedules.
     *
     * @return \Illuminate\Http\Response
     */
    public function schedules()
    {
        $schedules = Schedule::with('train')->latest()->paginate(10);
        return view('train_master.schedules.index', compact('schedules'));
    }

    /**
     * Store a newly created schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSchedule(Request $request)
    {
        $validated = $request->validate([
            'train_id' => 'required|exists:trains,id',
            'departure_station' => 'required',
            'arrival_station' => 'required',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'status' => 'required|in:on_time,delayed,cancelled',
            'delay_minutes' => 'nullable|integer|min:0',
            'platform' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $schedule = Schedule::create($validated);

        return redirect()->route('train_master.schedules')
            ->with('success', 'Schedule created successfully.');
    }

    /**
     * Get the specified schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSchedule($id)
    {
        $schedule = Schedule::with('train')->findOrFail($id);
        return response()->json($schedule);
    }

    /**
     * Show details for the specified schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showScheduleDetails($id)
    {
        $schedule = Schedule::with('train')->findOrFail($id);
        return view('train_master.schedules.details', compact('schedule'));
    }

    /**
     * Update the specified schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSchedule(Request $request, $id)
    {
        $validated = $request->validate([
            'train_id' => 'required|exists:trains,id',
            'departure_station' => 'required',
            'arrival_station' => 'required',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'status' => 'required|in:on_time,delayed,cancelled',
            'delay_minutes' => 'nullable|integer|min:0',
            'platform' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($validated);

        return redirect()->route('train_master.schedules')
            ->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified schedule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('train_master.schedules')
            ->with('success', 'Schedule deleted successfully.');
    }
}

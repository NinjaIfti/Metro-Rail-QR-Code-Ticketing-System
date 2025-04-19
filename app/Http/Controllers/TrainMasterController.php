<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Models\Train;

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
     * Show announcements management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function announcements()
    {
        $announcements = Announcement::with('user')
                                   ->orderBy('created_at', 'desc')
                                   ->paginate(10);

        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show announcement creation form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createAnnouncement()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a new announcement.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:active,inactive',
            'priority' => 'required|in:low,medium,high',
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:published_at',
        ]);

        // Set published_at to current time if not provided
        if (empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Add user_id to the validated data
        $validated['user_id'] = auth()->id();

        Announcement::create($validated);

        return redirect()->route('train_master.announcements')
            ->with('success', 'Announcement created successfully!');
    }

    /**
     * Update the specified announcement.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAnnouncement(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:active,inactive',
            'priority' => 'required|in:low,medium,high',
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:published_at',
        ]);

        $announcement->update($validated);

        return redirect()->route('train_master.announcements')
            ->with('success', 'Announcement updated successfully!');
    }

    /**
     * Delete the specified announcement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return response()->json([
            'success' => true,
            'message' => 'Announcement deleted successfully!'
        ]);
    }

    /**
     * Display a listing of the schedules.
     *
     * @return \Illuminate\Http\Response
     */
    public function schedules()
    {
        // Fetch all trains to pass to the view
        $trains = Train::all();

        // Fetch schedules
        $schedules = Schedule::with('train')->latest()->paginate(10);

        // Pass both schedules and trains to the view
        return view('train_master.schedules.index', compact('schedules', 'trains'));
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

    /**
     * Show train management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function trains()
    {
        $trains = Train::paginate(10);
        return view('train_master.train.index', compact('trains'));
    }

    /**
     * Show train creation form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createTrain()
    {
        return view('train_master.trains.create');
    }

    /**
     * Store a new train.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTrain(Request $request)
    {
        $validated = $request->validate([
            'train_id' => 'required|string|max:10|unique:trains,train_id',
            'name' => 'nullable|string|max:255',
            'status' => 'required|in:active,maintenance,inactive',
            'capacity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        Train::create($validated);

        return redirect()->route('train_master.trains')->with('success', 'Train created successfully!');
    }

    /**
     * Show edit train form.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editTrain($id)
    {
        $train = Train::findOrFail($id);
        return view('train_master.trains.edit', compact('train'));
    }

    /**
     * Update the specified train.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTrain(Request $request, $id)
    {
        $train = Train::findOrFail($id);

        $validated = $request->validate([
            'train_id' => 'required|string|max:10|unique:trains,train_id,'.$train->id,
            'name' => 'nullable|string|max:255',
            'status' => 'required|in:active,maintenance,inactive',
            'capacity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $train->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Train updated successfully!'
            ]);
        }

        return redirect()->route('train_master.trains')->with('success', 'Train updated successfully!');
    }

    /**
     * Delete the specified train.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteTrain($id)
    {
        $train = Train::findOrFail($id);
        $train->delete();

        return response()->json([
            'success' => true,
            'message' => 'Train deleted successfully!'
        ]);
    }

    /**
     * Show train details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTrainDetails($id)
    {
        try {
            $train = Train::findOrFail($id);

            return response()->json([
                'train_id' => $train->train_id,
                'name' => $train->name,
                'status' => ucfirst($train->status),
                'capacity' => $train->capacity,
                'description' => $train->description,
                'created_at' => $train->created_at->format('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            \Log::error("Error fetching train details for ID: {$id}: " . $e->getMessage());
            return response()->json(['error' => 'Train not found'], 404);
        }
    }
}

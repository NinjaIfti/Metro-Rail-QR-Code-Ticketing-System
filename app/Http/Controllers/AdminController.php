<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Train;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 public function dashboard()
 {
     // Get statistics for the dashboard
     $stats = [
         'users_count' => User::count(),
         'active_users' => User::where('email_verified_at', '!=', null)->count(),
         'commuters' => User::role('commuter')->count(),
         'train_masters' => User::role('train_master')->count(),
         'admins' => User::role('admin')->count(),

         // Add train statistics
         'total_trains' => \App\Models\Train::count(),
         'active_trains' => \App\Models\Train::where('status', 'active')->count(),
         'maintenance_trains' => \App\Models\Train::where('status', 'maintenance')->count(),
         'inactive_trains' => \App\Models\Train::where('status', 'inactive')->count(),

         // Add schedule statistics
         'total_schedules' => \App\Models\Schedule::count(),
         'on_time_schedules' => \App\Models\Schedule::where('status', 'on_time')->count(),
         'delayed_schedules' => \App\Models\Schedule::where('status', 'delayed')->count(),
         'canceled_schedules' => \App\Models\Schedule::where('status', 'canceled')->count(),

         // Add other stats as needed
     ];

     // Get recent users
     $recentUsers = User::latest()->take(5)->get();

     // Check if Schedule model exists and get today's schedules
     $todaySchedules = [];

     if (class_exists('\App\Models\Schedule')) {
         $todaySchedules = \App\Models\Schedule::with('train')
             ->whereDate('schedule_date', now()->format('Y-m-d'))
             ->orderBy('departure_time')
             ->take(5)
             ->get();
     }

     return view('admin.dashboard', compact('stats', 'recentUsers', 'todaySchedules')); // Pass todaySchedules to the view
 }


    /**
     * Show all users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show user creation form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createUser()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('admin.users')->with('success', 'User created successfully!');
    }

    /**
     * Show edit user form.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

public function showUserDetails($id)
{
    try {
        \Log::info("Fetching user details for ID: {$id}");

        $user = User::findOrFail($id);
        $role = $user->roles->first()->name ?? 'No Role';

        \Log::info("User found: " . json_encode($user));

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'role' => ucfirst($role),
            'status' => ucfirst($user->status),
            'last_login_at' => $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never'
        ]);
    } catch (\Exception $e) {
        \Log::error("Error fetching user details for ID: {$id}: " . $e->getMessage());
        return response()->json(['error' => 'User not found'], 404);
    }
}





   /**
    * Update the specified user.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function updateUser(Request $request, $id)
   {
       $user = User::findOrFail($id);

       $validated = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
           'role' => 'required|exists:roles,name',
       ]);

       $user->update([
           'name' => $validated['name'],
           'email' => $validated['email'],
       ]);

       // Update password if provided
       if ($request->filled('password')) {
           $request->validate([
               'password' => 'string|min:8|confirmed',
           ]);

           $user->update([
               'password' => bcrypt($request->password),
           ]);
       }

       // Sync roles
       $user->syncRoles([$validated['role']]);

       if ($request->wantsJson()) {
           return response()->json([
               'success' => true,
               'message' => 'User updated successfully!'
           ]);
       }

       return redirect()->route('admin.users')->with('success', 'User updated successfully!');
   }

    /**
     * Delete the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete your own account!'
            ], 403);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully!'
        ]);
    }
    /**
     * Show announcements management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function announcements()
    {
        // TODO: Implement announcements functionality
        return view('admin.announcements.index');
    }



    /**
     * Show ticket management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tickets()
    {
        // TODO: Implement ticket management functionality
        return view('admin.tickets.index');
    }

//  train

/**
 * Show train management page.
 *
 * @return \Illuminate\Contracts\Support\Renderable
 */
public function trains()
{
    $trains = Train::paginate(10);
    return view('admin.train.index', compact('trains'));
}

/**
 * Show train creation form.
 *
 * @return \Illuminate\Contracts\Support\Renderable
 */
public function createTrain()
{
    return view('admin.trains.create');
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

    return redirect()->route('admin.trains')->with('success', 'Train created successfully!');
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
    return view('admin.trains.edit', compact('train'));
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

    return redirect()->route('admin.trains')->with('success', 'Train updated successfully!');
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

/**
 * Show schedule management page.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Contracts\Support\Renderable
 */
public function schedules(Request $request)
{
    $query = \App\Models\Schedule::with('train');

    // Apply filters if provided
    if ($request->has('status')) {
        $query->status($request->status);
    }

    if ($request->has('days')) {
        $query->daysOfOperation($request->days);
    }

    if ($request->has('train_id')) {
        $query->where('train_id', $request->train_id);
    }

    if ($request->has('date_from') && $request->has('date_to')) {
        $query->dateRange($request->date_from, $request->date_to);
    }

    $schedules = $query->paginate(10);
    $trains = \App\Models\Train::where('status', 'active')->get();

    return view('admin.schedules.index', compact('schedules', 'trains'));
}

/**
 * Store a new schedule.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function storeSchedule(Request $request)
{
    $validated = $request->validate([
        'train_id' => 'required|exists:trains,id',
        'route_name' => 'required|string|max:255',
        'departure_station' => 'required|string|max:255',
        'arrival_station' => 'required|string|max:255',
        'departure_time' => 'required|date_format:H:i',
        'arrival_time' => 'required|date_format:H:i|after:departure_time',
        'schedule_date' => 'required|date',
        'status' => 'required|in:on_time,delayed,canceled',
        'days_of_operation' => 'required|in:weekdays,weekends,daily',
        'delay_minutes' => 'nullable|integer|min:0',
        'notes' => 'nullable|string',
    ]);

    $schedule = \App\Models\Schedule::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Schedule created successfully!',
        'schedule' => $schedule
    ]);
}

/**
 * Get schedule data for editing.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function getSchedule($id)
{
    try {
        $schedule = \App\Models\Schedule::findOrFail($id);

        return response()->json([
            'success' => true,
            'schedule' => $schedule
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Schedule not found'
        ], 404);
    }
}

/**
 * Update the specified schedule.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function updateSchedule(Request $request, $id)
{
    $schedule = \App\Models\Schedule::findOrFail($id);

    $validated = $request->validate([
        'train_id' => 'required|exists:trains,id',
        'route_name' => 'required|string|max:255',
        'departure_station' => 'required|string|max:255',
        'arrival_station' => 'required|string|max:255',
        'departure_time' => 'required|date_format:H:i',
        'arrival_time' => 'required|date_format:H:i|after:departure_time',
        'schedule_date' => 'required|date',
        'status' => 'required|in:on_time,delayed,canceled',
        'days_of_operation' => 'required|in:weekdays,weekends,daily',
        'delay_minutes' => 'nullable|integer|min:0',
        'notes' => 'nullable|string',
    ]);

    $schedule->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Schedule updated successfully!',
        'schedule' => $schedule
    ]);
}

/**
 * Delete the specified schedule.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function deleteSchedule($id)
{
    $schedule = \App\Models\Schedule::findOrFail($id);
    $schedule->delete();

    return response()->json([
        'success' => true,
        'message' => 'Schedule deleted successfully!'
    ]);
}

/**
 * Show schedule details.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function showScheduleDetails($id)
{
    try {
        $schedule = \App\Models\Schedule::with('train')->findOrFail($id);

        return response()->json([
            'train' => [
                'id' => $schedule->train->id,
                'train_id' => $schedule->train->train_id,
                'name' => $schedule->train->name,
            ],
            'route_name' => $schedule->route_name,
            'departure_station' => $schedule->departure_station,
            'arrival_station' => $schedule->arrival_station,
            'departure_time' => $schedule->departure_time,
            'arrival_time' => $schedule->arrival_time,
            'schedule_date' => $schedule->schedule_date,
            'status' => ucfirst(str_replace('_', ' ', $schedule->status)),
            'days_of_operation' => ucfirst($schedule->days_of_operation),
            'delay_minutes' => $schedule->delay_minutes,
            'notes' => $schedule->notes,
            'created_at' => $schedule->created_at->format('Y-m-d H:i:s')
        ]);
    } catch (\Exception $e) {
        \Log::error("Error fetching schedule details for ID: {$id}: " . $e->getMessage());
        return response()->json(['error' => 'Schedule not found'], 404);
    }
}

}



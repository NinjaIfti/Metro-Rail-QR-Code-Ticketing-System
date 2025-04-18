<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Handle user login
     */
    public function login(Request $request)
        {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Get the selected user type and map 'customer' to 'commuter'
            $userType = $request->input('user_type');
            if ($userType === 'customer') {
                $userType = 'commuter';
            }

            // Special case for train_master@gmail.com
            if ($request->email === 'master@gmail.com' && $userType === 'train_master') {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $request->session()->regenerate();
                    return redirect()->route('train_master.dashboard');
                }
            }

            // Regular authentication flow
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Authentication succeeded
                $user = Auth::user();

                // Check if the user's role matches the selected user type
                if ($user->role !== $userType) {
                    // If roles don't match, log the user out and return an error
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return back()->withErrors([
                        'email' => 'You do not have permission to access as ' . $userType,
                    ])->withInput($request->except('password'));
                }

                // Role matches, regenerate session
                $request->session()->regenerate();

                // Redirect based on user type
                switch ($userType) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'train_master':
                        return redirect()->route('train_master.dashboard');
                    case 'commuter':
                    default:
                    $announcements = [];
                        $activeTickets = [];
                        // Redirect to a route
                            return redirect()->route('commuter.dashboard');
                }
            }

            // Authentication failed - add debugging information
            \Log::info('Login failed', [
                'email' => $request->email,
                'user_type' => $userType,
                'exists' => User::where('email', $request->email)->exists()
            ]);

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput($request->except('password'));
        }

    /**
     * Log the user out
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Create a default Train Master user
     */
    public function createDefaultTrainMaster()
    {
        $user = User::where('email', 'master@gmail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Train Master',
                'email' => 'master@gmail.com',
                'password' => bcrypt('master123'),
                'role' => 'train_master'
            ]);
            return "Train Master user created successfully!";
        }

        return "Train Master user already exists!";
    }

    /**
     * Create a default commuter user
     */
    public function createCommuter()
    {
        $user = User::where('email', 'jarinah@gmail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Jarinah',
                'email' => 'jarinah@gmail.com',
                'password' => bcrypt('jarinah123'),
                'role' => 'commuter'
            ]);
            return "Commuter Created ";
        }

        return "Commuter exists already";
    }
}

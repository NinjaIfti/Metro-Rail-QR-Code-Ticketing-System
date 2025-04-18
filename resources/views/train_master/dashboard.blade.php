<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Master Dashboard - Dhaka Metro Rail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'metro-primary': '#0a4275',
                        'metro-secondary': '#ffc107',
                        'metro-dark': '#062040',
                        'metro-light': '#e6f4ff',
                    }
                }
            }
        }
    </script>
    <link rel="icon" type="image/png" href="{{ asset('images/metrorailforico.png') }}">
</head>
<body class="font-sans bg-gray-100">
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="bg-metro-primary text-white w-64 flex-shrink-0">
        <div class="p-4 text-center">
            <img src="{{ asset('images/metrorail.ico') }}" alt="Metro Rail Logo" class="h-12 mx-auto mb-2">
            <h1 class="text-xl font-bold">Train Master Panel</h1>
            <p class="text-sm text-gray-300">Welcome, {{ Auth::user()->name }}</p>
        </div>
        <nav class="mt-4">
            <a href="{{ route('train_master.dashboard') }}" class="block py-2.5 px-4 bg-metro-dark text-white">
                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
            </a>
            <a href="{{ route('train_master.announcements') }}" class="block py-2.5 px-4 hover:bg-metro-dark transition duration-200">
                <i class="fas fa-bullhorn mr-2"></i> Announcements
            </a>
            <a href="{{ route('train_master.schedules') }}" class="block py-2.5 px-4 hover:bg-metro-dark transition duration-200">
                <i class="fas fa-calendar-alt mr-2"></i> Schedules
            </a>
            <form method="POST" action="{{ route('logout') }}" class="block py-2.5 px-4 hover:bg-metro-dark transition duration-200">
                @csrf
                <button type="submit" class="w-full text-left">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Header -->
        <header class="bg-white shadow-sm p-4">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
                <div class="flex items-center">
                    <span class="mr-4 text-gray-600">{{ Auth::user()->email }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" alt="User Avatar" class="h-8 w-8 rounded-full">
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <!-- Stats Card -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-800">Total Announcements</h3>
                        <div class="bg-blue-100 p-2 rounded-full">
                            <i class="fas fa-bullhorn text-blue-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $announcementCount ?? 0 }}</p>
                    <p class="text-sm text-gray-600 mt-1">Manage important notices</p>
                </div>

                <!-- Stats Card -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-800">Today's Trips</h3>
                        <div class="bg-green-100 p-2 rounded-full">
                            <i class="fas fa-train text-green-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800 mt-2">42</p>
                    <p class="text-sm text-gray-600 mt-1">All running on schedule</p>
                </div>

                <!-- Stats Card -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-800">Schedule Updates</h3>
                        <div class="bg-yellow-100 p-2 rounded-full">
                            <i class="fas fa-calendar-alt text-yellow-500"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $scheduleCount ?? 0 }}</p>
                    <p class="text-sm text-gray-600 mt-1">Manage train schedules</p>
                </div>
            </div>

            <!-- Recent Announcements -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-800">Recent Announcements</h3>
                    <a href="{{ route('train_master.announcements') }}" class="text-metro-primary hover:text-metro-dark">View All</a>
                </div>
                <div class="divide-y">
                    @forelse($recentAnnouncements ?? [] as $announcement)
                        <div class="py-3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium text-gray-800">{{ $announcement->title }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($announcement->content, 100) }}</p>
                                </div>
                                <span class="text-xs text-gray-500">{{ $announcement->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="py-4 text-center text-gray-500">
                            No announcements found. <a href="{{ route('train_master.announcements.create') }}" class="text-metro-primary">Create one now</a>.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('train_master.announcements.create') }}" class="bg-metro-primary hover:bg-metro-dark text-white rounded-lg p-4 text-center transition-colors">
                        <i class="fas fa-bullhorn text-2xl mb-2"></i>
                        <p class="font-medium">Post Announcement</p>
                    </a>
                    <a href="{{ route('train_master.schedules') }}" class="bg-metro-primary hover:bg-metro-dark text-white rounded-lg p-4 text-center transition-colors">
                        <i class="fas fa-clock text-2xl mb-2"></i>
                        <p class="font-medium">Update Schedule</p>
                    </a>
                    <a href="#" class="bg-metro-primary hover:bg-metro-dark text-white rounded-lg p-4 text-center transition-colors">
                        <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                        <p class="font-medium">Report Issue</p>
                    </a>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Dhaka Metro Rail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Wait for the DOM to load
        document.addEventListener('DOMContentLoaded', function () {
            // Get the user menu button and the dropdown menu
            const userMenuButton = document.getElementById('userMenuButton');
            const userMenu = document.getElementById('userMenu');

            if (userMenuButton && userMenu) {
                // Toggle the dropdown visibility when the user clicks the button
                userMenuButton.addEventListener('click', function(event) {
                    event.stopPropagation();  // Prevent event from bubbling up to the document
                    userMenu.classList.toggle('hidden');
                });

                // Close the dropdown if the user clicks anywhere outside the button or the menu
                document.addEventListener('click', function(event) {
                    if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                        userMenu.classList.add('hidden');
                    }
                });
            } else {
                console.error('User menu button or menu not found.');
            }
        });
    </script>
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
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .sidebar-link.active {
            background-color: #062040;
            color: white;
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('images/metrorailforico.png') }}">
</head>
<body class="font-sans bg-gray-100 text-gray-800 h-full flex flex-col">
<!-- Admin Top Navbar -->
<nav class="bg-metro-primary text-white shadow-lg px-4 py-3 flex justify-between items-center z-20 sticky top-0">
    <div class="flex items-center space-x-4">
        <!-- Toggle Sidebar Button (Mobile) -->
        <button id="sidebarToggle" class="md:hidden text-white">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/metrorail.ico') }}" alt="Metro Rail Logo"
                 class="h-10 rounded-full border-2 border-metro-secondary">
            <div class="flex flex-col">
                <span class="text-xl font-bold text-metro-secondary tracking-wider">DHAKA</span>
                <span class="text-xs font-light -mt-1">METRO RAIL ADMIN</span>
            </div>
        </div>
    </div>

    <div class="flex items-center space-x-4">
        <!-- Search -->
        <div class="hidden md:block relative">
            <input type="text" placeholder="Search..."
                   class="bg-metro-dark bg-opacity-50 text-white rounded-full py-1 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-metro-secondary w-48">
            <i class="fas fa-search absolute left-3 top-2 text-gray-400"></i>
        </div>

        <!-- Notifications -->
        <div class="relative">
            <button class="text-white focus:outline-none">
                <i class="fas fa-bell text-xl"></i>
                <span
                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
            </button>
        </div>

        <!-- User Menu -->
        <div class="relative">
            <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D8ABC&color=fff" alt="User"
                     class="h-8 w-8 rounded-full border-2 border-white">
                <span class="hidden md:inline-block">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>

            <!-- User Dropdown Menu (hidden by default) -->
            <div id="userMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden">
                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-user-circle mr-2"></i> Profile
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a>
                <div class="border-t border-gray-100"></div>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>

    </div>


</nav>

<div class="flex flex-1 overflow-hidden">
    <aside id="sidebar"
           class="bg-white w-64 shadow-lg z-10 transform transition-transform duration-300 md:translate-x-0 -translate-x-full md:relative absolute h-full fixed top-0 left-0 bottom-0">
        <div class="p-4">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Admin Dashboard</h2>

            <nav class="space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link active flex items-center text-sm px-4 py-3 rounded-md w-full">
                    <i class="fas fa-tachometer-alt mr-3 text-lg"></i>
                    <span>Dashboard</span>
                </a>

                <!-- User Management -->
                <div class="sidebar-section">
                    <a href="{{ route('admin.users') }}"
                        class="flex items-center justify-between text-sm px-4 py-3 rounded-md w-full hover:bg-gray-100"
                        id="userManagementToggle">
                        <div class="flex items-center">
                            <i class="fas fa-users mr-3 text-lg"></i>
                            <span>User Management</span>
                        </div>
                        <i class=""></i>
                    </a>

                    <div class="pl-10 mt-1 space-y-1 dropdown-menu hidden" id="userManagementMenu">
                        <a href="{{ route('admin.users') }}" class="sidebar-link text-sm py-2 pl-2 block rounded-md hover:bg-gray-100">All Users</a>
                        <a href="" class="sidebar-link text-sm py-2 pl-2 block rounded-md hover:bg-gray-100">Commuters</a>
                        <a href="" class="sidebar-link text-sm py-2 pl-2 block rounded-md hover:bg-gray-100">Train Masters</a>
                        <a href="" class="sidebar-link text-sm py-2 pl-2 block rounded-md hover:bg-gray-100">Administrators</a>
                    </div>
                </div>

                <!-- Train Management -->
                <div class="sidebar-section">
                    <a href="{{ route('admin.trains') }}"
                       class="flex items-center justify-between text-sm px-4 py-3 rounded-md w-full hover:bg-gray-100"
                       id="trainManagementToggle">
                        <div class="flex items-center">
                            <i class="fas fa-train mr-3 text-lg"></i>
                            <span>Train Management</span>
                        </div>
                        <i class="" onclick="event.stopPropagation(); document.getElementById('trainManagementMenu').classList.toggle('hidden');"></i>
                    </a>

                    <div class="pl-10 mt-1 space-y-1 dropdown-menu hidden" id="trainManagementMenu">
                        <a href="{{ route('admin.trains') }}" class="sidebar-link text-sm py-2 pl-2 block rounded-md hover:bg-gray-100">All Trains</a>
                        <a href="#" onclick="event.preventDefault(); window.location.href='{{ route('admin.trains') }}'; setTimeout(function() { showAddTrainModal(); }, 500);" class="sidebar-link text-sm py-2 pl-2 block rounded-md hover:bg-gray-100">Add New Train</a>
                        <a href="#" class="sidebar-link text-sm py-2 pl-2 block rounded-md hover:bg-gray-100">Maintenance</a>
                    </div>
                </div>

                <!-- Schedule Management -->
                <div class="sidebar-section">
                    <a href="{{ route('admin.schedules') }}"
                       class="flex items-center justify-between text-sm px-4 py-3 rounded-md w-full hover:bg-gray-100">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-3 text-lg"></i>
                            <span>Schedule Management</span>
                        </div>
                    </a>
                </div>

                <!-- Ticket Management -->
                <a href="#"
                   class="sidebar-link flex items-center text-sm px-4 py-3 rounded-md w-full hover:bg-gray-100">
                    <i class="fas fa-ticket-alt mr-3 text-lg"></i>
                    <span>Ticket Management</span>
                </a>

                <!-- Announcements -->
                <a href="#"
                   class="sidebar-link flex items-center text-sm px-4 py-3 rounded-md w-full hover:bg-gray-100">
                    <i class="fas fa-bullhorn mr-3 text-lg"></i>
                    <span>Announcements</span>
                </a>

                <!-- Reports -->
                <a href="#"
                   class="sidebar-link flex items-center text-sm px-4 py-3 rounded-md w-full hover:bg-gray-100">
                    <i class="fas fa-chart-bar mr-3 text-lg"></i>
                    <span>Reports & Analytics</span>
                </a>

                <!-- Settings -->
                <a href="#"
                   class="sidebar-link flex items-center text-sm px-4 py-3 rounded-md w-full hover:bg-gray-100">
                    <i class="fas fa-cog mr-3 text-lg"></i>
                    <span>Settings</span>
                </a>
            </nav>
        </div>
    </aside>



    <!-- Main Content -->
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4">
        <!-- Welcome Card -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Welcome, Admin User!</h1>
                    <p class="text-gray-600">Here's what's happening with Dhaka Metro Rail today.</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">{{ date('l, F d, Y') }}</p>
                    <div class="flex items-center mt-1 justify-end">
                        <div class="h-2 w-2 rounded-full bg-green-500 mr-1"></div>
                        <span class="text-sm text-green-600">System is operational</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Active Users -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-blue-100 text-blue-500">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm">Active Users</h3>
                        <p class="text-2xl font-bold">1,248</p>
                    </div>
                </div>
                <div class="mt-3 flex items-center text-sm">
                    <span class="text-green-500 font-medium"><i class="fas fa-arrow-up mr-1"></i>12%</span>
                    <span class="text-gray-500 ml-2">from last month</span>
                </div>
            </div>

            <!-- Today's Tickets -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-green-100 text-green-500">
                        <i class="fas fa-ticket-alt text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm">Today's Tickets</h3>
                        <p class="text-2xl font-bold">3,567</p>
                    </div>
                </div>
                <div class="mt-3 flex items-center text-sm">
                    <span class="text-green-500 font-medium"><i class="fas fa-arrow-up mr-1"></i>8%</span>
                    <span class="text-gray-500 ml-2">from yesterday</span>
                </div>
            </div>

            <!-- Active Trains -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-purple-100 text-purple-500">
                        <i class="fas fa-train text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm">Active Trains</h3>
                        <p class="text-2xl font-bold">{{ $stats['active_trains'] }}/{{ $stats['total_trains'] }}</p>
                    </div>
                </div>
                <div class="mt-3 flex items-center text-sm">
                    <span class="text-yellow-500 font-medium"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $stats['maintenance_trains'] }}</span>
                    <span class="text-gray-500 ml-2">in maintenance</span>
                    @if($stats['inactive_trains'] > 0)
                        <span class="text-red-500 font-medium ml-3"><i class="fas fa-times-circle mr-1"></i>{{ $stats['inactive_trains'] }}</span>
                        <span class="text-gray-500 ml-2">inactive</span>
                    @endif
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div
                        class="rounded-full h-12 w-12 flex items-center justify-center bg-metro-light text-metro-primary">
                        <i class="fas fa-money-bill-wave text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm">Today's Revenue</h3>
                        <p class="text-2xl font-bold">৳ 256,320</p>
                    </div>
                </div>
                <div class="mt-3 flex items-center text-sm">
                    <span class="text-green-500 font-medium"><i class="fas fa-arrow-up mr-1"></i>15%</span>
                    <span class="text-gray-500 ml-2">from last week</span>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Recent Activities (2/3 width) -->
            <div class="bg-white rounded-lg shadow-md lg:col-span-2">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-bold text-gray-800">Recent Activities</h2>
                    <button class="text-metro-primary text-sm hover:underline">View All</button>
                </div>

                <div class="p-4">
                    <div class="space-y-4">
                        <!-- Activity Item 1 -->
                        <div class="flex items-start pb-4 border-b border-gray-100">
                            <div
                                class="rounded-full h-10 w-10 flex items-center justify-center bg-blue-100 text-blue-500 mt-1">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-800">New user <span class="font-medium">Tanvir Ahmed</span>
                                    registered</p>
                                <p class="text-sm text-gray-500">15 minutes ago</p>
                            </div>
                        </div>

                        <!-- Activity Item 2 -->
                        <div class="flex items-start pb-4 border-b border-gray-100">
                            <div
                                class="rounded-full h-10 w-10 flex items-center justify-center bg-green-100 text-green-500 mt-1">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-800">Train master <span class="font-medium">Jarinah Tasnim</span>
                                    updated schedule</p>
                                <p class="text-sm text-gray-500">1 hour ago</p>
                            </div>
                        </div>

                        <!-- Activity Item 3 -->
                        <div class="flex items-start pb-4 border-b border-gray-100">
                            <div
                                class="rounded-full h-10 w-10 flex items-center justify-center bg-red-100 text-red-500 mt-1">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-800">Train <span class="font-medium">MR-103</span> reported for
                                    maintenance</p>
                                <p class="text-sm text-gray-500">3 hours ago</p>
                            </div>
                        </div>

                        <!-- Activity Item 4 -->
                        <div class="flex items-start pb-4 border-b border-gray-100">
                            <div
                                class="rounded-full h-10 w-10 flex items-center justify-center bg-yellow-100 text-yellow-500 mt-1">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-800">Admin <span class="font-medium">Iftikhar Ahmed</span> posted a
                                    new announcement</p>
                                <p class="text-sm text-gray-500">5 hours ago</p>
                            </div>
                        </div>

                        <!-- Activity Item 5 -->
                        <div class="flex items-start">
                            <div
                                class="rounded-full h-10 w-10 flex items-center justify-center bg-purple-100 text-purple-500 mt-1">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-800"><span class="font-medium">500+ tickets</span> sold for Uttara
                                    to Motijheel route</p>
                                <p class="text-sm text-gray-500">Today</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions (1/3 width) -->
            <div class="space-y-6">
                <!-- Quick Actions Panel -->
                <div class="bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-bold text-gray-800">Quick Actions</h2>
                    </div>

                    <div class="p-4">
                        <div class="space-y-3">
                            <a href=""
                               class="block p-3 bg-metro-light rounded-lg hover:bg-metro-primary hover:text-white transition-colors duration-200">
                                <div class="flex items-center">
                                    <i class="fas fa-user-plus text-lg mr-3"></i>
                                    <span>Add New User</span>
                                </div>
                            </a>

                            <a href="#"
                               class="block p-3 bg-metro-light rounded-lg hover:bg-metro-primary hover:text-white transition-colors duration-200">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-plus text-lg mr-3"></i>
                                    <span>Create Schedule</span>
                                </div>
                            </a>

                            <a href="#"
                               class="block p-3 bg-metro-light rounded-lg hover:bg-metro-primary hover:text-white transition-colors duration-200">
                                <div class="flex items-center">
                                    <i class="fas fa-bullhorn text-lg mr-3"></i>
                                    <span>Post Announcement</span>
                                </div>
                            </a>

                            <a href="#"
                               class="block p-3 bg-metro-light rounded-lg hover:bg-metro-primary hover:text-white transition-colors duration-200">
                                <div class="flex items-center">
                                    <i class="fas fa-file-alt text-lg mr-3"></i>
                                    <span>Generate Report</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Status Card -->
                <div class="bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="font-bold text-gray-800">System Status</h2>
                    </div>

                    <div class="p-4">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Server Status</span>
                                <span class="text-green-500 flex items-center">
                                        <i class="fas fa-circle text-xs mr-1"></i> Operational
                                    </span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Database</span>
                                <span class="text-green-500 flex items-center">
                                        <i class="fas fa-circle text-xs mr-1"></i> Healthy
                                    </span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Ticket System</span>
                                <span class="text-green-500 flex items-center">
                                        <i class="fas fa-circle text-xs mr-1"></i> Online
                                    </span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">Last Backup</span>
                                <span class="text-gray-600 text-sm">Today, 04:30 AM</span>
                            </div>

                            <div class="pt-2">
                                <a href="#" class="text-metro-primary hover:underline text-sm flex items-center">
                                    <i class="fas fa-external-link-alt mr-1"></i>
                                    <span>View detailed status</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Management Preview Table -->
        <div class="bg-white rounded-lg shadow-md mb-6">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="font-bold text-gray-800">Recent Users</h2>
                <a href="{{ route('admin.users') }}" class="text-metro-primary text-sm hover:underline">
                    View All Users
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentUsers as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-3">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full"
                                         src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f3f4f6&color=1f2937"
                                         alt="{{ $user->name }}">
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($user->roles->first()->name == 'admin') bg-red-100 text-red-800
                                @elseif($user->roles->first()->name == 'train_master') bg-yellow-100 text-yellow-800
                                @else bg-blue-100 text-blue-800 @endif">
                                {{ ucfirst($user->roles->first()->name) }}
                            </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $user->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 focus:outline-none focus:underline">
                                    Edit
                                </a>
                                <button onclick="confirmDelete('{{ route('admin.users.delete', $user->id) }}')" class="text-red-600 hover:text-red-900 focus:outline-none focus:underline">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Schedule Management Preview Table -->
        <div class="bg-white rounded-lg shadow-md mb-6">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="font-bold text-gray-800">Recent Schedules</h2>
                <a href="{{ route('admin.schedules') }}" class="text-metro-primary text-sm hover:underline">
                    View All Schedules
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Train</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departure</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arrival</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($todaySchedules as $schedule)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $schedule->train->train_id }}</div>
                                <div class="text-xs text-gray-500">{{ $schedule->train->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $schedule->route_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $schedule->departure_station }}</div>
                                <div class="text-xs text-gray-500">{{ date('h:i A', strtotime($schedule->departure_time)) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $schedule->arrival_station }}</div>
                                <div class="text-xs text-gray-500">{{ date('h:i A', strtotime($schedule->arrival_time)) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ date('M d, Y', strtotime($schedule->schedule_date)) }}
                                <div class="text-xs">{{ ucfirst($schedule->days_of_operation) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($schedule->status == 'on_time')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                On Time
                            </span>
                                @elseif($schedule->status == 'delayed')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Delayed ({{ $schedule->delay_minutes }}m)
                            </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Canceled
                            </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button onclick="showScheduleDetails({{ $schedule->id }})" class="text-metro-primary hover:text-metro-dark focus:outline-none focus:underline">
                                    View
                                </button>
                                <button onclick="showEditScheduleModal({{ $schedule->id }})" class="text-indigo-600 hover:text-indigo-900 ml-2 focus:outline-none focus:underline">
                                    Edit
                                </button>
                                <button onclick="confirmDeleteSchedule({{ $schedule->id }})" class="text-red-600 hover:text-red-900 ml-2 focus:outline-none focus:underline">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No schedules found for today.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Schedule Details Modal -->
        <div id="scheduleDetailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Schedule Details</h3>
                    <button onclick="closeScheduleDetailsModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="scheduleDetailsContent" class="mt-4 space-y-3">
                    <div class="text-center" id="scheduleDetailsLoader">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-metro-primary"></div>
                        <p class="mt-2 text-gray-500">Loading...</p>
                    </div>
                    <div id="scheduleDetailsInfo" class="hidden"></div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button onclick="closeScheduleDetailsModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Close
                    </button>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                function showScheduleDetails(id) {
                    document.getElementById('scheduleDetailsModal').classList.remove('hidden');
                    document.getElementById('scheduleDetailsLoader').classList.remove('hidden');
                    document.getElementById('scheduleDetailsInfo').classList.add('hidden');

                    fetch(`/admin/schedules/${id}/details`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                alert('Error: ' + data.error);
                                return;
                            }

                            let statusClass = '';
                            if (data.status === 'On time') {
                                statusClass = 'bg-green-100 text-green-800';
                            } else if (data.status === 'Delayed') {
                                statusClass = 'bg-yellow-100 text-yellow-800';
                            } else {
                                statusClass = 'bg-red-100 text-red-800';
                            }

                            const content = `
                <div class="grid grid-cols-1 gap-4">
                    <div class="border-b pb-2">
                        <span class="text-gray-500 text-sm">Train:</span>
                        <span class="text-gray-900 font-medium ml-2">${data.train.train_id} - ${data.train.name}</span>
                    </div>
                    <div class="border-b pb-2">
                        <span class="text-gray-500 text-sm">Route:</span>
                        <span class="text-gray-900 font-medium ml-2">${data.route_name}</span>
                    </div>
                    <div class="border-b pb-2">
                        <span class="text-gray-500 text-sm">Departure:</span>
                        <span class="text-gray-900 font-medium ml-2">${data.departure_station} at ${data.departure_time}</span>
                    </div>
                    <div class="border-b pb-2">
                        <span class="text-gray-500 text-sm">Arrival:</span>
                        <span class="text-gray-900 font-medium ml-2">${data.arrival_station} at ${data.arrival_time}</span>
                    </div>
                    <div class="border-b pb-2">
                        <span class="text-gray-500 text-sm">Schedule Date:</span>
                        <span class="text-gray-900 font-medium ml-2">${data.schedule_date}</span>
                    </div>
                    <div class="border-b pb-2">
                        <span class="text-gray-500 text-sm">Days of Operation:</span>
                        <span class="text-gray-900 font-medium ml-2">${data.days_of_operation}</span>
                    </div>
                    <div class="border-b pb-2">
                        <span class="text-gray-500 text-sm">Status:</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass} ml-2">${data.status}</span>
                    </div>
                    <div class="border-b pb-2">
                        <span class="text-gray-500 text-sm">Notes:</span>
                        <span class="text-gray-900 font-medium ml-2">${data.notes || 'No notes provided.'}</span>
                    </div>
                </div>
                `;

                            document.getElementById('scheduleDetailsInfo').innerHTML = content;
                            document.getElementById('scheduleDetailsLoader').classList.add('hidden');
                            document.getElementById('scheduleDetailsInfo').classList.remove('hidden');
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while fetching schedule details.');
                        });
                }

                function closeScheduleDetailsModal() {
                    document.getElementById('scheduleDetailsModal').classList.add('hidden');
                }
            </script>
        @endpush
    </main>
</div>

<!-- Footer -->
<footer class="bg-white rounded-lg shadow-md p-4 mt-6">
    <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
        <div>&copy; 2025 Dhaka Metro Rail. All rights reserved.</div>
        <div class="mt-2 md:mt-0">Admin Dashboard v1.0.2</div>
    </div>
</footer>


</body>
</html>

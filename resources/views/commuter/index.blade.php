<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dhaka Metro Rail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'metro-primary': '#0a4275',
                        'metro-secondary': '#ffc107',
                        'metro-dark': '#062040',
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
            overflow-x: hidden;
        }
    </style>
</head>

<body>
<div class="bg-gray-50 min-h-screen">
    <!-- User Dashboard Header -->
    <div class="bg-metro-primary text-white py-8">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Welcome, {{ Auth::user()->name }}</h1>
                    <p class="text-gray-200">Manage your metro rail tickets and account details</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="/buy-ticket"
                       class="bg-metro-secondary hover:bg-yellow-500 text-white py-3 px-6 rounded-lg font-semibold transition duration-300 flex items-center space-x-2">
                        <i class="fas fa-ticket-alt"></i>
                        <span>Book New Ticket</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="container mx-auto px-4 sm:px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div
                class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center transition-transform hover:shadow-lg">
                <div class="bg-blue-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-ticket-alt text-blue-600 text-2xl"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">My Tickets</h3>
                <p class="text-gray-500 text-center mb-4">View all your active and past tickets</p>
                <a href="/my-tickets" class="text-metro-primary hover:text-metro-dark mt-auto font-medium">View
                    Tickets</a>
            </div>

            <div
                class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center transition-transform hover:shadow-lg">
                <div class="bg-green-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-history text-green-600 text-2xl"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Trip History</h3>
                <p class="text-gray-500 text-center mb-4">Access your previous journeys</p>
                <a href="/trip-history" class="text-metro-primary hover:text-metro-dark mt-auto font-medium">View
                    History</a>
            </div>

            <div
                class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center transition-transform hover:shadow-lg">
                <div class="bg-purple-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-user-edit text-purple-600 text-2xl"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Profile</h3>
                <p class="text-gray-500 text-center mb-4">Update your account information</p>
                <a href="/profile" class="text-metro-primary hover:text-metro-dark mt-auto font-medium">Edit Profile</a>
            </div>

            <div
                class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center transition-transform hover:shadow-lg">
                <div class="bg-red-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-headset text-red-600 text-2xl"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Support</h3>
                <p class="text-gray-500 text-center mb-4">Get help with your queries</p>
                <a href="/support" class="text-metro-primary hover:text-metro-dark mt-auto font-medium">Contact
                    Support</a>
            </div>
        </div>
    </div>

        <!-- Active Tickets -->
        <div class="container mx-auto px-4 sm:px-6 py-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Active Tickets</h2>

            @if(count($activeTickets) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($activeTickets as $ticket)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <div class="bg-metro-primary text-white px-6 py-4">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-lg">Ticket #{{ $ticket->ticket_id }}</h3>
                                    <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full">Active</span>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex justify-between mb-4">
                                    <div>
                                        <p class="text-gray-500 text-sm">From</p>
                                        <p class="font-medium">{{ $ticket->from_station }}</p>
                                    </div>
                                    <div class="flex items-center text-gray-400">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-gray-500 text-sm">To</p>
                                        <p class="font-medium">{{ $ticket->to_station }}</p>
                                    </div>
                                </div>

                                <div class="flex justify-between mb-4">
                                    <div>
                                        <p class="text-gray-500 text-sm">Date</p>
                                        <p class="font-medium">{{ $ticket->journey_date }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Time</p>
                                        <p class="font-medium">{{ $ticket->journey_time }}</p>
                                    </div>
                                </div>

                                <div class="flex justify-center mt-4">
                                    <a href="/view-ticket/{{ $ticket->id }}"
                                       class="bg-metro-secondary text-white py-2 px-4 rounded-lg hover:bg-yellow-500 transition duration-300 flex items-center space-x-2">
                                        <i class="fas fa-qrcode"></i>
                                        <span>View QR Ticket</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-ticket-alt text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">No Active Tickets</h3>
                    <p class="text-gray-500 mb-6">You don't have any active tickets at the moment.</p>
                    <a href="/buy-ticket"
                       class="bg-metro-primary hover:bg-metro-dark text-white py-3 px-6 rounded-lg font-semibold transition duration-300">
                        Book Your First Ticket
                    </a>
                </div>
            @endif
        </div>

    <!-- Recent Announcements -->
    <div class="container mx-auto px-4 sm:px-6 py-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Recent Announcements</h2>

        <div class="bg-white rounded-xl shadow-md p-6">
            @if(isset($announcements) && count($announcements) > 0)
                <div class="space-y-4">
                    @foreach($announcements as $announcement)
                        <!-- Your existing announcement display code -->
                    @endforeach
                </div>
            @else
                <div class="text-center py-6">
                    <p class="text-gray-500">No recent announcements available.</p>
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>

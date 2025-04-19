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
                <p class="text-gray-500 text-center mb-4">View and update your account information</p>
                <button onclick="openProfileModal()" class="text-metro-primary hover:text-metro-dark mt-auto font-medium">
                    View Profile
                </button>
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
    <div class="container mx-auto px-4 sm:px-6 py-8 no-print">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Active Tickets</h2>

        @if(isset($tickets) && count($tickets->where('status', 'active')) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tickets->where('status', 'active') as $ticket)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="bg-metro-primary text-white px-6 py-4">
                            <div class="flex justify-between items-center">
                                <h3 class="font-semibold text-lg">{{ $ticket->ticket_number }}</h3>
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
                                    <p class="font-medium">{{ date('d M Y', strtotime($ticket->journey_date)) }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">Time</p>
                                    <p class="font-medium">{{ date('h:i A', strtotime($ticket->departure_time)) }}</p>
                                </div>
                            </div>

                            <div class="flex justify-between mb-4">
                                <div>
                                    <p class="text-gray-500 text-sm">Passengers</p>
                                    <p class="font-medium">{{ $ticket->number_of_passengers }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">Fare</p>
                                    <p class="font-medium">৳{{ $ticket->fare }}</p>
                                </div>
                            </div>

                            <div class="flex justify-between space-x-2 mt-4">
                                <button onclick="openViewTicketModal({{ $ticket->id }})"
                                        class="bg-metro-primary text-white py-2 px-4 rounded-lg hover:bg-metro-dark transition duration-300 flex items-center justify-center flex-1">
                                    <i class="fas fa-qrcode mr-1"></i>
                                    <span>View QR</span>
                                </button>
                                <button onclick="openEditTicketModal({{ $ticket->id }})"
                                        class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 flex items-center justify-center flex-1">
                                    <i class="fas fa-edit mr-1"></i>
                                    <span>Edit</span>
                                </button>
                                <form action="{{ route('tickets.cancel', $ticket->id) }}" method="POST"
                                      class="flex-1">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to cancel this ticket?')"
                                            class="w-full bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300 flex items-center justify-center">
                                        <i class="fas fa-times mr-1"></i>
                                        <span>Cancel</span>
                                    </button>
                                </form>
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
                <div class="space-y-6">
                    @foreach($announcements as $announcement)
                        <div class="announcement-item border-l-4 {{ $announcement->priority == 'high' ? 'border-red-500 bg-red-50' : 'border-metro-primary bg-blue-50' }} p-4 rounded-r">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-lg text-gray-800">{{ $announcement->title }}</h3>
                                @if($announcement->priority == 'high')
                                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">Important</span>
                                @endif
                            </div>
                            <div class="text-gray-700 mb-3">
                                {!! nl2br(e($announcement->content)) !!}
                            </div>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>Posted {{ $announcement->formatted_published_date }}</span>
                                @if($announcement->expires_at)
                                    <span>Expires {{ $announcement->expires_at->format('d M Y') }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="bg-gray-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bullhorn text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">No Announcements</h3>
                    <p class="text-gray-500">There are currently no announcements to display.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div id="profileModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md max-h-screen overflow-y-auto">
        <div class="bg-metro-primary text-white px-6 py-4 flex justify-between items-center">
            <h3 class="font-semibold text-xl">My Profile</h3>
            <button onclick="closeProfileModal()" class="text-white hover:text-metro-secondary">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-6">
            <div class="text-center mb-6">
                <div class="bg-metro-primary w-24 h-24 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-3xl font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h3 class="text-xl font-semibold">{{ Auth::user()->name }}</h3>
                <p class="text-gray-500">{{ Auth::user()->email }}</p>
            </div>

            <div class="space-y-4 mb-6">
                <div class="border-b pb-4">
                    <h4 class="text-gray-500 text-sm mb-1">Account ID</h4>
                    <p class="font-medium">{{ Auth::user()->id }}</p>
                </div>
                <div class="border-b pb-4">
                    <h4 class="text-gray-500 text-sm mb-1">Phone Number</h4>
                    <p class="font-medium">{{ Auth::user()->phone ?? 'Not provided' }}</p>
                </div>
                <div class="border-b pb-4">
                    <h4 class="text-gray-500 text-sm mb-1">Member Since</h4>
                    <p class="font-medium">{{ Auth::user()->created_at->format('d M Y') }}</p>
                </div>
                <div>
                    <h4 class="text-gray-500 text-sm mb-1">Account Status</h4>
                    <p class="font-medium flex items-center">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        Active
                    </p>
                </div>
            </div>

            <div class="flex space-x-4">
                <a href="/profile" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                    <i class="fas fa-user-edit mr-2"></i>
                    <span>Edit Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Profile Modal Functions
    function openProfileModal() {
        document.getElementById('profileModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeProfileModal() {
        document.getElementById('profileModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Close modals when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
        const profileModal = document.getElementById('profileModal');

        window.addEventListener('click', function(event) {
            if (event.target === profileModal) {
                closeProfileModal();
            }
        });
    });
</script>
</body>
</html>

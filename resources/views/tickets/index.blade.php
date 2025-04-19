<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dhaka Metro Rail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
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

        // Replace all your JavaScript in the head section with this consolidated version

        // Payment processing functions
        function payForTicket(ticketId) {
            // Show payment modal
            openPaymentModal();

            // Simulate payment processing
            setTimeout(function() {
                // Hide spinner
                document.getElementById('payment-loading').classList.add('hidden');

                // Process payment via AJAX
                fetch(`/tickets/${ticketId}/process-payment`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        ticket_id: ticketId
                    })
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            document.getElementById('payment-success').classList.remove('hidden');
                            document.getElementById('payment-message').classList.add('hidden');

                            // Show popup message
                            alert('Payment successful! Your ticket has been booked.');

                            // Redirect to tickets page after 2 seconds
                            setTimeout(function() {
                                closePaymentModal();
                                window.location.href = '/tickets';
                            }, 2000);
                        } else {
                            document.getElementById('payment-message').textContent = data.message || 'Payment failed. Please try again.';
                        }
                    })
                    .catch(error => {
                        document.getElementById('payment-message').textContent = 'Payment failed. Please try again.';
                        console.error('Error processing payment:', error);
                    });
            }, 2000); // 2 second delay to simulate payment processing
        }

        function openPaymentModal() {
            document.getElementById('paymentModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
            document.getElementById('payment-success').classList.add('hidden');
            document.getElementById('payment-loading').classList.remove('hidden');
            document.getElementById('payment-message').classList.remove('hidden');
            document.getElementById('payment-message').textContent = 'Processing payment...';
            document.body.classList.remove('overflow-hidden');
        }

        function openTicketModal(type) {
            if (type === 'create') {
                document.getElementById('createTicketModal').classList.remove('hidden');
            } else if (type === 'edit') {
                document.getElementById('editTicketModal').classList.remove('hidden');
            } else if (type === 'view') {
                document.getElementById('viewTicketModal').classList.remove('hidden');
            }
            document.body.classList.add('overflow-hidden');
        }

        function closeTicketModal(type) {
            if (type === 'create') {
                document.getElementById('createTicketModal').classList.add('hidden');
            } else if (type === 'edit') {
                document.getElementById('editTicketModal').classList.add('hidden');
            } else if (type === 'view') {
                document.getElementById('viewTicketModal').classList.add('hidden');
            }
            document.body.classList.remove('overflow-hidden');
        }

        // Opening view ticket modal with AJAX content load
        function openViewTicketModal(ticketId) {
            // Show the modal
            openTicketModal('view');

            // Load the ticket details via AJAX
            fetch(`/tickets/${ticketId}/view-modal`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('viewTicketContent').innerHTML = html;
                })
                .catch(error => {
                    document.getElementById('viewTicketContent').innerHTML = `
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    <p>Error loading ticket details. Please try again.</p>
                </div>
            `;
                    console.error('Error loading ticket details:', error);
                });
        }

        // Opening edit ticket modal with AJAX content load
        function openEditTicketModal(ticketId) {
            // Show the modal
            openTicketModal('edit');

            // Load the ticket edit form via AJAX
            fetch(`/tickets/${ticketId}/edit-modal`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('editTicketContent').innerHTML = html;
                    // Initialize fare calculation for the edit form
                    initFareCalculation('edit');
                })
                .catch(error => {
                    document.getElementById('editTicketContent').innerHTML = `
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    <p>Error loading ticket edit form. Please try again.</p>
                </div>
            `;
                    console.error('Error loading ticket edit form:', error);
                });
        }

        function printTicket() {
            window.print();
        }

        // Fare calculation functionality
        function initFareCalculation(type) {
            const formPrefix = type === 'edit' ? 'edit_' : '';

            const fromStation = document.getElementById(`${formPrefix}from_station`);
            const toStation = document.getElementById(`${formPrefix}to_station`);
            const passengers = document.getElementById(`${formPrefix}number_of_passengers`);
            const fareEstimate = document.getElementById(`${formPrefix}fare_estimate`);
            const estimatedFare = document.getElementById(`${formPrefix}estimated_fare`);

            if (!fromStation || !toStation || !passengers || !fareEstimate || !estimatedFare) return;

            function updateFareEstimate() {
                if (fromStation.value && toStation.value && passengers.value) {
                    fareEstimate.classList.remove('hidden');

                    // Get station indices
                    const stations = ['Uttara North', 'Uttara Center', 'Uttara South', 'Pallabi', 'Mirpur 11', 'Mirpur 10', 'Kazipara', 'Shewrapara', 'Agargaon', 'Farmgate', 'Karwan Bazar', 'Shahbag', 'Dhaka University', 'Bangladesh Secretariat', 'Motijheel'];
                    const fromIndex = stations.indexOf(fromStation.value);
                    const toIndex = stations.indexOf(toStation.value);

                    // Calculate fare
                    const stationCount = Math.abs(fromIndex - toIndex);
                    const baseFare = 20 + (stationCount * 5);
                    const totalFare = baseFare * parseInt(passengers.value);

                    estimatedFare.textContent = `৳${totalFare.toFixed(2)}`;
                } else {
                    fareEstimate.classList.add('hidden');
                }
            }

            fromStation.addEventListener('change', updateFareEstimate);
            toStation.addEventListener('change', updateFareEstimate);
            passengers.addEventListener('input', updateFareEstimate);

            // Initialize the fare estimate if values are already filled
            updateFareEstimate();
        }

        // Wait for DOM to be fully loaded - SINGLE EVENT LISTENER
        document.addEventListener('DOMContentLoaded', function() {
            console.log("DOM fully loaded");

            // Initialize ticket form handling
            const ticketForm = document.querySelector('form[action*="tickets.store"]');

            if (ticketForm) {
                console.log("Ticket form found, adding event listener");

                ticketForm.addEventListener('submit', function(e) {
                    console.log("Form submitted");
                    const paymentOption = document.querySelector('input[name="payment_option"]:checked');

                    if (paymentOption && paymentOption.value === 'pay_now') {
                        console.log("Payment option is pay_now");
                        e.preventDefault(); // This prevents the default form submission

                        // Show payment modal
                        openPaymentModal();

                        // Get form data
                        const formData = new FormData(this);

                        // Log the URL we're submitting to
                        console.log("Submitting to:", this.action);

                        // Simulate payment processing
                        setTimeout(function() {
                            console.log("Submitting form via AJAX");
                            // Submit the form via AJAX
                            fetch(ticketForm.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                                .then(response => {
                                    console.log("Got response:", response.status);
                                    if (!response.ok) {
                                        throw new Error('Server returned ' + response.status);
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    console.log("Response data:", data);
                                    // Hide spinner
                                    document.getElementById('payment-loading').classList.add('hidden');

                                    if (data.success) {
                                        console.log("Booking successful!");
                                        // Show success message
                                        document.getElementById('payment-success').classList.remove('hidden');
                                        document.getElementById('payment-message').classList.add('hidden');

                                        // Show popup message
                                        alert('Payment successful! Your ticket has been booked.');

                                        // Redirect to tickets page after 2 seconds
                                        setTimeout(function() {
                                            closePaymentModal();
                                            closeTicketModal('create');
                                            window.location.href = '/tickets';
                                        }, 2000);
                                    } else {
                                        document.getElementById('payment-message').textContent = data.message || 'Payment failed. Please try again.';
                                    }
                                })
                                .catch(error => {
                                    console.error('Error processing payment:', error);
                                    document.getElementById('payment-loading').classList.add('hidden');
                                    document.getElementById('payment-message').textContent = 'Payment failed. Please try again.';
                                });
                        }, 2000); // 2 second delay to simulate payment processing
                    } else {
                        // For 'pay_later', we do nothing, letting the form submit normally
                        console.log("Payment option is pay_later, letting form submit normally");
                    }
                });
            } else {
                console.log("Ticket form not found");
            }

            // Initialize fare calculation for create form
            initFareCalculation('create');

            // Close modals when clicking outside
            window.addEventListener('click', function(event) {
                const createModal = document.getElementById('createTicketModal');
                const editModal = document.getElementById('editTicketModal');
                const viewModal = document.getElementById('viewTicketModal');
                const paymentModal = document.getElementById('paymentModal');

                if (event.target === createModal) {
                    closeTicketModal('create');
                } else if (event.target === editModal) {
                    closeTicketModal('edit');
                } else if (event.target === viewModal) {
                    closeTicketModal('view');
                } else if (event.target === paymentModal) {
                    // Don't close payment modal when clicking outside
                    // This prevents accidental closure during payment processing
                }
            });
        });
    </script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
        }

        @media print {
            .no-print {
                display: none;
            }

            .print-only {
                display: block;
            }
        }
    </style>
</head>

<body>
<div class="bg-gray-50 min-h-screen">
    <!-- Tickets Header -->
    <div class="bg-metro-primary text-white py-8 no-print">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold mb-2">My Tickets</h1>
                    <p class="text-gray-200">Manage your metro rail tickets</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <button
                        onclick="openTicketModal('create')"
                        class="bg-metro-secondary hover:bg-yellow-500 text-white py-3 px-6 rounded-lg font-semibold transition duration-300 flex items-center space-x-2">
                        <i class="fas fa-ticket-alt"></i>
                        <span>Book New Ticket</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Ticket Listing -->
    <div class="container mx-auto px-4 sm:px-6 py-8 no-print">
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-6 text-gray-800">Active Tickets</h2>

        @if(count($tickets->where('status', 'active')) > 0)
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
                                @if($ticket->status === 'active')
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
                                @endif
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
                <button onclick="openTicketModal('create')"
                        class="bg-metro-primary hover:bg-metro-dark text-white py-3 px-6 rounded-lg font-semibold transition duration-300">
                    Book Your First Ticket
                </button>
            </div>
        @endif
    </div>

    <!-- Past Tickets Section -->
    <div class="container mx-auto px-4 sm:px-6 py-8 no-print">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Past Tickets</h2>

        @if(count($tickets->where('status', '!=', 'active')) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tickets->where('status', '!=', 'active') as $ticket)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden opacity-75">
                        <div class="bg-gray-700 text-white px-6 py-4">
                            <div class="flex justify-between items-center">
                                <h3 class="font-semibold text-lg">{{ $ticket->ticket_number }}</h3>
                                @if($ticket->status == 'used')
                                    <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full">Used</span>
                                @elseif($ticket->status == 'cancelled')
                                    <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full">Cancelled</span>
                                @endif
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

                            <div class="flex justify-center mt-4">
                                <button onclick="openViewTicketModal({{ $ticket->id }})"
                                        class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition duration-300 flex items-center space-x-2">
                                    <i class="fas fa-eye"></i>
                                    <span>View Details</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <h3 class="text-xl font-semibold mb-2">No Past Tickets</h3>
                <p class="text-gray-500">You don't have any used or cancelled tickets.</p>
            </div>
        @endif
    </div>
</div>

<!-- Ticket Booking Modal -->
<div id="createTicketModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-4xl max-h-screen overflow-y-auto">
        <div class="bg-metro-primary text-white px-6 py-4 flex justify-between items-center">
            <h3 class="font-semibold text-xl">Book New Ticket</h3>
            <button onclick="closeTicketModal('create')" class="text-white hover:text-metro-secondary">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-6">
            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="from_station" class="block text-gray-700 font-medium mb-2">From Station</label>
                        <select name="from_station" id="from_station"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50"
                                required>
                            <option value="">Select Departure Station</option>
                            @foreach(['Uttara North', 'Uttara Center', 'Uttara South', 'Pallabi', 'Mirpur 11', 'Mirpur 10', 'Kazipara', 'Shewrapara', 'Agargaon', 'Farmgate', 'Karwan Bazar', 'Shahbag', 'Dhaka University', 'Bangladesh Secretariat', 'Motijheel'] as $station)
                                <option value="{{ $station }}">{{ $station }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="to_station" class="block text-gray-700 font-medium mb-2">To Station</label>
                        <select name="to_station" id="to_station"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50"
                                required>
                            <option value="">Select Destination Station</option>
                            @foreach(['Uttara North', 'Uttara Center', 'Uttara South', 'Pallabi', 'Mirpur 11', 'Mirpur 10', 'Kazipara', 'Shewrapara', 'Agargaon', 'Farmgate', 'Karwan Bazar', 'Shahbag', 'Dhaka University', 'Bangladesh Secretariat', 'Motijheel'] as $station)
                                <option value="{{ $station }}">{{ $station }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="journey_date" class="block text-gray-700 font-medium mb-2">Journey Date</label>
                        <input type="date" name="journey_date" id="journey_date" min="{{ date('Y-m-d') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50"
                               required>
                    </div>

                    <div>
                        <label for="departure_time" class="block text-gray-700 font-medium mb-2">Departure Time</label>
                        <input type="time" name="departure_time" id="departure_time"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50"
                               required>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="number_of_passengers" class="block text-gray-700 font-medium mb-2">Number of
                        Passengers</label>
                    <input type="number" name="number_of_passengers" id="number_of_passengers" min="1" value="1"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50"
                           required>
                </div>

                <div id="fare_estimate" class="mb-6 p-4 bg-gray-100 rounded-lg hidden">
                    <h4 class="font-semibold text-lg mb-2">Fare Estimate</h4>
                    <div class="flex justify-between">
                        <p class="text-gray-700">Estimated fare:</p>
                        <p class="font-bold text-metro-primary" id="estimated_fare">৳0.00</p>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Payment Option</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="payment_option" value="pay_now" class="mr-2" checked>
                            <span>Pay Now</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="payment_option" value="pay_later" class="mr-2">
                            <span>Pay Later</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeTicketModal('create')"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-6 rounded-lg transition duration-300">
                        Cancel
                    </button>
                    <button type="submit"
                            class="bg-metro-primary hover:bg-metro-dark text-white py-2 px-6 rounded-lg transition duration-300">
                        Book Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md">
        <div class="bg-metro-primary text-white px-6 py-4 flex justify-between items-center">
            <h3 class="font-semibold text-xl">Payment</h3>
            <button onclick="closePaymentModal()" class="text-white hover:text-metro-secondary">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6 text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-metro-primary mx-auto mb-4" id="payment-loading"></div>
            <p class="mb-6 text-lg" id="payment-message">Processing payment...</p>

            <div id="payment-success" class="hidden">
                <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
                <h4 class="text-xl font-semibold mb-2">Payment Successful!</h4>
                <p class="mb-6">Your ticket has been booked and paid successfully.</p>
                <button onclick="closePaymentModal()" class="bg-metro-primary hover:bg-metro-dark text-white py-2 px-6 rounded-lg transition duration-300">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Ticket Modal -->
<div id="editTicketModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-4xl max-h-screen overflow-y-auto">
        <div class="bg-metro-primary text-white px-6 py-4 flex justify-between items-center">
            <h3 class="font-semibold text-xl">Edit Ticket</h3>
            <button onclick="closeTicketModal('edit')" class="text-white hover:text-metro-secondary">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-6" id="editTicketContent">
            <!-- Content will be loaded dynamically -->
            <div class="flex justify-center">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-metro-primary"></div>
            </div>
        </div>
    </div>
</div>

<!-- View Ticket Modal -->
<div id="viewTicketModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-4xl max-h-screen overflow-y-auto">
        <div class="bg-metro-primary text-white px-6 py-4 flex justify-between items-center no-print">
            <h3 class="font-semibold text-xl">Ticket Details</h3>
            <div class="flex space-x-4">
                <button onclick="printTicket()" class="text-white hover:text-metro-secondary">
                    <i class="fas fa-print text-xl"></i>
                </button>
                <button onclick="closeTicketModal('view')" class="text-white hover:text-metro-secondary">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <div class="p-6" id="viewTicketContent">
            <!-- Content will be loaded dynamically -->
            <div class="flex justify-center">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-metro-primary"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Utility Functions
    function openTicketModal(type) {
        if (type === 'create') {
            document.getElementById('createTicketModal').classList.remove('hidden');
        } else if (type === 'edit') {
            document.getElementById('editTicketModal').classList.remove('hidden');
        } else if (type === 'view') {
            document.getElementById('viewTicketModal').classList.remove('hidden');
        }
        document.body.classList.add('overflow-hidden');
    }

    function closeTicketModal(type) {
        if (type === 'create') {
            document.getElementById('createTicketModal').classList.add('hidden');
        } else if (type === 'edit') {
            document.getElementById('editTicketModal').classList.add('hidden');
        } else if (type === 'view') {
            document.getElementById('viewTicketModal').classList.add('hidden');
        }
        document.body.classList.remove('overflow-hidden');
    }

    // Opening view ticket modal with AJAX content load
    function openViewTicketModal(ticketId) {
        // Show the modal
        openTicketModal('view');

        // Load the ticket details via AJAX
        fetch(`/tickets/${ticketId}/view-modal`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('viewTicketContent').innerHTML = html;
            })
            .catch(error => {
                document.getElementById('viewTicketContent').innerHTML = `
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                        <p>Error loading ticket details. Please try again.</p>
                    </div>
                `;
                console.error('Error loading ticket details:', error);
            });
    }

    // Opening edit ticket modal with AJAX content load
    function openEditTicketModal(ticketId) {
        // Show the modal
        openTicketModal('edit');

        // Load the ticket edit form via AJAX
        fetch(`/tickets/${ticketId}/edit-modal`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('editTicketContent').innerHTML = html;
                // Initialize fare calculation for the edit form
                initFareCalculation('edit');
            })
            .catch(error => {
                document.getElementById('editTicketContent').innerHTML = `
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                        <p>Error loading ticket edit form. Please try again.</p>
                    </div>
                `;
                console.error('Error loading ticket edit form:', error);
            });
    }

    function printTicket() {
        window.print();
    }

    // Fare calculation functionality
    function initFareCalculation(type) {
        const formPrefix = type === 'edit' ? 'edit_' : '';

        const fromStation = document.getElementById(`${formPrefix}from_station`);
        const toStation = document.getElementById(`${formPrefix}to_station`);
        const passengers = document.getElementById(`${formPrefix}number_of_passengers`);
        const fareEstimate = document.getElementById(`${formPrefix}fare_estimate`);
        const estimatedFare = document.getElementById(`${formPrefix}estimated_fare`);

        if (!fromStation || !toStation || !passengers || !fareEstimate || !estimatedFare) return;

        function updateFareEstimate() {
            if (fromStation.value && toStation.value && passengers.value) {
                fareEstimate.classList.remove('hidden');

                // Get station indices
                const stations = ['Uttara North', 'Uttara Center', 'Uttara South', 'Pallabi', 'Mirpur 11', 'Mirpur 10', 'Kazipara', 'Shewrapara', 'Agargaon', 'Farmgate', 'Karwan Bazar', 'Shahbag', 'Dhaka University', 'Bangladesh Secretariat', 'Motijheel'];
                const fromIndex = stations.indexOf(fromStation.value);
                const toIndex = stations.indexOf(toStation.value);

                // Calculate fare
                const stationCount = Math.abs(fromIndex - toIndex);
                const baseFare = 20 + (stationCount * 5);
                const totalFare = baseFare * parseInt(passengers.value);

                estimatedFare.textContent = `৳${totalFare.toFixed(2)}`;
            } else {
                fareEstimate.classList.add('hidden');
            }
        }

        fromStation.addEventListener('change', updateFareEstimate);
        toStation.addEventListener('change', updateFareEstimate);
        passengers.addEventListener('input', updateFareEstimate);

        // Initialize the fare estimate if values are already filled
        updateFareEstimate();
    }

    // Initialize fare calculation for create form
    document.addEventListener('DOMContentLoaded', function() {
        initFareCalculation('create');

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            const createModal = document.getElementById('createTicketModal');
            const editModal = document.getElementById('editTicketModal');
            const viewModal = document.getElementById('viewTicketModal');

            if (event.target === createModal) {
                closeTicketModal('create');
            } else if (event.target === editModal) {
                closeTicketModal('edit');
            } else if (event.target === viewModal) {
                closeTicketModal('view');
            }
        });
    });
</script>
</body>
</html>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div>
        <div class="mb-6">
            <h4 class="text-lg font-semibold mb-4">Journey Information</h4>

            <div class="bg-gray-100 p-4 rounded-lg">
                <div class="flex justify-between mb-4">
                    <div>
                        <p class="text-gray-500 text-sm">From</p>
                        <p class="font-medium text-lg">{{ $ticket->from_station }}</p>
                    </div>
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-500 text-sm">To</p>
                        <p class="font-medium text-lg">{{ $ticket->to_station }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-500 text-sm">Journey Date</p>
                        <p class="font-medium">{{ date('d M Y', strtotime($ticket->journey_date)) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Departure Time</p>
                        <p class="font-medium">{{ date('h:i A', strtotime($ticket->departure_time)) }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-500 text-sm">Arrival Time</p>
                        <p class="font-medium">{{ date('h:i A', strtotime($ticket->arrival_time)) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Duration</p>
                        <p class="font-medium">
                            @php
                                $departureTime = \Carbon\Carbon::parse($ticket->departure_time);
                                $arrivalTime = \Carbon\Carbon::parse($ticket->arrival_time);
                                $diff = $departureTime->diff($arrivalTime);
                                echo $diff->format('%H:%I');
                            @endphp
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 text-sm">Passengers</p>
                        <p class="font-medium">{{ $ticket->number_of_passengers }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Fare</p>
                        <p class="font-medium text-lg text-metro-primary">৳{{ $ticket->fare }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h4 class="text-lg font-semibold mb-4">Ticket Information</h4>

            <div class="bg-gray-100 p-4 rounded-lg">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-500 text-sm">Ticket Number</p>
                        <p class="font-medium">{{ $ticket->ticket_number }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Booking Date</p>
                        <p class="font-medium">{{ date('d M Y', strtotime($ticket->created_at)) }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-500 text-sm">Status</p>
                        @if($ticket->status == 'active')
                            <p class="font-medium text-green-600">Active</p>
                        @elseif($ticket->status == 'used')
                            <p class="font-medium text-blue-600">Used</p>
                        @elseif($ticket->status == 'cancelled')
                            <p class="font-medium text-red-600">Cancelled</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Payment Status</p>
                        @if($ticket->payment_status == 'paid')
                            <p class="font-medium text-green-600">Paid</p>
                        @else
                            <p class="font-medium text-yellow-600">Unpaid</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($ticket->status == 'active')
            <div class="flex space-x-4 no-print">
                @if($ticket->payment_status == 'unpaid')
                    <button onclick="payForTicket({{ $ticket->id }})"
                            class="bg-metro-secondary hover:bg-yellow-500 text-white py-2 px-4 rounded-lg transition duration-300 flex items-center justify-center flex-1">
                        <i class="fas fa-credit-card mr-2"></i>
                        <span>Pay Now</span>
                    </button>

                    <button onclick="openEditTicketModal({{ $ticket->id }})"
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-300 flex items-center justify-center flex-1">
                        <i class="fas fa-edit mr-2"></i>
                        <span>Edit Ticket</span>
                    </button>

                    <form action="{{ route('tickets.cancel', $ticket->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('PATCH')
                        <button type="submit" onclick="return confirm('Are you sure you want to cancel this ticket?')"
                                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>
                            <span>Cancel</span>
                        </button>
                    </form>
                @else
                    <button class="bg-gray-300 text-gray-600 py-2 px-4 rounded-lg flex items-center justify-center flex-1 cursor-not-allowed">
                        <i class="fas fa-edit mr-2"></i>
                        <span>Paid tickets cannot be edited</span>
                    </button>
                @endif
            </div>
        @endif
    </div>

    <div class="flex flex-col items-center justify-center">
        <h4 class="text-lg font-semibold mb-4">QR Code Ticket</h4>

        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 text-center">
            @if($ticket->qr_code)
                <img src="{{ asset('storage/' . $ticket->qr_code) }}" alt="Ticket QR Code" class="mx-auto mb-4 max-w-full h-auto">
            @else
                <div class="bg-gray-200 w-48 h-48 flex items-center justify-center rounded">
                    <i class="fas fa-qrcode text-gray-400 text-4xl"></i>
                </div>
            @endif

            <p class="text-gray-700 text-sm mt-2">Scan at station entrance</p>

            <div class="mt-6">
                <p class="font-semibold">{{ $ticket->from_station }} → {{ $ticket->to_station }}</p>
                <p class="text-gray-600 text-sm">{{ date('d M Y', strtotime($ticket->journey_date)) }} at {{ date('h:i A', strtotime($ticket->departure_time)) }}</p>
                <p class="text-gray-600 text-sm">{{ $ticket->number_of_passengers }} passenger(s)</p>
                @if($ticket->payment_status == 'unpaid')
                    <p class="text-yellow-600 font-medium mt-2">PAYMENT PENDING</p>
                @endif
            </div>
        </div>

        <button onclick="window.print()" class="mt-6 text-metro-primary hover:text-metro-dark flex items-center no-print">
            <i class="fas fa-print mr-2"></i>
            <span>Print Ticket</span>
        </button>
    </div>
</div>

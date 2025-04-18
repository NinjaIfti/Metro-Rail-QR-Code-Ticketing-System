<form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="edit_from_station" class="block text-gray-700 font-medium mb-2">From Station</label>
            <select name="from_station" id="edit_from_station"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50"
                    required>
                @foreach(['Uttara North', 'Uttara Center', 'Uttara South', 'Pallabi', 'Mirpur 11', 'Mirpur 10', 'Kazipara', 'Shewrapara', 'Agargaon', 'Farmgate', 'Karwan Bazar', 'Shahbag', 'Dhaka University', 'Bangladesh Secretariat', 'Motijheel'] as $station)
                    <option value="{{ $station }}" {{ $ticket->from_station == $station ? 'selected' : '' }}>{{ $station }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="edit_to_station" class="block text-gray-700 font-medium mb-2">To Station</label>
            <select name="to_station" id="edit_to_station"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50"
                    required>
                @foreach(['Uttara North', 'Uttara Center', 'Uttara South', 'Pallabi', 'Mirpur 11', 'Mirpur 10', 'Kazipara', 'Shewrapara', 'Agargaon', 'Farmgate', 'Karwan Bazar', 'Shahbag', 'Dhaka University', 'Bangladesh Secretariat', 'Motijheel'] as $station)
                    <option value="{{ $station }}" {{ $ticket->to_station == $station ? 'selected' : '' }}>{{ $station }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="edit_journey_date" class="block text-gray-700 font-medium mb-2">Journey Date</label>
            <input type="date" name="journey_date" id="edit_journey_date"
                   value="{{ date('Y-m-d', strtotime($ticket->journey_date)) }}"
                   min="{{ date('Y-m-d') }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50"
                   required>
        </div>

        <div>
            <label for="edit_departure_time" class="block text-gray-700 font-medium mb-2">Departure Time</label>
            <input type="time" name="departure_time" id="edit_departure_time"
                   value="{{ date('H:i', strtotime($ticket->departure_time)) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50"
                   required>
        </div>
    </div>

    <div class="mb-6">
        <label for="edit_number_of_passengers" class="block text-gray-700 font-medium mb-2">Number of Passengers</label>
        <input type="number" name="number_of_passengers" id="edit_number_of_passengers"
               min="1" value="{{ $ticket->number_of_passengers }}"
               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50"
               required>
    </div>

    <div id="edit_fare_estimate" class="mb-6 p-4 bg-gray-100 rounded-lg">
        <h4 class="font-semibold text-lg mb-2">Fare Estimate</h4>
        <div class="flex justify-between">
            <p class="text-gray-700">Estimated fare:</p>
            <p class="font-bold text-metro-primary" id="edit_estimated_fare">৳{{ $ticket->fare }}</p>
        </div>
        <p class="text-xs text-gray-500 mt-2">
            Note: Fare will be recalculated based on your changes.
        </p>
    </div>
    <div class="flex justify-end space-x-4">
        <button type="button" onclick="closeTicketModal('edit')"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-6 rounded-lg transition duration-300">
            Cancel
        </button>
        <button type="submit"
                class="bg-metro-primary hover:bg-metro-dark text-white py-2 px-6 rounded-lg transition duration-300">
            Update Ticket
        </button>
    </div>
</form>

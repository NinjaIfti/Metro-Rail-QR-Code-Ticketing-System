<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Schedule Management</h1>
        <button onclick="showAddScheduleModal()" class="bg-metro-primary hover:bg-metro-dark text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i> Add New Schedule
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Filters Card -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center">
                <i class="fas fa-filter mr-2"></i>
                <h3 class="text-lg font-semibold text-gray-700">Filters</h3>
            </div>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.schedules') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <div>
                        <label for="train_id" class="block text-sm font-medium text-gray-700 mb-1">Train</label>
                        <select name="train_id" id="train_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary">
                            <option value="">All Trains</option>
                            @foreach($trains as $train)
                                <option value="{{ $train->id }}" @if(request('train_id') == $train->id) selected @endif>
                                    {{ $train->train_id }} - {{ $train->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary">
                            <option value="">All Statuses</option>
                            <option value="on_time" @if(request('status') == 'on_time') selected @endif>On Time</option>
                            <option value="delayed" @if(request('status') == 'delayed') selected @endif>Delayed</option>
                            <option value="canceled" @if(request('status') == 'canceled') selected @endif>Canceled</option>
                        </select>
                    </div>
                    <div>
                        <label for="days" class="block text-sm font-medium text-gray-700 mb-1">Days</label>
                        <select name="days" id="days" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary">
                            <option value="">All Days</option>
                            <option value="weekdays" @if(request('days') == 'weekdays') selected @endif>Weekdays</option>
                            <option value="weekends" @if(request('days') == 'weekends') selected @endif>Weekends</option>
                            <option value="daily" @if(request('days') == 'daily') selected @endif>Daily</option>
                        </select>
                    </div>
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary">
                    </div>
                    <div>
                        <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary">
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="bg-metro-primary hover:bg-metro-dark text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-search mr-2"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Schedules Table Card -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Train</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departure</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arrival</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($schedules as $schedule)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $schedule->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $schedule->train->train_id }}</div>
                            <div class="text-sm text-gray-500">{{ $schedule->train->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $schedule->route_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $schedule->departure_station }}</div>
                            <div class="text-sm text-gray-500">{{ $schedule->departure_time }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $schedule->arrival_station }}</div>
                            <div class="text-sm text-gray-500">{{ $schedule->arrival_time }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $schedule->schedule_date }}</div>
                            <div class="text-sm text-gray-500">{{ ucfirst($schedule->days_of_operation) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($schedule->status == 'on_time')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        On Time
                                    </span>
                            @elseif($schedule->status == 'delayed')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Delayed ({{ $schedule->delay_minutes }} min)
                                    </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Canceled
                                    </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="showScheduleDetails({{ $schedule->id }})" class="text-metro-primary hover:text-metro-dark mr-3">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="showEditScheduleModal({{ $schedule->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="confirmDeleteSchedule({{ $schedule->id }})" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            No schedules found. <button onclick="showAddScheduleModal()" class="text-metro-primary hover:underline">Add a new schedule</button>.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $schedules->links() }}
        </div>
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
            <!-- Content will be populated dynamically -->
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

<!-- Add Schedule Modal -->
<div id="addScheduleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-3/4 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-800">Add New Schedule</h3>
            <button onclick="closeAddScheduleModal()" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="addScheduleForm" action="{{ route('admin.schedules.store') }}" method="POST" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Train ID -->
                <div>
                    <label for="add_train_id" class="block text-sm font-medium text-gray-700 mb-1">Train *</label>
                    <select name="train_id" id="add_train_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                        <option value="">Select Train</option>
                        @foreach($trains as $train)
                            <option value="{{ $train->id }}">{{ $train->train_id }} - {{ $train->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-red-500 text-xs mt-1 hidden" id="add_train_id_error"></p>
                </div>

                <!-- Route Name -->
                <div>
                    <label for="add_route_name" class="block text-sm font-medium text-gray-700 mb-1">Route Name *</label>
                    <input type="text" name="route_name" id="add_route_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" placeholder="e.g. Express Route" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="add_route_name_error"></p>
                </div>

                <!-- Departure Station -->
                <div>
                    <label for="add_departure_station" class="block text-sm font-medium text-gray-700 mb-1">Departure Station *</label>
                    <input type="text" name="departure_station" id="add_departure_station" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" placeholder="e.g. Central Station" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="add_departure_station_error"></p>
                </div>

                <!-- Arrival Station -->
                <div>
                    <label for="add_arrival_station" class="block text-sm font-medium text-gray-700 mb-1">Arrival Station *</label>
                    <input type="text" name="arrival_station" id="add_arrival_station" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" placeholder="e.g. North Station" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="add_arrival_station_error"></p>
                </div>

                <!-- Departure Time -->
                <div>
                    <label for="add_departure_time" class="block text-sm font-medium text-gray-700 mb-1">Departure Time *</label>
                    <input type="time" name="departure_time" id="add_departure_time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="add_departure_time_error"></p>
                </div>

                <!-- Arrival Time -->
                <div>
                    <label for="add_arrival_time" class="block text-sm font-medium text-gray-700 mb-1">Arrival Time *</label>
                    <input type="time" name="arrival_time" id="add_arrival_time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="add_arrival_time_error"></p>
                </div>

                <!-- Schedule Date -->
                <div>
                    <label for="add_schedule_date" class="block text-sm font-medium text-gray-700 mb-1">Schedule Date *</label>
                    <input type="date" name="schedule_date" id="add_schedule_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" value="{{ date('Y-m-d') }}" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="add_schedule_date_error"></p>
                </div>

                <!-- Days of Operation -->
                <div>
                    <label for="add_days_of_operation" class="block text-sm font-medium text-gray-700 mb-1">Days of Operation *</label>
                    <select name="days_of_operation" id="add_days_of_operation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                        <option value="daily">Daily</option>
                        <option value="weekdays">Weekdays</option>
                        <option value="weekends">Weekends</option>
                    </select>
                    <p class="text-red-500 text-xs mt-1 hidden" id="add_days_of_operation_error"></p>
                </div>

                <!-- Status -->
                <div>
                    <label for="add_status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                    <select name="status" id="add_status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                        <option value="on_time">On Time</option>
                        <option value="delayed">Delayed</option>
                        <option value="canceled">Canceled</option>
                    </select>
                    <p class="text-red-500 text-xs mt-1 hidden" id="add_status_error"></p>
                </div>

                <!-- Delay Minutes -->
                <div id="add_delay_minutes_container" class="hidden">
                    <label for="add_delay_minutes" class="block text-sm font-medium text-gray-700 mb-1">Delay (Minutes)</label>
                    <input type="number" name="delay_minutes" id="add_delay_minutes" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" value="0" min="0">
                    <p class="text-red-500 text-xs mt-1 hidden" id="add_delay_minutes_error"></p>
                </div>
            </div>

            <!-- Notes -->
            <div class="mt-6">
                <label for="add_notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                <textarea name="notes" id="add_notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" placeholder="Enter any additional notes..."></textarea>
                <p class="text-red-500 text-xs mt-1 hidden" id="add_notes_error"></p>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" onclick="closeAddScheduleModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-metro-primary hover:bg-metro-dark text-white font-bold py-2 px-4 rounded">
                    Add Schedule
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Schedule Modal -->
<div id="editScheduleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-3/4 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-800">Edit Schedule</h3>
            <button onclick="closeEditScheduleModal()" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6 text-center" id="editScheduleLoader">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-metro-primary"></div>
            <p class="mt-2 text-gray-500">Loading...</p>
        </div>
        <form id="editScheduleForm" class="p-6 hidden">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_schedule_id" name="schedule_id">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Train ID -->
                <div>
                    <label for="edit_train_id" class="block text-sm font-medium text-gray-700 mb-1">Train *</label>
                    <select name="train_id" id="edit_train_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                        <option value="">Select Train</option>
                        @foreach($trains as $train)
                            <option value="{{ $train->id }}">{{ $train->train_id }} - {{ $train->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-red-500 text-xs mt-1 hidden" id="edit_train_id_error"></p>
                </div>

                <!-- Route Name -->
                <div>
                    <label for="edit_route_name" class="block text-sm font-medium text-gray-700 mb-1">Route Name *</label>
                    <input type="text" name="route_name" id="edit_route_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" placeholder="e.g. Express Route" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="edit_route_name_error"></p>
                </div>

                <!-- Departure Station -->
                <div>
                    <label for="edit_departure_station" class="block text-sm font-medium text-gray-700 mb-1">Departure Station *</label>
                    <input type="text" name="departure_station" id="edit_departure_station" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" placeholder="e.g. Central Station" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="edit_departure_station_error"></p>
                </div>

                <!-- Arrival Station -->
                <div>
                    <label for="edit_arrival_station" class="block text-sm font-medium text-gray-700 mb-1">Arrival Station *</label>
                    <input type="text" name="arrival_station" id="edit_arrival_station" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" placeholder="e.g. North Station" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="edit_arrival_station_error"></p>
                </div>

                <!-- Departure Time -->
                <div>
                    <label for="edit_departure_time" class="block text-sm font-medium text-gray-700 mb-1">Departure Time *</label>
                    <input type="time" name="departure_time" id="edit_departure_time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="edit_departure_time_error"></p>
                </div>

                <!-- Arrival Time -->
                <div>
                    <label for="edit_arrival_time" class="block text-sm font-medium text-gray-700 mb-1">Arrival Time *</label>
                    <input type="time" name="arrival_time" id="edit_arrival_time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="edit_arrival_time_error"></p>
                </div>

                <!-- Schedule Date -->
                <div>
                    <label for="edit_schedule_date" class="block text-sm font-medium text-gray-700 mb-1">Schedule Date *</label>
                    <input type="date" name="schedule_date" id="edit_schedule_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                    <p class="text-red-500 text-xs mt-1 hidden" id="edit_schedule_date_error"></p>
                </div>

                <!-- Days of Operation -->
                <div>
                    <label for="edit_days_of_operation" class="block text-sm font-medium text-gray-700 mb-1">Days of Operation *</label>
                    <select name="days_of_operation" id="edit_days_of_operation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                        <option value="daily">Daily</option>
                        <option value="weekdays">Weekdays</option>
                        <option value="weekends">Weekends</option>
                    </select>
                    <p class="text-red-500 text-xs mt-1 hidden" id="edit_days_of_operation_error"></p>
                </div>

                <!-- Status -->
                <div>
                    <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                    <select name="status" id="edit_status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" required>
                        <option value="on_time">On Time</option>
                        <option value="delayed">Delayed</option>
                        <option value="canceled">Canceled</option>
                    </select>
                    <p class="text-red-500 text-xs mt-1 hidden" id="edit_status_error"></p>
                </div>

                <!-- Delay Minutes -->
                <div id="edit_delay_minutes_container" class="hidden">
                    <label for="edit_delay_minutes" class="block text-sm font-medium text-gray-700 mb-1">Delay (Minutes)</label>
                    <input type="number" name="delay_minutes" id="edit_delay_minutes" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" value="0" min="0">
                    <p class="text-red-500 text-xs mt-1 hidden" id="edit_delay_minutes_error"></p>
                </div>
            </div>

            <!-- Notes -->
            <div class="mt-6">
                <label for="edit_notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                <textarea name="notes" id="edit_notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-metro-primary focus:border-metro-primary" placeholder="Enter any additional notes..."></textarea>
                <p class="text-red-500 text-xs mt-1 hidden" id="edit_notes_error"></p>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" onclick="closeEditScheduleModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-metro-primary hover:bg-metro-dark text-white font-bold py-2 px-4 rounded">
                    Update Schedule
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteScheduleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Schedule</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Are you sure you want to delete this schedule? This action cannot be undone.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="deleteConfirmBtn" data-id=""
                        class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Delete
                </button>
                <button onclick="closeDeleteScheduleModal()"
                        class="mt-3 px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Add Tailwind configuration
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'metro-primary': '#1e40af', // Adjust this to match your site's primary color
                    'metro-dark': '#1e3a8a',
                },
            },
        },
    };

    // Show/Hide Delay Minutes based on Status
    function toggleDelayMinutes(statusId, containerSelector) {
        const status = document.getElementById(statusId).value;
        const container = document.getElementById(containerSelector);

        if (status === 'delayed') {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
            document.getElementById(containerSelector.replace('container', '')).value = 0;
        }
    }

    // Show Schedule Details Modal
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
                        <div>
                            <span class="text-gray-500 text-sm">Created:</span>
                            <span class="text-gray-900 font-medium ml-2">${data.created_at}</span>
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

    // Add Schedule Modal
    function showAddScheduleModal() {
        document.getElementById('addScheduleModal').classList.remove('hidden');
        toggleDelayMinutes('add_status', 'add_delay_minutes_container');
    }

    function closeAddScheduleModal() {
        document.getElementById('addScheduleModal').classList.add('hidden');
        document.getElementById('addScheduleForm').reset();
        // Hide all error messages
        document.querySelectorAll('#addScheduleForm .text-red-500').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
    }

    // Edit Schedule Modal
    function showEditScheduleModal(id) {
        document.getElementById('editScheduleModal').classList.remove('hidden');
        document.getElementById('editScheduleLoader').classList.remove('hidden');
        document.getElementById('editScheduleForm').classList.add('hidden');
        document.getElementById('edit_schedule_id').value = id;

        // Reset validation errors
        document.querySelectorAll('#editScheduleForm .text-red-500').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });

        // Fetch schedule data
        fetch(`/admin/schedules/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const schedule = data.schedule;

                    // Fill form with schedule data
                    document.getElementById('edit_train_id').value = schedule.train_id;
                    document.getElementById('edit_route_name').value = schedule.route_name;
                    document.getElementById('edit_departure_station').value = schedule.departure_station;
                    document.getElementById('edit_arrival_station').value = schedule.arrival_station;
                    document.getElementById('edit_departure_time').value = schedule.departure_time;
                    document.getElementById('edit_arrival_time').value = schedule.arrival_time;
                    document.getElementById('edit_schedule_date').value = schedule.schedule_date;
                    document.getElementById('edit_days_of_operation').value = schedule.days_of_operation;
                    document.getElementById('edit_status').value = schedule.status;
                    document.getElementById('edit_delay_minutes').value = schedule.delay_minutes;
                    document.getElementById('edit_notes').value = schedule.notes || '';

                    // Show/hide delay minutes field based on status
                    toggleDelayMinutes('edit_status', 'edit_delay_minutes_container');

                    document.getElementById('editScheduleLoader').classList.add('hidden');
                    document.getElementById('editScheduleForm').classList.remove('hidden');
                } else {
                    alert('Error loading schedule data. Please try again.');
                    closeEditScheduleModal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while fetching schedule data.');
                closeEditScheduleModal();
            });
    }

    function closeEditScheduleModal() {
        document.getElementById('editScheduleModal').classList.add('hidden');
    }

    // Delete Confirmation
    function confirmDeleteSchedule(id) {
        document.getElementById('deleteConfirmBtn').dataset.id = id;
        document.getElementById('deleteScheduleModal').classList.remove('hidden');
    }

    function closeDeleteScheduleModal() {
        document.getElementById('deleteScheduleModal').classList.add('hidden');
    }

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Add status change listeners
        document.getElementById('add_status').addEventListener('change', function() {
            toggleDelayMinutes('add_status', 'add_delay_minutes_container');
        });

        document.getElementById('edit_status').addEventListener('change', function() {
            toggleDelayMinutes('edit_status', 'edit_delay_minutes_container');
        });

        // Add Schedule Form Submit
        document.getElementById('addScheduleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else if (data.errors) {
                        // Display validation errors
                        Object.keys(data.errors).forEach(field => {
                            const errorElement = document.getElementById(`add_${field}_error`);
                            if (errorElement) {
                                errorElement.textContent = data.errors[field][0];
                                errorElement.classList.remove('hidden');
                            }
                        });
                    } else {
                        alert('An error occurred while adding the schedule.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while submitting the form.');
                });
        });

        // Edit Schedule Form Submit
        document.getElementById('editScheduleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const scheduleId = document.getElementById('edit_schedule_id').value;
            const formData = new FormData(form);

            fetch(`/admin/schedules/${scheduleId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else if (data.errors) {
                        // Display validation errors
                        Object.keys(data.errors).forEach(field => {
                            const errorElement = document.getElementById(`edit_${field}_error`);
                            if (errorElement) {
                                errorElement.textContent = data.errors[field][0];
                                errorElement.classList.remove('hidden');
                            }
                        });
                    } else {
                        alert('An error occurred while updating the schedule.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while submitting the form.');
                });
        });

        // Delete Schedule
        document.getElementById('deleteConfirmBtn').addEventListener('click', function() {
            const scheduleId = this.dataset.id;

            fetch(`/admin/schedules/${scheduleId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert('Error: ' + (data.message || 'Something went wrong'));
                        closeDeleteScheduleModal();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting.');
                    closeDeleteScheduleModal();
                });
        });
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metro Rail - Train Schedule</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'metro-primary': '#00529b',
                        'metro-dark': '#003366',
                        'metro-light': '#e6f0f9',
                        'metro-accent': '#ffc107',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            appearance: none;
        }

        /* Focus styles for better accessibility */
        input:focus, select:focus, button:focus {
            outline: 2px solid #00529b;
            outline-offset: 1px;
        }

        /* Animations */
        .transition-all {
            transition: all 0.2s ease-in-out;
        }

        /* Station dots on the line */
        .station-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid #00529b;
            display: inline-block;
            margin-right: 8px;
        }

        .terminal-dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #ff5533;
            border: 2px solid #00529b;
            display: inline-block;
            margin-right: 8px;
        }

        /* Metro line */
        .metro-line {
            position: relative;
        }

        .metro-line::before {
            content: "";
            position: absolute;
            left: 6px;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: #00529b;
            z-index: 0;
        }

        .schedule-row:hover {
            background-color: #f0f7ff;
        }

        /* Time slots styling */
        .time-slot {
            position: relative;
            padding: 8px 0;
            text-align: center;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
            overflow: hidden;
        }

        .time-slot.available {
            background-color: #e6f0f9;
            border-radius: 0.375rem;
        }

        .time-slot.available:hover {
            background-color: #cce3f9;
        }

        .time-slot.peak-hours {
            background-color: #ffe9a6;
            border-radius: 0.375rem;
        }

        .time-slot.peak-hours:hover {
            background-color: #ffe082;
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('images/metrorailforico.png') }}">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

<!-- Header would be included here -->
@include('components/navbar')

<!-- Main Content -->
<main class="container mx-auto px-4 py-8 max-w-7xl">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-metro-dark mb-2">Metro Rail Schedule</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Plan your journey with Dhaka Metro Rail's comprehensive schedule and real-time train information.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Side: Schedule Selection & Display -->
        <div class="w-full lg:w-3/5">
            <!-- Schedule Selector -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Select Route & Date
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="route-direction" class="block text-sm font-medium text-gray-700 mb-1">Route Direction</label>
                        <select id="route-direction" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                            <option value="north-south">Uttara North → Kamlapur</option>
                            <option value="south-north">Kamlapur → Uttara North</option>
                        </select>
                    </div>

                    <div>
                        <label for="schedule-date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" id="schedule-date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                    </div>
                </div>

                <div class="mt-4">
                    <label for="day-type" class="block text-sm font-medium text-gray-700 mb-1">Schedule Type</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition-all group">
                            <input type="radio" name="day-type" value="weekday" class="mr-2 accent-metro-primary" checked>
                            <div>
                                <span class="font-medium group-hover:text-metro-primary transition-all">Weekday</span>
                                <p class="text-xs text-gray-500">Mon-Fri</p>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition-all group">
                            <input type="radio" name="day-type" value="weekend" class="mr-2 accent-metro-primary">
                            <div>
                                <span class="font-medium group-hover:text-metro-primary transition-all">Weekend</span>
                                <p class="text-xs text-gray-500">Sat-Sun</p>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition-all group">
                            <input type="radio" name="day-type" value="holiday" class="mr-2 accent-metro-primary">
                            <div>
                                <span class="font-medium group-hover:text-metro-primary transition-all">Holiday</span>
                                <p class="text-xs text-gray-500">Special schedule</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="mt-6 flex justify-center">
                    <button id="show-schedule" class="bg-metro-primary hover:bg-metro-dark text-white py-2 px-6 rounded-lg transition-all font-medium flex items-center">
                        <i class="fas fa-search mr-2"></i>
                        Show Schedule
                    </button>
                </div>
            </div>

            <!-- Schedule Display -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-metro-primary flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span id="schedule-title">Weekday Schedule: Uttara North → Kamlapur</span>
                    </h2>
                    <div class="flex items-center space-x-1">
                        <span class="text-sm text-gray-500">Last updated:</span>
                        <span class="text-sm font-medium">April 17, 2025</span>
                    </div>
                </div>

                <!-- Legend -->
                <div class="mb-4 flex flex-wrap gap-4 justify-center text-sm">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-metro-light border border-metro-primary mr-1"></div>
                        <span>Regular Service</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-yellow-200 border border-yellow-400 mr-1"></div>
                        <span>Peak Hours</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-red-500 border-2 border-metro-primary mr-1"></div>
                        <span>Terminal Station</span>
                    </div>
                </div>

                <!-- Schedule Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">Station</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Train</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Train</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Frequency</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">View Times</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Terminal Station: Uttara North -->
                        <tr class="schedule-row">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="terminal-dot"></span>
                                    <div class="text-sm font-medium text-gray-900">Uttara North</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">06:00 AM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">09:40 PM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <span class="text-gray-700">5-7 min (peak)</span><br>
                                <span class="text-gray-500 text-xs">10-12 min (off-peak)</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="toggleTimes('uttara-north')" class="text-metro-primary hover:text-metro-dark">
                                    <i class="fas fa-chevron-down"></i> Show
                                </button>
                            </td>
                        </tr>
                        <!-- Times row (hidden by default) -->
                        <tr id="uttara-north-times" class="hidden bg-gray-50">
                            <td colspan="5" class="px-6 py-4">
                                <div class="grid grid-cols-6 gap-2 md:grid-cols-10 lg:grid-cols-12">
                                    <div class="time-slot available">06:00</div>
                                    <div class="time-slot available">06:10</div>
                                    <div class="time-slot available">06:20</div>
                                    <div class="time-slot available">06:30</div>
                                    <div class="time-slot available">06:40</div>
                                    <div class="time-slot available">06:50</div>
                                    <div class="time-slot peak-hours">07:00</div>
                                    <div class="time-slot peak-hours">07:07</div>
                                    <div class="time-slot peak-hours">07:14</div>
                                    <div class="time-slot peak-hours">07:21</div>
                                    <div class="time-slot peak-hours">07:28</div>
                                    <div class="time-slot peak-hours">07:35</div>
                                    <!-- More time slots would be here -->
                                </div>
                                <div class="mt-2 text-right">
                                    <button class="text-xs text-metro-primary hover:underline" onclick="showAllTimes('uttara-north')">Show full timetable</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Regular Station: Uttara Center -->
                        <tr class="schedule-row">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="station-dot"></span>
                                    <div class="text-sm font-medium text-gray-900">Uttara Center</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">06:03 AM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">09:43 PM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <span class="text-gray-700">5-7 min (peak)</span><br>
                                <span class="text-gray-500 text-xs">10-12 min (off-peak)</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="toggleTimes('uttara-center')" class="text-metro-primary hover:text-metro-dark">
                                    <i class="fas fa-chevron-down"></i> Show
                                </button>
                            </td>
                        </tr>
                        <!-- Times row (hidden by default) -->
                        <tr id="uttara-center-times" class="hidden bg-gray-50">
                            <td colspan="5" class="px-6 py-4">
                                <div class="grid grid-cols-6 gap-2 md:grid-cols-10 lg:grid-cols-12">
                                    <div class="time-slot available">06:03</div>
                                    <div class="time-slot available">06:13</div>
                                    <div class="time-slot available">06:23</div>
                                    <div class="time-slot available">06:33</div>
                                    <div class="time-slot available">06:43</div>
                                    <div class="time-slot available">06:53</div>
                                    <div class="time-slot peak-hours">07:03</div>
                                    <div class="time-slot peak-hours">07:10</div>
                                    <div class="time-slot peak-hours">07:17</div>
                                    <div class="time-slot peak-hours">07:24</div>
                                    <div class="time-slot peak-hours">07:31</div>
                                    <div class="time-slot peak-hours">07:38</div>
                                    <!-- More time slots would be here -->
                                </div>
                                <div class="mt-2 text-right">
                                    <button class="text-xs text-metro-primary hover:underline" onclick="showAllTimes('uttara-center')">Show full timetable</button>
                                </div>
                            </td>
                        </tr>

                        <!-- Regular Station: Uttara South -->
                        <tr class="schedule-row">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="station-dot"></span>
                                    <div class="text-sm font-medium text-gray-900">Uttara South</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">06:06 AM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">09:46 PM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <span class="text-gray-700">5-7 min (peak)</span><br>
                                <span class="text-gray-500 text-xs">10-12 min (off-peak)</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="toggleTimes('uttara-south')" class="text-metro-primary hover:text-metro-dark">
                                    <i class="fas fa-chevron-down"></i> Show
                                </button>
                            </td>
                        </tr>
                        <!-- Times row (hidden by default) -->
                        <tr id="uttara-south-times" class="hidden bg-gray-50">
                            <td colspan="5" class="px-6 py-4">
                                <div class="text-center text-sm text-gray-500 py-4">
                                    <i class="fas fa-clock text-metro-primary mr-1"></i>
                                    Select a specific time to view real-time train status
                                </div>
                            </td>
                        </tr>

                        <!-- More stations would follow the same pattern -->

                        <!-- For demo purposes, let's add a few more without the time details -->
                        <tr class="schedule-row">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="station-dot"></span>
                                    <div class="text-sm font-medium text-gray-900">Pallabi</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">06:11 AM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">09:51 PM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <span class="text-gray-700">5-7 min (peak)</span><br>
                                <span class="text-gray-500 text-xs">10-12 min (off-peak)</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="toggleTimes('pallabi')" class="text-metro-primary hover:text-metro-dark">
                                    <i class="fas fa-chevron-down"></i> Show
                                </button>
                            </td>
                        </tr>

                        <tr class="schedule-row">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="station-dot"></span>
                                    <div class="text-sm font-medium text-gray-900">Mirpur 11</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">06:15 AM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">09:55 PM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <span class="text-gray-700">5-7 min (peak)</span><br>
                                <span class="text-gray-500 text-xs">10-12 min (off-peak)</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="toggleTimes('mirpur-11')" class="text-metro-primary hover:text-metro-dark">
                                    <i class="fas fa-chevron-down"></i> Show
                                </button>
                            </td>
                        </tr>

                        <!-- Skip to terminal station -->
                        <tr class="schedule-row">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="terminal-dot"></span>
                                    <div class="text-sm font-medium text-gray-900">Kamlapur</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">06:40 AM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">10:20 PM</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <span class="text-gray-700">5-7 min (peak)</span><br>
                                <span class="text-gray-500 text-xs">10-12 min (off-peak)</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="toggleTimes('kamlapur')" class="text-metro-primary hover:text-metro-dark">
                                    <i class="fas fa-chevron-down"></i> Show
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end">
                    <button id="download-pdf" class="flex items-center text-metro-primary hover:text-metro-dark font-medium">
                        <i class="fas fa-download mr-2"></i>
                        Download PDF
                    </button>
                </div>
            </div>

            <!-- Journey Planner (Optional) -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-route mr-2"></i>
                    Journey Planner
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-7 gap-4 items-center">
                    <!-- From Station -->
                    <div class="md:col-span-3">
                        <label for="journey-from" class="block text-sm font-medium text-gray-700 mb-1">From Station</label>
                        <select id="journey-from" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                            <option value="">Select departure station</option>
                            <option value="uttara-north">Uttara North</option>
                            <option value="uttara-center">Uttara Center</option>
                            <option value="uttara-south">Uttara South</option>
                            <option value="pallabi">Pallabi</option>
                            <option value="mirpur-11">Mirpur 11</option>
                            <option value="mirpur-10">Mirpur 10</option>
                            <option value="kazipara">Kazipara</option>
                            <option value="shewrapara">Shewrapara</option>
                            <option value="agargaon">Agargaon</option>
                            <option value="bijoy-sarani">Bijoy Sarani</option>
                            <option value="farmgate">Farmgate</option>
                            <option value="karwan-bazar">Karwan Bazar</option>
                            <option value="shahbag">Shahbag</option>
                            <option value="dhaka-university">Dhaka University</option>
                            <option value="bangladesh-secretariat">Bangladesh Secretariat</option>
                            <option value="motijheel">Motijheel</option>
                            <option value="kamlapur">Kamlapur</option>
                        </select>
                    </div>

                    <!-- Swap Button -->
                    <div class="md:col-span-1 flex justify-center items-end pb-1">
                        <button id="swap-journey-stations" class="bg-metro-primary text-white p-2 rounded-full hover:bg-metro-dark transition-all" title="Swap stations">
                            <i class="fas fa-exchange-alt"></i>
                        </button>
                    </div>

                    <!-- To Station -->
                    <div class="md:col-span-3">
                        <label for="journey-to" class="block text-sm font-medium text-gray-700 mb-1">To Station</label>
                        <select id="journey-to" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                            <option value="">Select arrival station</option>
                            <option value="uttara-north">Uttara North</option>
                            <option value="uttara-center">Uttara Center</option>
                            <option value="uttara-south">Uttara South</option>
                            <option value="pallabi">Pallabi</option>
                            <option value="mirpur-11">Mirpur 11</option>
                            <option value="mirpur-10">Mirpur 10</option>
                            <option value="kazipara">Kazipara</option>
                            <option value="shewrapara">Shewrapara</option>
                            <option value="agargaon">Agargaon</option>
                            <option value="bijoy-sarani">Bijoy Sarani</option>
                            <option value="farmgate">Farmgate</option>
                            <option value="karwan-bazar">Karwan Bazar</option>
                            <option value="shahbag">Shahbag</option>
                            <option value="dhaka-university">Dhaka University</option>
                            <option value="bangladesh-secretariat">Bangladesh Secretariat</option>
                            <option value="motijheel">Motijheel</option>
                            <option value="kamlapur">Kamlapur</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="journey-date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" id="journey-date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                    </div>

                    <div>
                        <label for="journey-time" class="block text-sm font-medium text-gray-700 mb-1">Preferred Time</label>
                        <input type="time" id="journey-time" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                    </div>
                </div>

                <div class="mt-6 flex justify-center">
                    <button id="plan-journey" class="bg-metro-primary hover:bg-metro-dark text-white py-2 px-6 rounded-lg transition-all font-medium flex items-center">
                        <i class="fas fa-search mr-2"></i>
                        Find Routes
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Side: Map and Information -->
        <div class="w-full lg:w-2/5">
            <!-- Metro Map -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">

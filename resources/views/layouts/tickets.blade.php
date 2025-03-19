<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metro - Buy Tickets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'metro-primary': '#0a4275',
                        'metro-dark': '#072e54',
                        'metro-light': '#e6f0f9',
                        'metro-accent': '#ffc107',
                    }
                }
            }
        }
    </script>
    <style>
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
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

{{--header--}}
@include('.components/navbar')

<!-- Main Content -->
<main class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Buy Metro Tickets</h1>

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Left Side: Journey Selection -->
        <div class="w-full lg:w-1/2">
            <!-- Journey Selection -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary">Select Your Journey</h2>

                <div class="grid grid-cols-1 md:grid-cols-7 gap-4 items-center">
                    <!-- From Station -->
                    <div class="md:col-span-3">
                        <label for="from-station" class="block text-sm font-medium text-gray-700 mb-1">From Station</label>
                        <select id="from-station" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                            <option value="">Select origin station</option>
                            <!-- Stations will be populated via JavaScript -->
                        </select>
                    </div>

                    <!-- Swap Button -->
                    <div class="md:col-span-1 flex justify-center items-end pb-1">
                        <button id="swap-stations" class="bg-metro-primary text-white p-2 rounded-full hover:bg-metro-dark transition">
                            <i class="fas fa-exchange-alt"></i>
                        </button>
                    </div>

                    <!-- To Station -->
                    <div class="md:col-span-3">
                        <label for="to-station" class="block text-sm font-medium text-gray-700 mb-1">To Station</label>
                        <select id="to-station" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                            <option value="">Select destination station</option>
                            <!-- Stations will be populated via JavaScript -->
                        </select>
                    </div>
                </div>

                <!-- Journey Type -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Journey Type</label>
                    <div class="flex flex-wrap gap-4">
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition">
                            <input type="radio" name="journey-type" value="one-way" class="mr-2" checked>
                            <span>One Way</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition">
                            <input type="radio" name="journey-type" value="return" class="mr-2">
                            <span>Return (10% discount)</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition">
                            <input type="radio" name="journey-type" value="day-pass" class="mr-2">
                            <span>Day Pass (150 BDT)</span>
                        </label>
                    </div>
                </div>

                <!-- Journey Date -->
                <div class="mt-6">
                    <label for="journey-date" class="block text-sm font-medium text-gray-700 mb-1">Journey Date</label>
                    <input type="date" id="journey-date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                </div>
            </div>

            <!-- Passenger Details -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary">Passenger Details</h2>

                <div class="space-y-4">
                    <!-- Adult Tickets -->
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-medium">Adult</h3>
                            <p class="text-sm text-gray-500">Ages 18+</p>
                        </div>
                        <div class="flex items-center">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 w-8 h-8 rounded-l-lg" onclick="decrementTicket('adult')">-</button>
                            <input type="number" id="adult-tickets" class="w-12 h-8 text-center border-y" value="1" min="0" max="10">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 w-8 h-8 rounded-r-lg" onclick="incrementTicket('adult')">+</button>
                        </div>
                    </div>

                    <!-- Child Tickets -->
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-medium">Child</h3>
                            <p class="text-sm text-gray-500">Ages 5-17 (50% discount)</p>
                        </div>
                        <div class="flex items-center">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 w-8 h-8 rounded-l-lg" onclick="decrementTicket('child')">-</button>
                            <input type="number" id="child-tickets" class="w-12 h-8 text-center border-y" value="0" min="0" max="10">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 w-8 h-8 rounded-r-lg" onclick="incrementTicket('child')">+</button>
                        </div>
                    </div>

                    <!-- Senior Tickets -->
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="font-medium">Senior</h3>
                            <p class="text-sm text-gray-500">Ages 60+ (30% discount)</p>
                        </div>
                        <div class="flex items-center">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 w-8 h-8 rounded-l-lg" onclick="decrementTicket('senior')">-</button>
                            <input type="number" id="senior-tickets" class="w-12 h-8 text-center border-y" value="0" min="0" max="10">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 w-8 h-8 rounded-r-lg" onclick="incrementTicket('senior')">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fare Summary -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary">Fare Summary</h2>

                <div id="fare-details" class="space-y-3 mb-4">
                    <p class="text-center text-gray-500">Please select your journey details to see the fare summary</p>
                </div>

                <div class="border-t pt-4">
                    <div class="flex justify-between items-center text-lg font-semibold">
                        <span>Total Fare:</span>
                        <span id="total-fare">0.00 BDT</span>
                    </div>
                </div>
            </div>

            <!-- Payment Options -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary">Payment Method</h2>

                <div class="space-y-4">
                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition">
                        <input type="radio" name="payment-method" value="card" class="mr-2" checked>
                        <span class="flex items-center">
                            <i class="fas fa-credit-card mr-2"></i>
                            Credit/Debit Card
                        </span>
                    </label>

                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition">
                        <input type="radio" name="payment-method" value="mobile" class="mr-2">
                        <span class="flex items-center">
                            <i class="fas fa-mobile-alt mr-2"></i>
                            Mobile Banking
                        </span>
                    </label>

                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition">
                        <input type="radio" name="payment-method" value="counter" class="mr-2">
                        <span class="flex items-center">
                            <i class="fas fa-ticket-alt mr-2"></i>
                            Counter Payment
                        </span>
                    </label>
                </div>
            </div>

            <!-- Proceed Button -->
            <div class="flex justify-center">
                <button id="proceed-button" class="bg-metro-primary hover:bg-metro-dark text-white py-3 px-8 rounded-lg transition text-lg font-medium flex items-center">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Proceed to Payment
                </button>
            </div>
        </div>

        <!-- Right Side: Metro Map -->
        <div class="w-full lg:w-1/2 right-side">
            <div class="bg-white rounded-xl shadow-md p-6 mb-6 metro-map-container flex justify-center items-center">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary">Metro Line Map</h2>
                <div>
                    <!-- Metro Map SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 180 1060" class="w-20">
                        <!-- Styles -->
                        <style>
                            .metro-line {
                                stroke: #0a9b4c;
                                stroke-width: 6;
                                stroke-linecap: round;
                                stroke-linejoin: round;
                                fill: none;
                            }
                            .station {
                                fill: white;
                                stroke: #0a9b4c;
                                stroke-width: 2;
                                r: 6;
                            }
                            .terminal-station {
                                fill: #ff5533;
                                stroke: #0a9b4c;
                                stroke-width: 2;
                                r: 8;
                            }
                            .station-label {
                                font-family: Arial, sans-serif;
                                font-size: 20px;
                                font-weight: bold;
                                text-anchor: start;
                            }
                            .label-left {
                                dominant-baseline: middle;
                                text-anchor: end;
                            }
                            .label-right {
                                dominant-baseline: middle;
                                text-anchor: start;
                            }
                        </style>

                        <!-- Metro line with gentle curves - now vertical -->
                        <path class="metro-line" d="M 90,50
         L 90,230
         C 90,260 110,270 110,300
         L 110,350
         C 110,380 90,390 90,420
         L 90,530
         C 90,560 70,570 70,600
         L 70,650
         C 70,680 90,690 90,720
         L 90,830
         C 90,860 110,870 110,900
         L 110,950
         L 110,1010" />

                        <!-- Stations - now arranged vertically -->
                        <!-- Uttara North (Terminal) -->
                        <circle class="terminal-station" cx="90" cy="50" />
                        <text class="station-label label-right" x="105" y="50">Uttara North</text>

                        <!-- Uttara Center -->
                        <circle class="station" cx="90" cy="110" />
                        <text class="station-label label-left" x="75" y="110">Uttara Center</text>

                        <!-- Uttara South -->
                        <circle class="station" cx="90" cy="170" />
                        <text class="station-label label-right" x="105" y="170">Uttara South</text>

                        <!-- Pallabi -->
                        <circle class="station" cx="90" cy="230" />
                        <text class="station-label label-left" x="75" y="230">Pallabi</text>

                        <!-- Mirpur 11 -->
                        <circle class="station" cx="105" cy="280" />
                        <text class="station-label label-right" x="120" y="280">Mirpur 11</text>

                        <!-- Mirpur 10 -->
                        <circle class="station" cx="110" cy="330" />
                        <text class="station-label label-left" x="95" y="330">Mirpur 10</text>

                        <!-- Kazipara -->
                        <circle class="station" cx="105" cy="380" />
                        <text class="station-label label-right" x="120" y="380">Kazipara</text>

                        <!-- Shewrapara -->
                        <circle class="station" cx="90" cy="430" />
                        <text class="station-label label-left" x="75" y="430">Shewrapara</text>

                        <!-- Agargaon -->
                        <circle class="station" cx="90" cy="480" />
                        <text class="station-label label-right" x="105" y="480">Agargaon</text>

                        <!-- Bijoy Sarani -->
                        <circle class="station" cx="90" cy="530" />
                        <text class="station-label label-left" x="75" y="530">Bijoy Sarani</text>

                        <!-- Farmgate -->
                        <circle class="station" cx="75" cy="580" />
                        <text class="station-label label-right" x="90" y="580">Farmgate</text>

                        <!-- Karwan Bazar -->
                        <circle class="station" cx="70" cy="630" />
                        <text class="station-label label-left" x="55" y="630">Karwan Bazar</text>

                        <!-- Shahbag -->
                        <circle class="station" cx="75" cy="680" />
                        <text class="station-label label-right" x="90" y="680">Shahbag</text>

                        <!-- Dhaka University -->
                        <circle class="station" cx="90" cy="730" />
                        <text class="station-label label-left" x="75" y="730">Dhaka University</text>

                        <!-- Bangladesh Secretariat -->
                        <circle class="station" cx="90" cy="830" />
                        <text class="station-label label-right" x="105" y="830">Bangladesh Secretariat</text>

                        <!-- Motijheel -->
                        <circle class="station" cx="110" cy="950" />
                        <text class="station-label label-left" x="95" y="950">Motijheel</text>

                        <!-- Kamlapur (Terminal) -->
                        <circle class="terminal-station" cx="110" cy="1010" />
                        <text class="station-label label-right" x="125" y="1010">Kamlapur</text>
                    </svg>

                </div>
                <div class="mt-4 text-center">
                    <div class="flex items-center justify-center space-x-4 mb-2">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full bg-white border-2 border-green-600 mr-1"></div>
                            <span class="text-sm">Regular Station</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full bg-red-500 border-2 border-green-600 mr-1"></div>
                            <span class="text-sm">Terminal Station</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Click on stations to see more details</p>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
@include('./components/footer')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metro Rail - Purchase Tickets</title>
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
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

<!-- Header would be included here -->
@include('.components/navbar')

<!-- Main Content -->
<main class="container mx-auto px-4 py-8 max-w-7xl">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-metro-dark mb-2">Purchase Metro Rail Tickets</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Plan your journey and book tickets for Dhaka Metro Rail service - the most convenient way to travel across the city.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Side: Journey Selection -->
        <div class="w-full lg:w-3/5">
            <!-- Journey Selection -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-route mr-2"></i>
                    Journey Details
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-7 gap-4 items-center">
                    <!-- From Station -->
                    <div class="md:col-span-3">
                        <label for="from-station" class="block text-sm font-medium text-gray-700 mb-1">Departure Station</label>
                        <select id="from-station" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
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
                        <button id="swap-stations" class="bg-metro-primary text-white p-2 rounded-full hover:bg-metro-dark transition-all" title="Swap stations">
                            <i class="fas fa-exchange-alt"></i>
                        </button>
                    </div>

                    <!-- To Station -->
                    <div class="md:col-span-3">
                        <label for="to-station" class="block text-sm font-medium text-gray-700 mb-1">Arrival Station</label>
                        <select id="to-station" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
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

                <!-- Journey Type -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ticket Type</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition-all group">
                            <input type="radio" name="journey-type" value="one-way" class="mr-2 accent-metro-primary" checked>
                            <div>
                                <span class="font-medium group-hover:text-metro-primary transition-all">Single Journey</span>
                                <p class="text-xs text-gray-500">Valid for one trip only</p>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition-all group">
                            <input type="radio" name="journey-type" value="return" class="mr-2 accent-metro-primary">
                            <div>
                                <span class="font-medium group-hover:text-metro-primary transition-all">Return</span>
                                <p class="text-xs text-gray-500">10% discount applied</p>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition-all group">
                            <input type="radio" name="journey-type" value="day-pass" class="mr-2 accent-metro-primary">
                            <div>
                                <span class="font-medium group-hover:text-metro-primary transition-all">Day Pass</span>
                                <p class="text-xs text-gray-500">Unlimited rides for 24hrs</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Journey Date -->
                <div class="mt-6">
                    <label for="journey-date" class="block text-sm font-medium text-gray-700 mb-1">Travel Date</label>
                    <input type="date" id="journey-date" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                    <p class="text-xs text-gray-500 mt-1">Tickets are valid for the selected date only. For day passes, 24hr validity starts from first use.</p>
                </div>
            </div>

            <!-- Passenger Details -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-users mr-2"></i>
                    Passenger Information
                </h2>

                <div class="space-y-4">
                    <!-- Adult Tickets -->
                    <div class="flex justify-between items-center py-2 border-b">
                        <div>
                            <h3 class="font-medium">Adult</h3>
                            <p class="text-sm text-gray-500">Ages 18+</p>
                        </div>
                        <div class="flex items-center">
                            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 w-8 h-8 rounded-l-lg transition-all flex items-center justify-center" onclick="decrementTicket('adult')" aria-label="Decrease adult tickets">
                                <i class="fas fa-minus text-sm"></i>
                            </button>
                            <input type="number" id="adult-tickets" class="w-12 h-8 text-center border-y" value="1" min="0" max="10" aria-label="Number of adult tickets">
                            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 w-8 h-8 rounded-r-lg transition-all flex items-center justify-center" onclick="incrementTicket('adult')" aria-label="Increase adult tickets">
                                <i class="fas fa-plus text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Child Tickets -->
                    <div class="flex justify-between items-center py-2 border-b">
                        <div>
                            <h3 class="font-medium">Child</h3>
                            <p class="text-sm text-gray-500">Ages 5-17 (50% discount)</p>
                        </div>
                        <div class="flex items-center">
                            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 w-8 h-8 rounded-l-lg transition-all flex items-center justify-center" onclick="decrementTicket('child')" aria-label="Decrease child tickets">
                                <i class="fas fa-minus text-sm"></i>
                            </button>
                            <input type="number" id="child-tickets" class="w-12 h-8 text-center border-y" value="0" min="0" max="10" aria-label="Number of child tickets">
                            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 w-8 h-8 rounded-r-lg transition-all flex items-center justify-center" onclick="incrementTicket('child')" aria-label="Increase child tickets">
                                <i class="fas fa-plus text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Senior Tickets -->
                    <div class="flex justify-between items-center py-2">
                        <div>
                            <h3 class="font-medium">Senior Citizen</h3>
                            <p class="text-sm text-gray-500">Ages 60+ (30% discount)</p>
                        </div>
                        <div class="flex items-center">
                            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 w-8 h-8 rounded-l-lg transition-all flex items-center justify-center" onclick="decrementTicket('senior')" aria-label="Decrease senior tickets">
                                <i class="fas fa-minus text-sm"></i>
                            </button>
                            <input type="number" id="senior-tickets" class="w-12 h-8 text-center border-y" value="0" min="0" max="10" aria-label="Number of senior tickets">
                            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 w-8 h-8 rounded-r-lg transition-all flex items-center justify-center" onclick="incrementTicket('senior')" aria-label="Increase senior tickets">
                                <i class="fas fa-plus text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        ID verification may be required for discounted tickets
                    </p>
                </div>
            </div>

            <!-- Fare Summary -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-receipt mr-2"></i>
                    Fare Summary
                </h2>

                <div id="fare-details" class="space-y-3 mb-4">
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <p class="text-gray-600">Please select your journey details to see the fare summary</p>
                    </div>
                    <!-- Sample fare summary (will be populated by JavaScript) -->
                    <div class="hidden">
                        <div class="flex justify-between text-sm py-1">
                            <span>Adult × 1</span>
                            <span>60.00 BDT</span>
                        </div>
                        <div class="flex justify-between text-sm py-1">
                            <span>Child × 1</span>
                            <span>30.00 BDT</span>
                        </div>
                        <div class="flex justify-between text-sm py-1">
                            <span>Return journey discount</span>
                            <span>-9.00 BDT</span>
                        </div>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <div class="flex justify-between items-center text-lg font-semibold">
                        <span>Total Fare:</span>
                        <span id="total-fare" class="text-metro-primary">0.00 BDT</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">All fares include applicable taxes and fees</p>
                </div>
            </div>

            <!-- Payment Options -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-credit-card mr-2"></i>
                    Payment Method
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition-all group">
                        <input type="radio" name="payment-method" value="card" class="mr-2 accent-metro-primary" checked>
                        <div>
                            <span class="font-medium group-hover:text-metro-primary transition-all flex items-center">
                                <i class="fas fa-credit-card mr-2"></i>
                                Card Payment
                            </span>
                            <p class="text-xs text-gray-500">Visa, Mastercard, Amex</p>
                        </div>
                    </label>

                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition-all group">
                        <input type="radio" name="payment-method" value="mobile" class="mr-2 accent-metro-primary">
                        <div>
                            <span class="font-medium group-hover:text-metro-primary transition-all flex items-center">
                                <i class="fas fa-mobile-alt mr-2"></i>
                                Mobile Banking
                            </span>
                            <p class="text-xs text-gray-500">bKash, Nagad, Rocket</p>
                        </div>
                    </label>

                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-metro-light transition-all group">
                        <input type="radio" name="payment-method" value="counter" class="mr-2 accent-metro-primary">
                        <div>
                            <span class="font-medium group-hover:text-metro-primary transition-all flex items-center">
                                <i class="fas fa-ticket-alt mr-2"></i>
                                Counter Payment
                            </span>
                            <p class="text-xs text-gray-500">Pay at station</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Terms and Proceed Button -->
            <div class="mb-6">
                <div class="mb-4">
                    <label class="flex items-start cursor-pointer">
                        <input type="checkbox" class="mt-1 mr-2 accent-metro-primary" id="terms-checkbox">
                        <span class="text-sm text-gray-600">
                            I agree to the <a href="#" class="text-metro-primary hover:underline">Terms and Conditions</a> and <a href="#" class="text-metro-primary hover:underline">Refund Policy</a> of Dhaka Metro Rail.
                        </span>
                    </label>
                </div>

                <div class="flex justify-center">
                    <button id="proceed-button" class="bg-metro-primary hover:bg-metro-dark text-white py-3 px-8 rounded-lg transition-all text-lg font-medium flex items-center disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        <i class="fas fa-lock mr-2"></i>
                        Proceed to Payment
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Side: Metro Map and Information -->
        <div class="w-full lg:w-2/5">
            <!-- Metro Map -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-map mr-2"></i>
                    Metro Line Map
                </h2>

                <div class="flex justify-center">
                    <!-- Metro Map SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 180 1060" class="w-32 md:w-48 h-auto">
                        <!-- Styles -->
                        <style>
                            .metro-line {
                                stroke: #00529b;
                                stroke-width: 6;
                                stroke-linecap: round;
                                stroke-linejoin: round;
                                fill: none;
                            }
                            .station {
                                fill: white;
                                stroke: #00529b;
                                stroke-width: 2;
                                r: 6;
                                cursor: pointer;
                                transition: all 0.2s ease;
                            }
                            .station:hover {
                                r: 8;
                                fill: #e6f0f9;
                            }
                            .terminal-station {
                                fill: #ff5533;
                                stroke: #00529b;
                                stroke-width: 2;
                                r: 8;
                                cursor: pointer;
                                transition: all 0.2s ease;
                            }
                            .terminal-station:hover {
                                r: 10;
                                fill: #ff6e50;
                            }
                            .station-label {
                                font-family: 'Inter', sans-serif;
                                font-size: 12px;
                                font-weight: 500;
                                text-anchor: start;
                                pointer-events: none;
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
                        <circle class="terminal-station" cx="90" cy="50" data-station="uttara-north" />
                        <text class="station-label label-right" x="105" y="50">Uttara North</text>

                        <!-- Uttara Center -->
                        <circle class="station" cx="90" cy="110" data-station="uttara-center" />
                        <text class="station-label label-left" x="75" y="110">Uttara Center</text>

                        <!-- Uttara South -->
                        <circle class="station" cx="90" cy="170" data-station="uttara-south" />
                        <text class="station-label label-right" x="105" y="170">Uttara South</text>

                        <!-- Pallabi -->
                        <circle class="station" cx="90" cy="230" data-station="pallabi" />
                        <text class="station-label label-left" x="75" y="230">Pallabi</text>

                        <!-- Mirpur 11 -->
                        <circle class="station" cx="105" cy="280" data-station="mirpur-11" />
                        <text class="station-label label-right" x="120" y="280">Mirpur 11</text>

                        <!-- Mirpur 10 -->
                        <circle class="station" cx="110" cy="330" data-station="mirpur-10" />
                        <text class="station-label label-left" x="95" y="330">Mirpur 10</text>

                        <!-- Kazipara -->
                        <circle class="station" cx="105" cy="380" data-station="kazipara" />
                        <text class="station-label label-right" x="120" y="380">Kazipara</text>

                        <!-- Shewrapara -->
                        <circle class="station" cx="90" cy="430" data-station="shewrapara" />
                        <text class="station-label label-left" x="75" y="430">Shewrapara</text>

                        <!-- Agargaon -->
                        <circle class="station" cx="90" cy="480" data-station="agargaon" />
                        <text class="station-label label-right" x="105" y="480">Agargaon</text>

                        <!-- Bijoy Sarani -->
                        <circle class="station" cx="90" cy="530" data-station="bijoy-sarani" />
                        <text class="station-label label-left" x="75" y="530">Bijoy Sarani</text>

                        <!-- Farmgate -->
                        <circle class="station" cx="75" cy="580" data-station="farmgate" />
                        <text class="station-label label-right" x="90" y="580">Farmgate</text>

                        <!-- Karwan Bazar -->
                        <circle class="station" cx="70" cy="630" data-station="karwan-bazar" />
                        <text class="station-label label-left" x="55" y="630">Karwan Bazar</text>

                        <!-- Shahbag -->
                        <circle class="station" cx="75" cy="680" data-station="shahbag" />
                        <text class="station-label label-right" x="90" y="680">Shahbag</text>

                        <!-- Dhaka University -->
                        <circle class="station" cx="90" cy="730" data-station="dhaka-university" />
                        <text class="station-label label-left" x="75" y="730">Dhaka University</text>

                        <!-- Bangladesh Secretariat -->
                        <circle class="station" cx="90" cy="830" data-station="bangladesh-secretariat" />
                        <text class="station-label label-right" x="105" y="830">Secretariat</text>

                        <!-- Motijheel -->
                        <circle class="station" cx="110" cy="950" data-station="motijheel" />
                        <text class="station-label label-left" x="95" y="950">Motijheel</text>

                        <!-- Kamlapur (Terminal) -->
                        <circle class="terminal-station" cx="110" cy="1010" data-station="kamlapur" />
                        <text class="station-label label-right" x="125" y="1010">Kamlapur</text>
                    </svg>
                </div>

                <div class="mt-4 text-center">
                    <div class="flex items-center justify-center space-x-4 mb-2">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full bg-white border-2 border-metro-primary mr-1"></div>
                            <span class="text-sm">Regular Station</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full bg-red-500 border-2 border-metro-primary mr-1"></div>
                            <span class="text-sm">Terminal Station</span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">Click on stations to select them in the form</p>
                </div>
            </div>

            <!-- Important Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Travel Information
                </h2>

                <div class="space-y-4 text-sm">
                    <div class="flex items-start">
                        <div class="text-metro-primary mr-3 mt-1">
                            <i class="fas fa-clock text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-medium">Operating Hours</h3>
                            <p class="text-gray-600">Weekdays: 6:00 AM - 10:00 PM</p>
                            <p class="text-gray-600">Weekends: 8:00 AM - 10:00 PM</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="text-metro-primary mr-3 mt-1">
                            <i class="fas fa-ticket-alt text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-medium">Ticket Validity</h3>
                            <p class="text-gray-600">Single journey tickets are valid for 3 hours from purchase. Day passes are valid for 24 hours from first use.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="text-metro-primary mr-3 mt-1">
                            <i class="fas fa-luggage-cart text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-medium">Baggage Allowance</h3>
                            <p class="text-gray-600">Each passenger may carry up to two pieces of hand luggage not exceeding 20kg in total weight.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="text-metro-primary mr-3 mt-1">
                            <i class="fas fa-ban text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-medium">Prohibited Items</h3>
                            <p class="text-gray-600">Flammable materials, oversized items, and bicycles are not permitted on the metro.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="text-metro-primary mr-3 mt-1">
                            <i class="fas fa-wheelchair text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-medium">Accessibility</h3>
                            <p class="text-gray-600">All stations have elevators and facilities for passengers with reduced mobility.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t">
                    <a href="#" class="text-metro-primary hover:underline flex items-center text-sm font-medium">
                        <i class="fas fa-external-link-alt mr-1"></i>
                        View complete metro guidelines
                    </a>
                </div>
            </div>

            <!-- Customer Support -->
            <div class="bg-metro-light rounded-xl p-6">
                <h2 class="text-lg font-semibold mb-3 text-metro-dark flex items-center">
                    <i class="fas fa-headset mr-2"></i>
                    Need Help?
                </h2>

                <p class="text-sm text-gray-700 mb-4">Our customer service team is available to assist you with any queries regarding your journey.</p>

                <div class="space-y-3">
                    <a href="tel:16XX" class="flex items-center text-metro-primary hover:text-metro-dark transition-all">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span>16XX (Hotline)</span>
                    </a>

                    <a href="mailto:support@dhakarmetro.gov.bd" class="flex items-center text-metro-primary hover:text-metro-dark transition-all">
                        <i class="fas fa-envelope mr-2"></i>
                        <span>support@dhakarmetro.gov.bd</span>
                    </a>

                    <a href="#" class="flex items-center text-metro-primary hover:text-metro-dark transition-all">
                        <i class="fas fa-comment-dots mr-2"></i>
                        <span>Live Chat</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer would be included here -->
<!-- @include('./components/footer') -->

<!-- JavaScript for functionality -->
<script>
    // Sample stations data (would typically come from backend)
    const stations = [
        { id: 'uttara-north', name: 'Uttara North', zone: 1 },
        { id: 'uttara-center', name: 'Uttara Center', zone: 1 },
        { id: 'uttara-south', name: 'Uttara South', zone: 1 },
        { id: 'pallabi', name: 'Pallabi', zone: 2 },
        { id: 'mirpur-11', name: 'Mirpur 11', zone: 2 },
        { id: 'mirpur-10', name: 'Mirpur 10', zone: 2 },
        { id: 'kazipara', name: 'Kazipara', zone: 2 },
        { id: 'shewrapara', name: 'Shewrapara', zone: 2 },
        { id: 'agargaon', name: 'Agargaon', zone: 3 },
        { id: 'bijoy-sarani', name: 'Bijoy Sarani', zone: 3 },
        { id: 'farmgate', name: 'Farmgate', zone: 3 },
        { id: 'karwan-bazar', name: 'Karwan Bazar', zone: 3 },
        { id: 'shahbag', name: 'Shahbag', zone: 4 },
        { id: 'dhaka-university', name: 'Dhaka University', zone: 4 },
        { id: 'bangladesh-secretariat', name: 'Bangladesh Secretariat', zone: 4 },
        { id: 'motijheel', name: 'Motijheel', zone: 4 },
        { id: 'kamlapur', name: 'Kamlapur', zone: 4 }
    ];

    // Base fare calculation for zones
    const zoneBaseFares = {
        'same': 20,  // Same zone
        '1': 30,     // 1 zone difference
        '2': 40,     // 2 zones difference
        '3': 60      // 3 zones difference
    };

    // Discount percentages
    const discounts = {
        'child': 50,
        'senior': 30,
        'return': 10
    };

    // Current date as default for journey date
    document.getElementById('journey-date').valueAsDate = new Date();

    // Increment/decrement passenger count
    function incrementTicket(type) {
        const input = document.getElementById(`${type}-tickets`);
        if (parseInt(input.value) < parseInt(input.max)) {
            input.value = parseInt(input.value) + 1;
            updateFareSummary();
        }
    }

    function decrementTicket(type) {
        const input = document.getElementById(`${type}-tickets`);
        if (parseInt(input.value) > parseInt(input.min)) {
            input.value = parseInt(input.value) - 1;
            updateFareSummary();
        }
    }

    // Swap origin and destination
    document.getElementById('swap-stations').addEventListener('click', function() {
        const fromStation = document.getElementById('from-station');
        const toStation = document.getElementById('to-station');
        const temp = fromStation.value;
        fromStation.value = toStation.value;
        toStation.value = temp;
        updateFareSummary();
    });

    // Calculate fare based on zones
    function calculateFare(fromStationId, toStationId) {
        if (!fromStationId || !toStationId) return 0;

        const fromStation = stations.find(s => s.id === fromStationId);
        const toStation = stations.find(s => s.id === toStationId);

        if (!fromStation || !toStation) return 0;

        const zoneDifference = Math.abs(fromStation.zone - toStation.zone);

        if (zoneDifference === 0) {
            return zoneBaseFares.same;
        } else {
            return zoneBaseFares[zoneDifference] || 60; // Default to highest fare if not found
        }
    }

    // Update fare summary
    function updateFareSummary() {
        const fromStationId = document.getElementById('from-station').value;
        const toStationId = document.getElementById('to-station').value;
        const journeyType = document.querySelector('input[name="journey-type"]:checked').value;
        const adultCount = parseInt(document.getElementById('adult-tickets').value);
        const childCount = parseInt(document.getElementById('child-tickets').value);
        const seniorCount = parseInt(document.getElementById('senior-tickets').value);

        const fareDetails = document.getElementById('fare-details');
        const totalFareElement = document.getElementById('total-fare');

        // Check if selection is complete
        if (!fromStationId || !toStationId) {
            fareDetails.innerHTML = '<div class="bg-gray-50 p-4 rounded-lg text-center"><p class="text-gray-600">Please select your journey details to see the fare summary</p></div>';
            totalFareElement.textContent = '0.00 BDT';
            return;
        }

        // Day pass has a fixed price
        if (journeyType === 'day-pass') {
            const baseDayPassCost = 150;
            const adultDayPassTotal = baseDayPassCost * adultCount;
            const childDayPassTotal = (baseDayPassCost * childCount) * (1 - discounts.child/100);
            const seniorDayPassTotal = (baseDayPassCost * seniorCount) * (1 - discounts.senior/100);
            const totalFare = adultDayPassTotal + childDayPassTotal + seniorDayPassTotal;

            let detailsHTML = '';
            if (adultCount > 0) {
                detailsHTML += `<div class="flex justify-between text-sm py-1"><span>Adult Day Pass × ${adultCount}</span><span>${adultDayPassTotal.toFixed(2)} BDT</span></div>`;
            }
            if (childCount > 0) {
                detailsHTML += `<div class="flex justify-between text-sm py-1"><span>Child Day Pass × ${childCount} (50% discount)</span><span>${childDayPassTotal.toFixed(2)} BDT</span></div>`;
            }
            if (seniorCount > 0) {
                detailsHTML += `<div class="flex justify-between text-sm py-1"><span>Senior Day Pass × ${seniorCount} (30% discount)</span><span>${seniorDayPassTotal.toFixed(2)} BDT</span></div>`;
            }

            fareDetails.innerHTML = detailsHTML;
            totalFareElement.textContent = `${totalFare.toFixed(2)} BDT`;
            return;
        }

        // Standard fare calculation
        const baseFare = calculateFare(fromStationId, toStationId);

        let adultTotal = baseFare * adultCount;
        let childTotal = (baseFare * childCount) * (1 - discounts.child/100);
        let seniorTotal = (baseFare * seniorCount) * (1 - discounts.senior/100);

        let subtotal = adultTotal + childTotal + seniorTotal;
        let discount = 0;

        // Apply return journey discount
        if (journeyType === 'return') {
            discount = subtotal * (discounts.return/100);
            subtotal = subtotal * 2 - discount;
        }

        let detailsHTML = '';

        if (adultCount > 0) {
            const fareText = journeyType === 'return' ? `${baseFare.toFixed(2)} × 2` : baseFare.toFixed(2);
            detailsHTML += `<div class="flex justify-between text-sm py-1"><span>Adult × ${adultCount} @ ${fareText} BDT</span><span>${(journeyType === 'return' ? adultTotal * 2 : adultTotal).toFixed(2)} BDT</span></div>`;
        }

        if (childCount > 0) {
            const childFare = baseFare * (1 - discounts.child/100);
            const fareText = journeyType === 'return' ? `${childFare.toFixed(2)} × 2` : childFare.toFixed(2);
            detailsHTML += `<div class="flex justify-between text-sm py-1"><span>Child × ${childCount} @ ${fareText} BDT (50% discount)</span><span>${(journeyType === 'return' ? childTotal * 2 : childTotal).toFixed(2)} BDT</span></div>`;
        }

        if (seniorCount > 0) {
            const seniorFare = baseFare * (1 - discounts.senior/100);
            const fareText = journeyType === 'return' ? `${seniorFare.toFixed(2)} × 2` : seniorFare.toFixed(2);
            detailsHTML += `<div class="flex justify-between text-sm py-1"><span>Senior × ${seniorCount} @ ${fareText} BDT (30% discount)</span><span>${(journeyType === 'return' ? seniorTotal * 2 : seniorTotal).toFixed(2)} BDT</span></div>`;
        }

        if (journeyType === 'return' && discount > 0) {
            detailsHTML += `<div class="flex justify-between text-sm py-1 text-green-600"><span>Return journey discount (10%)</span><span>-${discount.toFixed(2)} BDT</span></div>`;
        }

        fareDetails.innerHTML = detailsHTML;
        totalFareElement.textContent = `${subtotal.toFixed(2)} BDT`;
    }

    // Add event listeners for form inputs
    document.getElementById('from-station').addEventListener('change', updateFareSummary);
    document.getElementById('to-station').addEventListener('change', updateFareSummary);
    document.querySelectorAll('input[name="journey-type"]').forEach(el => {
        el.addEventListener('change', updateFareSummary);
    });
    document.getElementById('adult-tickets').addEventListener('change', updateFareSummary);
    document.getElementById('child-tickets').addEventListener('change', updateFareSummary);
    document.getElementById('senior-tickets').addEventListener('change', updateFareSummary);

    // Make map stations interactive
    document.querySelectorAll('.station, .terminal-station').forEach(station => {
        station.addEventListener('click', function() {
            const stationId = this.getAttribute('data-station');
            if (!stationId) return;

            // If from-station is empty, fill it, otherwise fill to-station
            const fromStation = document.getElementById('from-station');
            const toStation = document.getElementById('to-station');

            if (!fromStation.value) {
                fromStation.value = stationId;
            } else if (!toStation.value) {
                toStation.value = stationId;
            } else {
                // Both are filled, update the from station
                fromStation.value = stationId;
            }

            updateFareSummary();
        });
    });

    // Terms checkbox for proceed button
    document.getElementById('terms-checkbox').addEventListener('change', function() {
        document.getElementById('proceed-button').disabled = !this.checked;
    });

    // Proceed button click event
    document.getElementById('proceed-button').addEventListener('click', function() {
        if (this.disabled) return;

        const fromStation = document.getElementById('from-station').value;
        const toStation = document.getElementById('to-station').value;

        if (!fromStation || !toStation) {
            alert('Please select both departure and arrival stations.');
            return;
        }

        const adultCount = parseInt(document.getElementById('adult-tickets').value);
        const childCount = parseInt(document.getElementById('child-tickets').value);
        const seniorCount = parseInt(document.getElementById('senior-tickets').value);

        if (adultCount + childCount + seniorCount === 0) {
            alert('Please select at least one passenger.');
            return;
        }

        // In a real application, this would submit the form or redirect to payment
        alert('Proceeding to payment...');
    });

    // Initialize the fare summary (will show the message to select journey details)
    updateFareSummary();
</script>
</body>
</html>

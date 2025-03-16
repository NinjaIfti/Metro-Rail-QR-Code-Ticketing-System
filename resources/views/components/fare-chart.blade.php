<style>
    html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        overflow-x: hidden;
    }
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
    .metro-route-line {
        stroke: #0a4275;
        stroke-width: 6;
        stroke-linecap: round;
    }
    .metro-station {
        fill: white;
        stroke: #0a4275;
        stroke-width: 2;
    }
    .metro-station-label {
        font-size: 12px;
        fill: #333;
        text-anchor: middle;
    }
    .metro-station-active {
        fill: #ffc107;
    }
</style>

<body class="font-sans bg-gray-50 text-gray-800 w-full">

<!-- Fare Calculator Section -->
<div class="container mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Metro Fare Calculator</h2>

    @php
        $stations = config('stations.stations', []);
        $fares = config('stations.fares', []);
    @endphp

    <div class="bg-white rounded-xl shadow-xl p-6 mb-10 max-w-3xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-7 gap-4 items-center">
            <!-- From Station -->
            <div class="md:col-span-3">
                <label for="from-station" class="block text-sm font-medium text-gray-700 mb-1">From Station</label>
                <select id="from-station" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                    <option value="">Select origin station</option>
                    @foreach ($stations as $station)
                        <option value="{{ $station }}">{{ $station }}</option>
                    @endforeach
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
                    @foreach ($stations as $station)
                        <option value="{{ $station }}">{{ $station }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Fare Result and Reset Button -->
        <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div id="fare-result" class="bg-gray-100 p-4 rounded-lg w-full">
                <p class="text-center text-lg">Select stations to calculate fare</p>
            </div>

            <button id="reset-selection" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-lg transition flex items-center justify-center gap-2">
                <i class="fas fa-redo-alt"></i>
                <span>Reset</span>
            </button>
        </div>
    </div>

    <!-- JavaScript to Fetch Fare Dynamically -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fromStation = document.getElementById('from-station');
            const toStation = document.getElementById('to-station');
            const fareResult = document.getElementById('fare-result');

            // Load fares from PHP to JavaScript
            const fares = @json($fares);

            function updateFare() {
                const from = fromStation.value;
                const to = toStation.value;

                if (from && to && fares[from] && fares[from][to]) {
                    fareResult.innerHTML = `<p class="text-center text-lg font-semibold text-green-600">Fare: ৳${fares[from][to]}</p>`;
                } else {
                    fareResult.innerHTML = `<p class="text-center text-lg">Select stations to calculate fare</p>`;
                }
            }

            fromStation.addEventListener('change', updateFare);
            toStation.addEventListener('change', updateFare);

            // Reset functionality
            document.getElementById('reset-selection').addEventListener('click', function () {
                fromStation.value = "";
                toStation.value = "";
                fareResult.innerHTML = `<p class="text-center text-lg">Select stations to calculate fare</p>`;
            });
        });
        <div class="md:col-span-3">
            <label for="from-station" class="block text-sm font-medium text-gray-700 mb-1">From Station</label>
            <select id="from-station" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border">
                <option value="">Select origin station</option>
                @foreach ($stations as $station)
                <option value="{{ $station }}">{{ $station }}</option>
                @endforeach
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
                @foreach ($stations as $station)
                <option value="{{ $station }}">{{ $station }}</option>
                @endforeach
            </select>
        </div>
    </script>


    <!-- Route Map Section -->
    <div class="bg-white rounded-xl shadow-xl p-6 mb-10">
        <h3 class="text-2xl font-semibold mb-6 text-metro-primary text-center">Metro Route Map</h3>

        <div class="relative overflow-x-auto">
            <div class="min-w-full h-64 md:h-80 px-4" id="route-map-container">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1060 180">
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
                            font-size: 10px;
                            font-weight: bold;
                            text-anchor: middle;
                        }
                        .label-above {
                            dominant-baseline: auto;
                            text-anchor: middle;
                        }
                        .label-below {
                            dominant-baseline: hanging;
                            text-anchor: middle;
                        }
                    </style>

                    <!-- Metro line with gentle curves -->
                    <path class="metro-line" d="M 50,90
                             L 230,90
                             C 260,90 270,110 300,110
                             L 350,110
                             C 380,110 390,90 420,90
                             L 530,90
                             C 560,90 570,70 600,70
                             L 650,70
                             C 680,70 690,90 720,90
                             L 830,90
                             C 860,90 870,110 900,110
                             L 950,110
                             L 1010,110" />

                    <!-- Stations -->
                    <!-- Uttara North (Terminal) -->
                    <circle class="terminal-station" cx="50" cy="90" />
                    <text class="station-label label-below" x="50" y="105">Uttara North</text>

                    <!-- Uttara Center -->
                    <circle class="station" cx="110" cy="90" />
                    <text class="station-label label-above" x="110" y="75">Uttara Center</text>

                    <!-- Uttara South -->
                    <circle class="station" cx="170" cy="90" />
                    <text class="station-label label-below" x="170" y="105">Uttara South</text>

                    <!-- Pallabi -->
                    <circle class="station" cx="230" cy="90" />
                    <text class="station-label label-above" x="230" y="75">Pallabi</text>

                    <!-- Mirpur 11 -->
                    <circle class="station" cx="280" cy="105" />
                    <text class="station-label label-below" x="280" y="120">Mirpur 11</text>

                    <!-- Mirpur 10 -->
                    <circle class="station" cx="330" cy="110" />
                    <text class="station-label label-above" x="330" y="95">Mirpur 10</text>

                    <!-- Kazipara -->
                    <circle class="station" cx="380" cy="105" />
                    <text class="station-label label-below" x="380" y="120">Kazipara</text>

                    <!-- Shewrapara -->
                    <circle class="station" cx="430" cy="90" />
                    <text class="station-label label-above" x="430" y="75">Shewrapara</text>

                    <!-- Agargaon -->
                    <circle class="station" cx="480" cy="90" />
                    <text class="station-label label-below" x="480" y="105">Agargaon</text>

                    <!-- Bijoy Sarani -->
                    <circle class="station" cx="530" cy="90" />
                    <text class="station-label label-above" x="530" y="75">Bijoy Sarani</text>

                    <!-- Farmgate -->
                    <circle class="station" cx="580" cy="75" />
                    <text class="station-label label-below" x="580" y="90">Farmgate</text>

                    <!-- Karwan Bazar -->
                    <circle class="station" cx="630" cy="70" />
                    <text class="station-label label-above" x="630" y="55">Karwan Bazar</text>

                    <!-- Shahbag -->
                    <circle class="station" cx="680" cy="75" />
                    <text class="station-label label-below" x="680" y="90">Shahbag</text>

                    <!-- Dhaka University -->
                    <circle class="station" cx="730" cy="90" />
                    <text class="station-label label-above" x="730" y="75">Dhaka University</text>

                    <!-- Bangladesh Secretariat -->
                    <circle class="station" cx="830" cy="90" />
                    <text class="station-label label-below" x="830" y="105">Bangladesh Secretariat</text>

                    <!-- Motijheel -->
                    <circle class="station" cx="950" cy="110" />
                    <text class="station-label label-above" x="950" y="95">Motijheel</text>

                    <!-- Kamlapur (Terminal) -->
                    <circle class="terminal-station" cx="1010" cy="110" />
                    <text class="station-label label-below" x="1010" y="125">Kamlapur</text>
                </svg>
            </div>
        </div>

        <div class="mt-6 flex justify-center">
            <a href="/route" class="bg-metro-primary hover:bg-metro-dark text-white py-2 px-6 rounded-lg transition flex items-center justify-center gap-2">
                <i class="fas fa-map-marked-alt"></i>
                <span>View detailed route map</span>
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fromStation = document.getElementById('from-station');
        const toStation = document.getElementById('to-station');
        const fareResult = document.getElementById('fare-result');
        const swapButton = document.getElementById('swap-stations');

        // Load fares from PHP to JavaScript
        const fares = @json(config('stations.fares'));

        function updateFare() {
            const from = fromStation.value;
            const to = toStation.value;

            if (from && to && fares[from] && fares[from][to]) {
                fareResult.innerHTML = `<p class="text-center text-lg font-semibold text-green-600">Fare: ৳${fares[from][to]}</p>`;
            } else {
                fareResult.innerHTML = `<p class="text-center text-lg">Select stations to calculate fare</p>`;
            }
        }

        // Swap Functionality
        swapButton.addEventListener('click', function () {
            const tempValue = fromStation.value;
            fromStation.value = toStation.value;
            toStation.value = tempValue;
            updateFare(); // Recalculate fare after swapping
        });

        fromStation.addEventListener('change', updateFare);
        toStation.addEventListener('change', updateFare);
    });
</script>




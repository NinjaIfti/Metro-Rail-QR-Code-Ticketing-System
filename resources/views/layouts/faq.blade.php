<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metro Rail - Frequently Asked Questions</title>
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
    <link rel="icon" type="image/png" href="{{ asset('images/metrorailforico.png') }}">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

<!-- Header would be included here -->
@include('components/navbar')

<!-- Main Content -->
<main class="container mx-auto px-4 py-8 max-w-7xl">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-metro-dark mb-2">Frequently Asked Questions</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Find answers to the most common questions about Dhaka Metro Rail services.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Side: FAQ Content -->
        <div class="w-full lg:w-3/5">
            <!-- Search Box -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-search mr-2"></i>
                    Search FAQs
                </h2>
                <div class="relative">
                    <input type="text" id="faq-search" class="w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-3 px-5 pl-10 border" placeholder="Search frequently asked questions...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- FAQ Categories -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-layer-group mr-2"></i>
                    Categories
                </h2>
                <div class="flex flex-wrap gap-3">
                    <button class="px-4 py-2 bg-metro-primary text-white rounded-md hover:bg-metro-dark transition-all text-sm font-medium" data-category="all">All FAQs</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-all text-sm font-medium" data-category="tickets">Tickets & Fares</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-all text-sm font-medium" data-category="services">Services</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-all text-sm font-medium" data-category="travel">Travel Information</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-all text-sm font-medium" data-category="accessibility">Accessibility</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-all text-sm font-medium" data-category="safety">Safety & Security</button>
                </div>
            </div>

            <!-- Tickets & Fares -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6" data-category="tickets">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-ticket-alt mr-2"></i>
                    Tickets & Fares
                </h2>
                <div class="space-y-4">
                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>How much does a Metro ticket cost?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Metro ticket prices vary based on the distance traveled (number of zones). Fares range from 20 BDT for travel within the same zone up to 60 BDT for longer journeys across multiple zones. Discounts are available for children (50% off), senior citizens (30% off), and return journeys (10% off).</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>Where can I buy Metro tickets?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>You can purchase Metro tickets through multiple channels:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Ticket counters at all Metro stations</li>
                                <li>Self-service ticket vending machines</li>
                                <li>Online through the official Dhaka Metro website</li>
                                <li>Via the Dhaka Metro mobile application</li>
                                <li>Through authorized third-party vendors and retailers</li>
                            </ul>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>How long are tickets valid for?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Single journey tickets are valid for 3 hours from the time of purchase. Return tickets are valid for the entire day of purchase until service closure. Day passes are valid for 24 hours from the first use. Monthly passes are valid for the calendar month indicated on the pass.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>Are there any discounts available?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Yes, several discounts are available:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Children aged 5-17: 50% discount</li>
                                <li>Senior citizens (60+): 30% discount</li>
                                <li>Return journeys: 10% discount</li>
                                <li>Students: 20% discount with valid student ID</li>
                                <li>Persons with disabilities: 50% discount</li>
                                <li>Group tickets (10+ passengers): 15% discount</li>
                            </ul>
                            <p class="mt-2">Children under 5 years travel free when accompanied by a paying adult.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>Can I get a refund for my unused ticket?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Yes, unused tickets can be refunded subject to the following conditions:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Single journey tickets can be refunded up to 1 hour before the scheduled journey</li>
                                <li>Day passes can be refunded if unused</li>
                                <li>Monthly passes can be partially refunded based on remaining days</li>
                            </ul>
                            <p class="mt-2">A small processing fee of 10 BDT applies to all refunds. Please visit any ticket counter with your valid ID and payment receipt to process your refund.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6" data-category="services">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-cogs mr-2"></i>
                    Services
                </h2>
                <div class="space-y-4">
                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>What are the operating hours of the Metro?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>The Dhaka Metro operates during the following hours:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Monday to Friday: 6:00 AM to 10:00 PM</li>
                                <li>Saturday and Sunday: 8:00 AM to 10:00 PM</li>
                                <li>Public holidays: 8:00 AM to 10:00 PM</li>
                            </ul>
                            <p class="mt-2">During special events or national holidays, the operating hours may be extended. Please check the website or mobile app for the latest updates.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>How frequently do trains arrive?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Train frequency varies based on time of day:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Peak hours (7:00 AM - 10:00 AM & 4:00 PM - 8:00 PM): Every 5-7 minutes</li>
                                <li>Off-peak hours: Every 10-12 minutes</li>
                                <li>Weekends and holidays: Every 10-15 minutes</li>
                            </ul>
                            <p class="mt-2">Real-time train arrival information is displayed at all stations and is available on the Metro mobile app.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>Is there WiFi available on the Metro?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Yes, free WiFi is available at all Metro stations and on board all trains. To connect:</p>
                            <ol class="list-decimal pl-5 mt-2 space-y-1">
                                <li>Select "Dhaka-Metro-WiFi" from your device's WiFi settings</li>
                                <li>Open your browser, which will redirect to the login page</li>
                                <li>Enter your phone number to receive a one-time password (OTP)</li>
                                <li>Enter the OTP to connect to the WiFi network</li>
                            </ol>
                            <p class="mt-2">The WiFi service provides basic internet browsing speeds and has a daily usage limit of 100 MB per device.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>Are there restrooms available at the stations?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Yes, public restrooms are available at all Metro stations. They are located near the ticket counters or concourse areas. All restrooms include accessible facilities for persons with disabilities. A nominal fee of 5 BDT applies for using the restrooms, except for Metro pass holders who can use them free of charge.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Travel Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6" data-category="travel">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-route mr-2"></i>
                    Travel Information
                </h2>
                <div class="space-y-4">
                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>What is the baggage allowance on the Metro?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Each passenger may carry up to two pieces of hand luggage not exceeding 20kg in total weight. The maximum dimensions allowed for any single item are 60cm x 40cm x 30cm. Oversized items, including bicycles, are not permitted on the Metro during peak hours (7:00 AM - 10:00 AM & 4:00 PM - 8:00 PM).</p>
                            <p class="mt-2">Folding bicycles are allowed at all times if they are completely folded and do not exceed the standard baggage dimensions.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>Are food and drinks allowed on the Metro?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Non-alcoholic beverages in resealable containers are allowed on the Metro. Light snacks that don't produce strong odors or leave residue can be consumed. However, we encourage passengers to avoid eating messy or aromatic foods out of courtesy to other passengers.</p>
                            <p class="mt-2">Alcoholic beverages are strictly prohibited. All passengers are requested to dispose of any waste in the designated bins located on platforms and inside the trains.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>Can I bring pets on the Metro?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Small pets can be brought onto the Metro under the following conditions:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>They must be carried in an appropriate pet carrier or container</li>
                                <li>The carrier must not occupy a seat</li>
                                <li>The owner is responsible for their pet's behavior</li>
                                <li>Pets are not allowed during peak hours (7:00 AM - 10:00 AM & 4:00 PM - 8:00 PM)</li>
                            </ul>
                            <p class="mt-2">Service animals for persons with disabilities are allowed at all times without restrictions, provided they are properly harnessed and under control.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>What items are prohibited on the Metro?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>The following items are prohibited on the Metro:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Flammable materials, explosives, and hazardous chemicals</li>
                                <li>Weapons of any kind, including replicas</li>
                                <li>Oversized items that obstruct pathways or seating</li>
                                <li>Non-folding bicycles during all hours</li>
                                <li>Alcoholic beverages and illegal substances</li>
                                <li>Items with strong odors that may disturb other passengers</li>
                            </ul>
                            <p class="mt-2">All luggage may be subject to security screening at station entrances.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accessibility -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6" data-category="accessibility">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-wheelchair mr-2"></i>
                    Accessibility
                </h2>
                <div class="space-y-4">
                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>Is the Metro accessible for wheelchair users?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Yes, all Dhaka Metro stations and trains are fully accessible to wheelchair users. Each station is equipped with:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Elevators connecting all levels</li>
                                <li>Ramps at all entrances</li>
                                <li>Accessible ticket counters with lower sections</li>
                                <li>Accessible restrooms</li>
                                <li>Tactile paths for visually impaired passengers</li>
                            </ul>
                            <p class="mt-2">All trains have designated spaces for wheelchairs with securing mechanisms and priority seating nearby for companions.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>What facilities are available for visually impaired passengers?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>The Metro provides the following facilities for visually impaired passengers:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Tactile guides throughout all stations</li>
                                <li>Braille signage at key points and on elevator buttons</li>
                                <li>Audio announcements for all train arrivals and stops</li>
                                <li>Staff trained to assist visually impaired travelers</li>
                                <li>Metro maps available in Braille format at information counters</li>
                            </ul>
                            <p class="mt-2">Service animals for visually impaired passengers are allowed at all times without restrictions.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>Are there priority seats for elderly or pregnant passengers?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Yes, each Metro car has clearly marked priority seats reserved for:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Elderly passengers</li>
                                <li>Pregnant women</li>
                                <li>Passengers with disabilities</li>
                                <li>Passengers with small children</li>
                            </ul>
                            <p class="mt-2">These seats are located near the doors for easy access. While we rely on the courtesy of passengers to vacate these seats when needed, Metro staff can assist if required.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>Is assistance available for passengers with disabilities?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Yes, Dhaka Metro provides assistance for passengers with disabilities. Station staff are trained to assist passengers who need help navigating the stations or boarding trains.</p>
                            <p class="mt-2">For pre-arranged assistance, please call our customer service hotline at 16XX at least 2 hours before your journey. A staff member will meet you at the station entrance and assist you throughout your journey if required.</p>
                            <p class="mt-2">Assistance services are provided free of charge to all passengers who need them.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Safety & Security -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6" data-category="safety">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Safety & Security
                </h2>
                <div class="space-y-4">
                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>What security measures are in place at Metro stations?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Dhaka Metro implements comprehensive security measures including:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Security checkpoints with baggage screening at all station entrances</li>
                                <li>CCTV surveillance throughout all stations and trains</li>
                                <li>Regular security patrols by trained personnel</li>
                                <li>Emergency help points on platforms and inside trains</li>
                                <li>Automated fire detection and suppression systems</li>
                            </ul>
                            <p class="mt-2">All security staff undergo rigorous training and regular refresher courses to ensure passenger safety.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>What should I do in case of an emergency?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>In case of an emergency:</p>
                            <ol class="list-decimal pl-5 mt-2 space-y-1">
                                <li>Stay calm and follow instructions from Metro staff or announcements</li>
                                <li>Use the emergency help points on platforms or inside trains to contact staff</li>
                                <li>In trains, use the emergency communication system located near the doors</li>
                                <li>For medical emergencies, alert any staff member who can call for medical assistance</li>
                                <li>In case of evacuation, follow the illuminated emergency exit signs</li>
                            </ol>
                            <p class="mt-2">All stations and trains are equipped with first aid kits and automated external defibrillators (AEDs). Staff are trained in basic first aid and emergency response procedures.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>How can I report suspicious activity or lost items?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>To report suspicious activity:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Alert any Metro staff member immediately</li>
                                <li>Use the emergency help points located on platforms and inside trains</li>
                                <li>Call our security hotline at 16XX (option 2)</li>
                            </ul>
                            <p class="mt-2">For lost items:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li>Visit the Lost & Found office at any terminal station (Uttara North or Kamlapur)</li>
                                <li>Call the customer service line at 16XX (option 3)</li>
                                <li>Fill out the lost item form on our website or mobile app</li>
                            </ul>
                            <p class="mt-2">Lost items are kept for 30 days before being donated to charity if unclaimed.</p>
                        </div>
                    </div>

                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all bg-gray-50 p-4 rounded-lg" onclick="toggleFAQ(this)">
                            <span>Are there women-only carriages or sections?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 p-4 border-l-2 border-metro-light rounded-r-lg bg-gray-50">
                            <p>Yes, the first car of each Metro train is designated as a women-only carriage during peak hours (7:00 AM - 10:00 AM & 4:00 PM - 8:00 PM). This carriage is clearly marked with pink signage.</p>
                            <p class="mt-2">Outside of peak hours, the women-only carriage is open to all passengers. Male children under the age of 12 can accompany female passengers in the women-only carriage at all times.</p>
                            <p class="mt-2">Security personnel monitor these carriages to ensure compliance with this policy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Additional Information -->
        <div class="w-full lg:w-2/5">
            <!-- Quick Metro Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Metro Information
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
                            <i class="fas fa-train text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-medium">Train Frequency</h3>
                            <p class="text-gray-600">Peak Hours: Every 5-7 minutes</p>
                            <p class="text-gray-600">Off-Peak: Every 10-12 minutes</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="text-metro-primary mr-3 mt-1">
                            <i class="fas fa-ticket-alt text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-medium">Fare Range</h3>
                            <p class="text-gray-600">20-100 BDT based on journey distance</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="text-metro-primary mr-3 mt-1">
                            <i class="fas fa-wifi text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-medium">Free WiFi</h3>
                            <p class="text-gray-600">Available at all stations and on trains</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="text-metro-primary mr-3 mt-1">
                            <i class="fas fa-wheelchair text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-medium">Accessibility</h3>
                            <p class="text-gray-600">All stations are fully accessible</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular Questions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-star mr-2"></i>
                    Popular Questions
                </h2>
                <div class="space-y-3">
                    <a href="#" class="block p-3 hover:bg-metro-light rounded-lg transition-all" onclick="openPopularQuestion('tickets-cost')">
                        <div class="flex items-start">
                            <div class="text-metro-primary mr-3">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <p class="text-gray-800">How much does a Metro ticket cost?</p>
                        </div>
                    </a>
                    <a href="#" class="block p-3 hover:bg-metro-light rounded-lg transition-all" onclick="openPopularQuestion('operating-hours')">
                        <div class="flex items-start">
                            <div class="text-metro-primary mr-3">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <p class="text-gray-800">What are the operating hours?</p>
                        </div>
                    </a>
                    <a href="#" class="block p-3 hover:bg-metro-light rounded-lg transition-all" onclick="openPopularQuestion('baggage-allowance')">
                        <div class="flex items-start">
                            <div class="text-metro-primary mr-3">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <p class="text-gray-800">What is the baggage allowance?</p>
                        </div>
                    </a>
                    <a href="#" class="block p-3 hover:bg-metro-light rounded-lg transition-all" onclick="openPopularQuestion('wheelchair-access')">
                        <div class="flex items-start">
                            <div class="text-metro-primary mr-3">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <p class="text-gray-800">Is the Metro accessible for wheelchair users?</p>
                        </div>
                    </a>
                    <a href="#" class="block p-3 hover:bg-metro-light rounded-lg transition-all" onclick="openPopularQuestion('women-only')">
                        <div class="flex items-start">
                            <div class="text-metro-primary mr-3">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <p class="text-gray-800">Are there women-only carriages?</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Contact Us -->
            <div class="bg-metro-light rounded-xl p-6 mb-6">
                <h2 class="text-lg font-semibold mb-3 text-metro-dark flex items-center">
                    <i class="fas fa-headset mr-2"></i>
                    Need More Help?
                </h2>

                <p class="text-sm text-gray-700 mb-4">Our customer service team is available to assist you with any questions not covered in our FAQs.</p>

                <div class="space-y-3">
                    <a href="tel:16XX" class="flex items-center text-metro-primary hover:text-metro-dark transition-all">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <span>16XX (Hotline)</span>
                    </a>

                    <a href="mailto:support@dhakarmetro.gov.bd" class="flex items-center text-metro-primary hover:text-metro-dark transition-all">
                        <i class="fas fa-envelope mr-2"></i>
                        <span>support@dhakarmetro.gov.bd</span>
                    </a>

                    <a href="/contact" class="flex items-center text-metro-primary hover:text-metro-dark transition-all">
                        <i class="fas fa-comment-dots mr-2"></i>
                        <span>Contact Form</span>
                    </a>
                </div>

                <div class="mt-6">
                    <a href="/buy-ticket" class="bg-metro-primary hover:bg-metro-dark text-white py-3 px-6 rounded-lg transition-all text-center block font-medium">
                        <i class="fas fa-ticket-alt mr-2"></i>
                        Buy Tickets
                    </a>
                </div>
            </div>

            <!-- Feedback Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-semibold mb-4 text-metro-primary flex items-center">
                    <i class="fas fa-comment-alt mr-2"></i>
                    Was This Helpful?
                </h2>
                <p class="text-sm text-gray-600 mb-4">Help us improve our FAQ section by providing your feedback</p>

                <div class="flex space-x-2 mb-4">
                    <button class="flex-1 border rounded-md py-2 hover:bg-metro-light transition-all">
                        <i class="far fa-thumbs-up text-metro-primary mr-1"></i> Yes
                    </button>
                    <button class="flex-1 border rounded-md py-2 hover:bg-metro-light transition-all">
                        <i class="far fa-thumbs-down text-metro-primary mr-1"></i> No
                    </button>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Suggest a question we should add</label>
                    <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-2 px-3 border" rows="2" placeholder="Your question suggestion..."></textarea>
                </div>

                <div class="mt-4">
                    <button class="px-4 py-2 bg-metro-primary text-white rounded-md hover:bg-metro-dark transition-all text-sm font-medium">Submit Feedback</button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer would be included here -->
@include('.components/footer')

<!-- Back to Top Button -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-metro-primary text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg transform transition-transform hover:scale-110 hidden">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- JavaScript for FAQ functionality -->
<script>
    // Toggle FAQ visibility
    function toggleFAQ(button) {
        // Toggle the answer visibility
        const answer = button.nextElementSibling;
        answer.classList.toggle('hidden');

        // Toggle the icon rotation
        const icon = button.querySelector('i');
        icon.classList.toggle('transform');
        icon.classList.toggle('rotate-180');
    }

    // Popular Questions Handler
    function openPopularQuestion(questionId) {
        // Map of question IDs to their respective category and index
        const questionMap = {
            'tickets-cost': { category: 'tickets', index: 0 },
            'operating-hours': { category: 'services', index: 0 },
            'baggage-allowance': { category: 'travel', index: 0 },
            'wheelchair-access': { category: 'accessibility', index: 0 },
            'women-only': { category: 'safety', index: 3 }
        };

        const question = questionMap[questionId];
        if (!question) return;

        // First activate the correct category
        const categoryButtons = document.querySelectorAll('[data-category]');
        categoryButtons.forEach(btn => {
            if (btn.getAttribute('data-category') === question.category) {
                btn.click();
            }
        });

        // Then find and open the specific question
        const categorySection = document.querySelector(`[data-category="${question.category}"]`);
        if (!categorySection) return;

        const faqItems = categorySection.querySelectorAll('.faq-item');
        if (faqItems.length > question.index) {
            // Scroll to the item
            faqItems[question.index].scrollIntoView({ behavior: 'smooth', block: 'center' });

            // Open the question after a small delay to allow scrolling
            setTimeout(() => {
                const button = faqItems[question.index].querySelector('button');
                if (button) {
                    toggleFAQ(button);
                }
            }, 500);
        }

        // Prevent default action
        event.preventDefault();
    }

    // Category filtering
    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('[data-category]');
        const faqSections = document.querySelectorAll('[data-category]');

        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.getAttribute('data-category');

                // Update active button styles
                categoryButtons.forEach(btn => {
                    if (btn === this) {
                        btn.classList.remove('bg-gray-100', 'text-gray-700');
                        btn.classList.add('bg-metro-primary', 'text-white');
                    } else {
                        btn.classList.remove('bg-metro-primary', 'text-white');
                        btn.classList.add('bg-gray-100', 'text-gray-700');
                    }
                });

                // Filter FAQ sections
                if (category === 'all') {
                    faqSections.forEach(section => {
                        section.style.display = 'block';
                    });
                } else {
                    faqSections.forEach(section => {
                        if (section.getAttribute('data-category') === category) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    });
                }
            });
        });

        // Search functionality
        const searchInput = document.getElementById('faq-search');
        const faqItems = document.querySelectorAll('.faq-item');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            if (searchTerm.length < 2) {
                // Show all categories if search term is too short
                categoryButtons[0].click();
                faqItems.forEach(item => {
                    item.style.display = 'block';
                });
                return;
            }

            // Show all categories for searching
            faqSections.forEach(section => {
                section.style.display = 'block';
            });

            // Filter FAQ items based on search
            let hasResults = false;

            faqItems.forEach(item => {
                const question = item.querySelector('button span').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();

                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';

                    // Expand items that match search
                    const answer = item.querySelector('.faq-answer');
                    const icon = item.querySelector('button i');

                    if (answer.classList.contains('hidden')) {
                        answer.classList.remove('hidden');
                        icon.classList.add('transform', 'rotate-180');
                    }

                    hasResults = true;
                } else {
                    item.style.display = 'none';
                }
            });

            // Update category buttons to show active state for "All" during search
            categoryButtons.forEach(btn => {
                if (btn.getAttribute('data-category') === 'all') {
                    btn.classList.add('bg-metro-primary', 'text-white');
                    btn.classList.remove('bg-gray-100', 'text-gray-700');
                } else {
                    btn.classList.remove('bg-metro-primary', 'text-white');
                    btn.classList.add('bg-gray-100', 'text-gray-700');
                }
            });
        });

        // Back to top button functionality
        const backToTopButton = document.getElementById('back-to-top');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('hidden');
            } else {
                backToTopButton.classList.add('hidden');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
</body>
</html>

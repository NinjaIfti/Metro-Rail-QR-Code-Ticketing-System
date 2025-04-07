@extends('layouts.app')

@section('title', 'Frequently Asked Questions - Dhaka Metro Rail')

@section('content')
    <main class="container mx-auto px-4 py-8 max-w-5xl">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-metro-dark mb-2">Frequently Asked Questions</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Find answers to the most common questions about Dhaka Metro Rail services.</p>
        </div>

        <!-- Search Box -->
        <div class="mb-10">
            <div class="max-w-xl mx-auto">
                <div class="relative">
                    <input type="text" id="faq-search" class="w-full rounded-full border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary focus:ring-opacity-50 py-3 px-5 pl-12 border" placeholder="Search frequently asked questions...">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Categories -->
        <div class="mb-8">
            <div class="flex flex-wrap justify-center gap-2 sm:gap-4">
                <button class="px-4 py-2 bg-metro-primary text-white rounded-full hover:bg-metro-dark transition-all text-sm font-medium" data-category="all">All FAQs</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-all text-sm font-medium" data-category="tickets">Tickets & Fares</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-all text-sm font-medium" data-category="services">Services</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-all text-sm font-medium" data-category="travel">Travel Information</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-all text-sm font-medium" data-category="accessibility">Accessibility</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-all text-sm font-medium" data-category="safety">Safety & Security</button>
            </div>
        </div>

        <!-- FAQ Items -->
        <div class="space-y-6 mb-12">
            <!-- Tickets & Fares -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" data-category="tickets">
                <div class="bg-metro-primary bg-opacity-10 px-6 py-4 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-metro-primary">Tickets & Fares</h2>
                </div>
                <div class="p-6 space-y-4">
                    <!-- FAQ Item -->
                    <div class="faq-item">
                        <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                            <span>Are there women-only carriages or sections?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
                        </button>
                        <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
                            <p>Yes, the first car of each Metro train is designated as a women-only carriage during peak hours (7:00 AM - 10:00 AM & 4:00 PM - 8:00 PM). This carriage is clearly marked with pink signage.</p>
                            <p class="mt-2">Outside of peak hours, the women-only carriage is open to all passengers. Male children under the age of 12 can accompany female passengers in the women-only carriage at all times.</p>
                            <p class="mt-2">Security personnel monitor these carriages to ensure compliance with this policy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="bg-metro-light rounded-xl p-6 mb-8">
            <div class="text-center">
                <h2 class="text-xl font-semibold mb-4 text-metro-dark">Couldn't Find Your Answer?</h2>
                <p class="text-gray-700 mb-6">Our customer support team is available to assist you with any additional questions.</p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="tel:16XX" class="flex items-center bg-white py-3 px-5 rounded-lg shadow-sm hover:shadow-md transition-all">
                        <i class="fas fa-phone-alt text-metro-primary mr-2"></i>
                        <span>Call 16XX</span>
                    </a>

                    <a href="mailto:support@dhakarmetro.gov.bd" class="flex items-center bg-white py-3 px-5 rounded-lg shadow-sm hover:shadow-md transition-all">
                        <i class="fas fa-envelope text-metro-primary mr-2"></i>
                        <span>Email Support</span>
                    </a>

                    <a href="/contact" class="flex items-center bg-white py-3 px-5 rounded-lg shadow-sm hover:shadow-md transition-all">
                        <i class="fas fa-comment-dots text-metro-primary mr-2"></i>
                        <span>Contact Form</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript for FAQ functionality -->
    <script>
        function toggleFAQ(button) {
            // Toggle the answer visibility
            const answer = button.nextElementSibling;
            answer.classList.toggle('hidden');

            // Toggle the icon rotation
            const icon = button.querySelector('i');
            icon.classList.toggle('transform');
            icon.classList.toggle('rotate-180');
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
        });
    </script>
@endsection" onclick="toggleFAQ(this)">
<span>How much does a Metro ticket cost?</span>
<i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
</button>
<div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
    <p>Metro ticket prices vary based on the distance traveled (number of zones). Fares range from 20 BDT for travel within the same zone up to 60 BDT for longer journeys across multiple zones. Discounts are available for children (50% off), senior citizens (30% off), and return journeys (10% off).</p>
</div>
</div>

<!-- FAQ Item -->
<div class="faq-item pt-4 border-t border-gray-100">
    <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
        <span>Where can I buy Metro tickets?</span>
        <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
    </button>
    <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
<div class="faq-item pt-4 border-t border-gray-100">
    <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
        <span>How long are tickets valid for?</span>
        <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
    </button>
    <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
        <p>Single journey tickets are valid for 3 hours from the time of purchase. Return tickets are valid for the entire day of purchase until service closure. Day passes are valid for 24 hours from the first use. Monthly passes are valid for the calendar month indicated on the pass.</p>
    </div>
</div>

<!-- FAQ Item -->
<div class="faq-item pt-4 border-t border-gray-100">
    <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
        <span>Are there any discounts available?</span>
        <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
    </button>
    <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
<div class="faq-item pt-4 border-t border-gray-100">
    <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
        <span>Can I get a refund for my unused ticket?</span>
        <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
    </button>
    <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" data-category="services">
    <div class="bg-metro-primary bg-opacity-10 px-6 py-4 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-metro-primary">Services</h2>
    </div>
    <div class="p-6 space-y-4">
        <!-- FAQ Item -->
        <div class="faq-item">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>What are the operating hours of the Metro?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>How frequently do trains arrive?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>Is there WiFi available on the Metro?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>Are there restrooms available at the stations?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
                <p>Yes, public restrooms are available at all Metro stations. They are located near the ticket counters or concourse areas. All restrooms include accessible facilities for persons with disabilities. A nominal fee of 5 BDT applies for using the restrooms, except for Metro pass holders who can use them free of charge.</p>
            </div>
        </div>
    </div>
</div>

<!-- Travel Information -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" data-category="travel">
    <div class="bg-metro-primary bg-opacity-10 px-6 py-4 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-metro-primary">Travel Information</h2>
    </div>
    <div class="p-6 space-y-4">
        <!-- FAQ Item -->
        <div class="faq-item">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>What is the baggage allowance on the Metro?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
                <p>Each passenger may carry up to two pieces of hand luggage not exceeding 20kg in total weight. The maximum dimensions allowed for any single item are 60cm x 40cm x 30cm. Oversized items, including bicycles, are not permitted on the Metro during peak hours (7:00 AM - 10:00 AM & 4:00 PM - 8:00 PM).</p>
                <p class="mt-2">Folding bicycles are allowed at all times if they are completely folded and do not exceed the standard baggage dimensions.</p>
            </div>
        </div>

        <!-- FAQ Item -->
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>Are food and drinks allowed on the Metro?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
                <p>Non-alcoholic beverages in resealable containers are allowed on the Metro. Light snacks that don't produce strong odors or leave residue can be consumed. However, we encourage passengers to avoid eating messy or aromatic foods out of courtesy to other passengers.</p>
                <p class="mt-2">Alcoholic beverages are strictly prohibited. All passengers are requested to dispose of any waste in the designated bins located on platforms and inside the trains.</p>
            </div>
        </div>

        <!-- FAQ Item -->
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>Can I bring pets on the Metro?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>What items are prohibited on the Metro?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" data-category="accessibility">
    <div class="bg-metro-primary bg-opacity-10 px-6 py-4 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-metro-primary">Accessibility</h2>
    </div>
    <div class="p-6 space-y-4">
        <!-- FAQ Item -->
        <div class="faq-item">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>Is the Metro accessible for wheelchair users?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>What facilities are available for visually impaired passengers?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>Are there priority seats for elderly or pregnant passengers?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>Is assistance available for passengers with disabilities?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
                <p>Yes, Dhaka Metro provides assistance for passengers with disabilities. Station staff are trained to assist passengers who need help navigating the stations or boarding trains.</p>
                <p class="mt-2">For pre-arranged assistance, please call our customer service hotline at 16XX at least 2 hours before your journey. A staff member will meet you at the station entrance and assist you throughout your journey if required.</p>
                <p class="mt-2">Assistance services are provided free of charge to all passengers who need them.</p>
            </div>
        </div>
    </div>
</div>

<!-- Safety & Security -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" data-category="safety">
    <div class="bg-metro-primary bg-opacity-10 px-6 py-4 border-b border-gray-100">
        <h2 class="text-xl font-semibold text-metro-primary">Safety & Security</h2>
    </div>
    <div class="p-6 space-y-4">
        <!-- FAQ Item -->
        <div class="faq-item">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>What security measures are in place at Metro stations?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>What should I do in case of an emergency?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all" onclick="toggleFAQ(this)">
                <span>How can I report suspicious activity or lost items?</span>
                <i class="fas fa-chevron-down text-gray-400 transition-transform"></i>
            </button>
            <div class="faq-answer hidden mt-3 text-gray-600 pl-5 border-l-2 border-gray-200">
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
        <div class="faq-item pt-4 border-t border-gray-100">
            <button class="flex justify-between items-center w-full text-left font-medium text-gray-800 hover:text-metro-primary transition-all

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Dhaka Metro Rail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'metro-primary': '#0a4275',
                        'metro-secondary': '#ffc107',
                        'metro-dark': '#062040',
                        'metro-light': '#e6f4ff',
                    }
                }
            }
        }
    </script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('images/metrorailforico.png') }}">
</head>
<body class="font-sans bg-gray-50 text-gray-800 w-full">
<!-- Navbar -->
@include('components/navbar')

<!-- Hero Section -->
<section class="relative bg-metro-primary py-20">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute left-0 right-0 top-0 bg-cover bg-center h-full opacity-10" style="background-image: url('{{ asset('images/metro-rail.avif') }}');"></div>
    </div>
    <div class="relative container mx-auto px-4 sm:px-6 text-center text-white z-10">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Contact Us</h1>
        <p class="text-lg sm:text-xl max-w-2xl mx-auto">We're here to help! Get in touch with the Dhaka Metro Rail team for assistance, feedback, or inquiries.</p>
    </div>
</section>

<!-- Contact Info Cards -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1: General Inquiries -->
            <div class="bg-gray-50 rounded-xl shadow-md p-6 text-center transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="w-16 h-16 bg-metro-light rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-info-circle text-metro-primary text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">General Inquiries</h3>
                <p class="text-gray-600 mb-4">For general information about Dhaka Metro Rail services.</p>
                <div class="space-y-2">
                    <p class="flex items-center justify-center">
                        <i class="fas fa-envelope mr-2 text-metro-primary"></i>
                        <a href="mailto:info@dhakametrorail.gov.bd" class="text-metro-primary hover:underline">info@dhakametrorail.gov.bd</a>
                    </p>
                    <p class="flex items-center justify-center">
                        <i class="fas fa-phone-alt mr-2 text-metro-primary"></i>
                        <a href="tel:+880255028000" class="text-metro-primary hover:underline">+880 2 550 28000</a>
                    </p>
                </div>
            </div>

            <!-- Card 2: Customer Support -->
            <div class="bg-gray-50 rounded-xl shadow-md p-6 text-center transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="w-16 h-16 bg-metro-light rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-metro-primary text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Customer Support</h3>
                <p class="text-gray-600 mb-4">For help with tickets, lost items, or service issues.</p>
                <div class="space-y-2">
                    <p class="flex items-center justify-center">
                        <i class="fas fa-envelope mr-2 text-metro-primary"></i>
                        <a href="mailto:support@dhakametrorail.gov.bd" class="text-metro-primary hover:underline">support@dhakametrorail.gov.bd</a>
                    </p>
                    <p class="flex items-center justify-center">
                        <i class="fas fa-phone-alt mr-2 text-metro-primary"></i>
                        <a href="tel:+8809612334455" class="text-metro-primary hover:underline">+880 9612 334455</a>
                    </p>
                </div>
            </div>

            <!-- Card 3: Emergency Contact -->
            <div class="bg-gray-50 rounded-xl shadow-md p-6 text-center transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Emergency Contact</h3>
                <p class="text-gray-600 mb-4">For emergencies or urgent safety concerns.</p>
                <div class="space-y-2">
                    <p class="flex items-center justify-center">
                        <i class="fas fa-phone-alt mr-2 text-red-600"></i>
                        <a href="tel:+8809611999999" class="text-red-600 hover:underline font-bold">+880 9611 999999</a>
                    </p>
                    <p class="text-sm text-gray-500">(Available 24/7)</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="py-16 bg-gradient-to-b from-white to-gray-100">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-2 text-center">Send Us a Message</h2>
            <p class="text-gray-600 mb-10 text-center">Please fill out the form below and we'll get back to you as soon as possible.</p>

            <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                <form action="" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                            <input type="text" id="name" name="name" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" placeholder="Your name" required>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" placeholder="your.email@example.com" required>
                        </div>
                    </div>

                    <!-- Phone Field -->
                    <div>
                        <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" placeholder="+880 1XXXXXXXXX">
                    </div>

                    <!-- Subject Field -->
                    <div>
                        <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                        <select id="subject" name="subject" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" required>
                            <option value="" disabled selected>Select a subject</option>
                            <option value="general_inquiry">General Inquiry</option>
                            <option value="ticket_issue">Ticket Issue</option>
                            <option value="lost_item">Lost Item</option>
                            <option value="service_feedback">Service Feedback</option>
                            <option value="accessibility">Accessibility Concern</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Message Field -->
                    <div>
                        <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" placeholder="Please describe your inquiry in detail..." required></textarea>
                    </div>

                    <!-- Attachment Field -->
                    <div>
                        <label for="attachment" class="block text-gray-700 font-medium mb-2">Attachment (optional)</label>
                        <input type="file" id="attachment" name="attachment" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all">
                        <p class="text-xs text-gray-500 mt-1">Max file size: 5MB (PDF, JPG, PNG)</p>
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" class="rounded border-gray-300 text-metro-primary shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-gray-700">I agree to the <a href="#" class="text-metro-primary hover:underline">Terms and Conditions</a> and <a href="#" class="text-metro-primary hover:underline">Privacy Policy</a></label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 px-6 bg-metro-primary hover:bg-metro-dark text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Visit Us Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <h2 class="text-3xl font-bold mb-2 text-center">Visit Us</h2>
        <p class="text-gray-600 mb-10 text-center">Our administrative offices are open weekdays from 9:00 AM to 5:00 PM.</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- Map -->
            <div class="rounded-xl overflow-hidden shadow-lg h-96 relative">
                <!-- Placeholder for the map iframe -->
                <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                    <p class="text-gray-500">Map Loading...</p>
                    <!-- You would replace this with an actual Google Maps embed -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9662738532363!2d90.38618611536308!3d23.75066469459436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8bd552c2a3b%3A0x4e70f117856f0c22!2sDhaka%20Mass%20Transit%20Company%20Limited%20(DMTCL)!5e0!3m2!1sen!2sbd!4v1618825548456!5m2!1sen!2sbd" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="absolute inset-0"></iframe>
                </div>
            </div>

            <!-- Address Information -->
            <div class="space-y-6">
                <div class="bg-gray-50 rounded-xl p-6 shadow-md">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-building mr-2 text-metro-primary"></i>
                        Head Office
                    </h3>
                    <address class="not-italic">
                        <p class="text-gray-700 mb-2">Dhaka Mass Transit Company Limited (DMTCL)</p>
                        <p class="text-gray-700 mb-2">Probashi Kallyan Bhaban (Level 14)</p>
                        <p class="text-gray-700 mb-4">71-72 Eskaton Garden, Dhaka-1000, Bangladesh</p>

                        <div class="flex items-center mb-2">
                            <i class="fas fa-phone-alt mr-2 text-metro-primary"></i>
                            <span>+880 2 550 28000</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-fax mr-2 text-metro-primary"></i>
                            <span>+880 2 550 28010</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-metro-primary"></i>
                            <a href="mailto:info@dmtcl.gov.bd" class="text-metro-primary hover:underline">info@dmtcl.gov.bd</a>
                        </div>
                    </address>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 shadow-md">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="far fa-clock mr-2 text-metro-primary"></i>
                        Office Hours
                    </h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-700">Sunday - Thursday:</span>
                            <span class="text-gray-900 font-medium">9:00 AM - 5:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Friday - Saturday:</span>
                            <span class="text-gray-900 font-medium">Closed</span>
                        </div>
                        <div class="pt-2 text-sm text-gray-500">
                            <p>* Government holidays may affect office hours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6">
        <h2 class="text-3xl font-bold mb-2 text-center">Frequently Asked Questions</h2>
        <p class="text-gray-600 mb-10 text-center">Find quick answers to common questions about contacting us.</p>

        <div class="max-w-3xl mx-auto space-y-4">
            <!-- FAQ Item 1 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <button class="w-full flex items-center justify-between bg-white p-4 text-left focus:outline-none">
                    <span class="font-medium">What are the metro rail customer service hours?</span>
                    <i class="fas fa-chevron-down text-metro-primary transition-transform"></i>
                </button>
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <p class="text-gray-700">Our customer service helpline is available from 6:00 AM to 10:30 PM daily, including weekends and holidays. For emergencies outside these hours, please use our emergency contact number.</p>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <button class="w-full flex items-center justify-between bg-white p-4 text-left focus:outline-none">
                    <span class="font-medium">How can I report a lost item on the metro?</span>
                    <i class="fas fa-chevron-down text-metro-primary transition-transform"></i>
                </button>
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <p class="text-gray-700">You can report a lost item by calling our customer support line, visiting the station master's office at any metro station, or by filling out the contact form on this page. Please provide details about when and where you lost the item, along with a description.</p>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <button class="w-full flex items-center justify-between bg-white p-4 text-left focus:outline-none">
                    <span class="font-medium">How long does it take to get a response to my inquiry?</span>
                    <i class="fas fa-chevron-down text-metro-primary transition-transform"></i>
                </button>
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <p class="text-gray-700">We aim to respond to all inquiries within 48 hours during business days. For urgent matters, please call our customer support line for immediate assistance.</p>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <button class="w-full flex items-center justify-between bg-white p-4 text-left focus:outline-none">
                    <span class="font-medium">Can I visit the metro rail office without an appointment?</span>
                    <i class="fas fa-chevron-down text-metro-primary transition-transform"></i>
                </button>
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <p class="text-gray-700">While we welcome visitors, we recommend scheduling an appointment for specific inquiries to ensure the relevant staff are available to assist you. General information can be obtained without an appointment during regular office hours.</p>
                </div>
            </div>

            <!-- More FAQs button -->
            <div class="text-center pt-4">
                <a href="{{ route('FAQ') }}" class="inline-flex items-center text-metro-primary hover:text-metro-dark font-medium">
                    <span>View all FAQs</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
@include('components/footer')

<!-- Back to Top Button -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-metro-primary text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg transform transition-transform hover:scale-110 hidden">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- JavaScript for Back to Top Button and FAQ Accordion -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // FAQ Accordion
        const faqButtons = document.querySelectorAll('.border.border-gray-200.rounded-lg.overflow-hidden button');

        faqButtons.forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const icon = button.querySelector('i');

                // Toggle current accordion
                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');

                // Close other open accordions (uncomment if you want only one open at a time)
                /*
                faqButtons.forEach(otherButton => {
                    if (otherButton !== button) {
                        const otherContent = otherButton.nextElementSibling;
                        const otherIcon = otherButton.querySelector('i');

                        otherContent.classList.add('hidden');
                        otherIcon.classList.remove('rotate-180');
                    }
                });
                */
            });
        });
    });
</script>
</body>
</html>

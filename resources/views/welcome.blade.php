<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dhaka Metro Rail</title>
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
{{--    fav icon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/metrorailforico.png') }}">

</head>
<body class="font-sans bg-gray-50 text-gray-800 w-full">
<!-- Navbar -->
@include('components/navbar')

<!-- Hero Section -->
<section class="relative bg-cover bg-center h-[70vh] w-full overflow-hidden">
    <!-- Slideshow container -->
    <div class="absolute inset-0 w-full h-full">
        <!-- Slides -->
        <div class="slides-container relative w-full h-full">
            <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-100" style="background-image: url('{{ asset('images/metroo.jpg') }}');">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-black/60"></div>
            </div>
            <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0" style="background-image: url('{{ asset('images/metro.jpg') }}');">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-black/60"></div>
            </div>
            <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0" style="background-image: url('{{ asset('images/metro-rail.avif') }}');">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-black/60"></div>
            </div>
        </div>


    </div>

    <!-- Content (stays the same) -->
    <div class="relative container mx-auto flex flex-col justify-center h-full px-4 sm:px-6 text-white">
        <div class="max-w-2xl">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4 leading-tight">Welcome to <span class="text-metro-secondary">Dhaka Metro Rail</span></h1>
            <p class="text-lg sm:text-xl mb-8 max-w-xl">Experience fast, eco-friendly, and affordable travel across the bustling city of Dhaka.</p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="/buy-ticket" class="bg-metro-secondary hover:bg-yellow-500 text-white py-3 sm:py-4 px-6 sm:px-8 rounded-lg text-lg font-semibold transition duration-300 text-center flex items-center justify-center space-x-2">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Buy Your Ticket</span>
                </a>
                <a href="/schedule" class="bg-transparent border-2 border-white hover:border-metro-secondary hover:text-metro-secondary text-white py-3 sm:py-4 px-6 sm:px-8 rounded-lg text-lg font-semibold transition duration-300 text-center flex items-center justify-center space-x-2">
                    <i class="fas fa-clock"></i>
                    <span>View Schedule</span>
                </a>
            </div>
        </div>
    </div>
</section>



<!-- Quick Info Bar -->
<div class="bg-metro-primary text-white py-4 w-full">
    <div class="container mx-auto px-4 sm:px-6 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
        <div class="flex items-center justify-center space-x-3">
            <i class="fas fa-clock text-2xl text-metro-secondary"></i>
            <div class="text-left">
                <p class="text-sm text-gray-300">Operation Hours</p>
                <p class="font-semibold">07:10 AM - 09:40 PM</p>
            </div>
        </div>
        <div class="flex items-center justify-center space-x-3">
            <i class="fas fa-train text-2xl text-metro-secondary"></i>
            <div class="text-left">
                <p class="text-sm text-gray-300">Frequency</p>
                <p class="font-semibold">Every 10 minutes</p>
            </div>
        </div>
        <div class="flex items-center justify-center space-x-3">
            <i class="fas fa-ticket-alt text-2xl text-metro-secondary"></i>
            <div class="text-left">
                <p class="text-sm text-gray-300">Standard Fare</p>
                <p class="font-semibold">20-100 BDT</p>
            </div>
        </div>
    </div>
</div>

@include('.components/fare-chart')

<!-- Features Section -->
<section class="py-16 bg-gradient-to-b from-white to-gray-100 w-full mt-14">
    <div class="container mx-auto px-4 sm:px-6">
        <h2 class="text-3xl sm:text-4xl font-bold mb-3 text-center text-gray-800">Features of Dhaka Metro Rail</h2>
        <p class="text-lg sm:text-xl text-gray-600 text-center mb-12 max-w-3xl mx-auto">Experience the best of modern public transportation with our world-class metro system.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="bg-green-100 w-16 h-16 flex items-center justify-center rounded-full mb-6 mx-auto">
                    <i class="fas fa-leaf text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-semibold mb-4 text-center text-gray-800">Eco-Friendly</h3>
                <p class="text-gray-600 text-center">Our trains run on electricity, helping to reduce pollution and promoting green energy use in the city. Each metro ride reduces carbon emissions compared to other transportation methods.</p>
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="bg-blue-100 w-16 h-16 flex items-center justify-center rounded-full mb-6 mx-auto">
                    <i class="fas fa-couch text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-semibold mb-4 text-center text-gray-800">Comfortable Travel</h3>
                <p class="text-gray-600 text-center">Experience modern, comfortable, and spacious train coaches equipped with air conditioning, smooth ride technology, and ergonomic seating for a pleasant journey.</p>
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="bg-purple-100 w-16 h-16 flex items-center justify-center rounded-full mb-6 mx-auto">
                    <i class="fas fa-tachometer-alt text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-semibold mb-4 text-center text-gray-800">Fast & Reliable</h3>
                <p class="text-gray-600 text-center">With frequent services and dedicated tracks, our metro system provides fast and reliable transportation across the city, helping you reach your destination on time, every time.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 mt-8">
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="bg-red-100 w-16 h-16 flex items-center justify-center rounded-full mb-6 mx-auto">
                    <i class="fas fa-shield-alt text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-semibold mb-4 text-center text-gray-800">Safety First</h3>
                <p class="text-gray-600 text-center">Your safety is our priority. Our stations and trains are equipped with advanced security systems, emergency response mechanisms, and trained personnel to ensure a safe journey for all passengers.</p>
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="bg-amber-100 w-16 h-16 flex items-center justify-center rounded-full mb-6 mx-auto">
                    <i class="fas fa-wheelchair text-amber-600 text-2xl"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-semibold mb-4 text-center text-gray-800">Accessibility</h3>
                <p class="text-gray-600 text-center">Designed with accessibility in mind, our stations feature elevators, ramps, tactile pavements, and other facilities to ensure that the metro is accessible to all citizens, including those with mobility challenges.</p>
            </div>
        </div>
    </div>
</section>

{{--Testimonial & about us--}}
@include('.components/testimonial')

{{--news & download--}}
@include('.components/news&donwload')

{{--contact&faq--}}
@include('.components/contac&faq')

<!-- Footer -->
@include('.components/footer')

<!-- Back to Top Button -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-metro-primary text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg transform transition-transform hover:scale-110 hidden">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Simple JavaScript for Back to Top Button -->
<script>
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
</script>

{{--js for slides--}}

<!-- Add this JavaScript at the end of your body tag -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.absolute.bottom-4 button');

        function showSlide(index) {
            // Hide all slides
            slides.forEach(slide => {
                slide.classList.remove('opacity-100');
                slide.classList.add('opacity-0');
            });

            // Show the current slide
            slides[index].classList.remove('opacity-0');
            slides[index].classList.add('opacity-100');

            // Update dots
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('opacity-50');
                    dot.classList.add('opacity-100');
                } else {
                    dot.classList.remove('opacity-100');
                    dot.classList.add('opacity-50');
                }
            });
        }

        // Auto rotate slides
        setInterval(function() {
            currentSlideIndex = (currentSlideIndex + 1) % slides.length;
            showSlide(currentSlideIndex);
        }, 5000); // Change slide every 5 seconds

        // Click event for dots
        dots.forEach((dot, i) => {
            dot.addEventListener('click', function() {
                currentSlideIndex = i;
                showSlide(currentSlideIndex);
            });
        });
    });
</script>
</body>
</html>

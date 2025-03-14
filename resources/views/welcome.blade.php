<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dhaka Metro Rail</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-gray-100">

<!-- Navbar -->
<nav class="bg-gray-900 text-white sticky top-0 z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <!-- Logo image -->
            <img src="{{ asset('images/rylogometro.png') }}" alt="Metro Rail Logo" class="h-10">
            <span class="text-lg font-semibold">Metro Rail</span>
        </div>
        <div class="space-x-8">
            <a href="/" class="hover:text-blue-400">Home</a>
            <a href="/buy-ticket" class="hover:text-blue-400">Buy Ticket</a>
            <a href="/schedule" class="hover:text-blue-400">Schedule</a>
            <a href="/faq" class="hover:text-blue-400">FAQ</a>
            <a href="/contact-us" class="hover:text-blue-400">Contact Us</a>
            <a href="/login" class="hover:text-blue-400">Login</a>
            <a href="/register" class="hover:text-blue-400">Register</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="relative bg-cover bg-center h-[60vh]" style="background-image: url('{{ asset('images/metrorailimage.jpg') }}');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative container mx-auto text-center py-24 px-6 text-white">
        <h1 class="text-5xl font-bold mb-4">Welcome to Dhaka Metro Rail</h1>
        <p class="text-xl mb-6">Experience fast, eco-friendly, and affordable travel across Dhaka.</p>
        <a href="/buy-ticket" class="bg-green-500 hover:bg-green-400 text-white py-3 px-6 rounded-lg text-xl font-semibold">Buy Your Ticket</a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-6">
    <div class="container mx-auto text-center">
        <p>&copy; 2025 Dhaka Metro Rail. All Rights Reserved.</p>
    </div>
</footer>

</body>

</html>

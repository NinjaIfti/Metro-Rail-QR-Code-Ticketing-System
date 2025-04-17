<nav class="bg-metro-dark text-white sticky top-0 z-50 shadow-lg">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <!-- Logo image -->
            <img src="{{ asset('images/metrorail.ico') }}" alt="Metro Rail Logo" class="h-12 rounded-full border-2 border-metro-secondary">
            <div class="flex flex-col">
                <span class="text-xl font-bold text-metro-secondary tracking-wider">DHAKA</span>
                <span class="text-sm font-light -mt-1">METRO RAIL</span>
            </div>
        </div>
        <div class="hidden md:flex space-x-6">
            <a href="/" class="hover:text-metro-secondary transition duration-300 flex items-center space-x-1">
                <i class="fas fa-home text-xs"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('buy-tickets') }}" class="hover:text-metro-secondary transition duration-300 flex items-center space-x-1">
                <i class="fas fa-ticket-alt text-xs"></i>
                <span>Buy Ticket</span>
            </a>

            <a href="{{ route('SCHEDULE') }}" class="hover:text-metro-secondary transition duration-300 flex items-center space-x-1">
                <i class="fas fa-clock text-xs"></i>
                <span>Schedule</span>
            </a>
            <a href="{{ route('FAQ') }}" class="hover:text-metro-secondary transition duration-300 flex items-center space-x-1">
                <i class="fas fa-question-circle text-xs"></i>
                <span>FAQ</span>
            </a>
            <a href="{{ route('CONTACT') }}" class="hover:text-metro-secondary transition duration-300 flex items-center space-x-1">
                <i class="fas fa-envelope text-xs"></i>
                <span>Contact</span>
            </a>
        </div>
        <div class="hidden md:flex items-center space-x-4">
            <a href="{{ route('Login') }}" class="px-4 py-2 border border-metro-secondary text-metro-secondary rounded-lg hover:bg-metro-secondary hover:text-white transition duration-300">Login</a>
            <a href="{{ route('Register') }}" class="px-4 py-2 bg-metro-secondary text-white rounded-lg hover:bg-yellow-500 transition duration-300">Register</a>
        </div>
        <button class="md:hidden text-white">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>
</nav>

<!-- Mobile Menu (hidden by default) -->
<div class="hidden bg-metro-dark text-white p-4 space-y-3">
    <a href="/" class="block py-2 hover:text-metro-secondary transition duration-300">Home</a>
    <a href="/buy-ticket" class="block py-2 hover:text-metro-secondary transition duration-300">Buy Ticket</a>
    <a href="/schedule" class="block py-2 hover:text-metro-secondary transition duration-300">Schedule</a>
    <a href="/faq" class="block py-2 hover:text-metro-secondary transition duration-300">FAQ</a>
    <a href="/contact-us" class="block py-2 hover:text-metro-secondary transition duration-300">Contact Us</a>
    <div class="flex space-x-2 pt-2">
        <a href="/login" class="flex-1 text-center py-2 border border-metro-secondary text-metro-secondary rounded-lg hover:bg-metro-secondary hover:text-white transition duration-300">Login</a>
        <a href="/register" class="flex-1 text-center py-2 bg-metro-secondary text-white rounded-lg hover:bg-yellow-500 transition duration-300">Register</a>
    </div>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Dhaka Metro Rail</title>
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

<!-- Register Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-metro-primary p-6 text-white text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/metrorail.ico') }}" alt="Metro Rail Logo" class="h-16 rounded-full border-2 border-metro-secondary">
                </div>
                <h2 class="text-2xl font-bold">Create Your Account</h2>
                <p class="text-gray-200 mt-1">Join the Dhaka Metro Rail community</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="p-6 space-y-6">
                @csrf

                <!-- User Type Selection -->
                <div class="flex justify-center mb-6">
                    <label class="user-type-option border border-gray-200 rounded-lg p-3 text-center cursor-pointer transition-all hover:border-metro-secondary hover:bg-metro-light relative user-type-active w-full max-w-xs">
                        <input type="radio" name="user_type" value="customer" class="hidden" checked>
                        <div class="flex flex-col items-center">
                            <i class="fas fa-user text-metro-primary text-xl mb-2"></i>
                            <span class="text-sm font-medium">Commuter</span>
                        </div>
                        <div class="absolute top-2 right-2 text-metro-secondary hidden check-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-500"></i>
                            </div>
                            <input id="name" type="text" name="name" class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" placeholder="John Doe" required autofocus>
                        </div>
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number Field -->
                    <div>
                        <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-500"></i>
                            </div>
                            <input id="phone" type="tel" name="phone" class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" placeholder="+880 1XXXXXXXXX" required>
                        </div>
                        @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-500"></i>
                        </div>
                        <input id="email" type="email" name="email" class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" placeholder="your.email@example.com" required>
                    </div>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-500"></i>
                            </div>
                            <input id="password" type="password" name="password" class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" placeholder="••••••••" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer toggle-password">
                                <i class="fas fa-eye text-gray-500"></i>
                            </div>
                        </div>
                        @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-500"></i>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" placeholder="••••••••" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer toggle-password-confirmation">
                                <i class="fas fa-eye text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-gray-700 font-medium mb-2">Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-map-marker-alt text-gray-500"></i>
                        </div>
                        <textarea id="address" name="address" rows="2" class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" placeholder="Your full address"></textarea>
                    </div>
                    @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox" class="rounded border-gray-300 text-metro-primary shadow-sm focus:border-metro-primary focus:ring focus:ring-metro-primary/20 transition-all" required>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="text-gray-700">I agree to the <a href="#" class="text-metro-primary hover:underline">Terms and Conditions</a> and <a href="#" class="text-metro-primary hover:underline">Privacy Policy</a></label>
                    </div>
                </div>

                <!-- Register Button -->
                <button type="submit" class="w-full py-3 bg-metro-primary hover:bg-metro-dark text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center">
                    <span>Create Account</span>
                    <i class="fas fa-user-plus ml-2"></i>
                </button>

                <!-- Divider -->
                <div class="relative flex items-center justify-center mt-6">
                    <div class="border-t border-gray-300 absolute w-full"></div>
                    <div class="bg-white px-4 relative text-sm text-gray-500">or register with</div>
                </div>

                <!-- Social Register -->
                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="flex items-center justify-center py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all">
                        <i class="fab fa-facebook-f mr-2"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="#" class="flex items-center justify-center py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all">
                        <i class="fab fa-google mr-2"></i>
                        <span>Google</span>
                    </a>
                </div>
            </form>

            <!-- Login Link -->
            <div class="py-4 bg-gray-50 text-center">
                <p class="text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-metro-primary font-medium hover:underline">Sign in</a></p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
@include('components/footer')

<!-- JavaScript for User Type Selection and Password Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // User type selection
        const userTypeOptions = document.querySelectorAll('.user-type-option');

        userTypeOptions.forEach(option => {
            const radio = option.querySelector('input[type="radio"]');
            const checkIcon = option.querySelector('.check-icon');

            if (radio.checked) {
                option.classList.add('border-metro-secondary', 'bg-metro-light');
                checkIcon.classList.remove('hidden');
            }

            option.addEventListener('click', function() {
                userTypeOptions.forEach(opt => {
                    opt.classList.remove('border-metro-secondary', 'bg-metro-light');
                    opt.querySelector('.check-icon').classList.add('hidden');
                });

                option.classList.add('border-metro-secondary', 'bg-metro-light');
                checkIcon.classList.remove('hidden');
                radio.checked = true;
            });
        });

        // Password toggle visibility
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle eye icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        // Confirm Password toggle visibility
        const togglePasswordConfirmation = document.querySelector('.toggle-password-confirmation');
        const passwordConfirmationInput = document.querySelector('#password_confirmation');

        togglePasswordConfirmation.addEventListener('click', function() {
            const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationInput.setAttribute('type', type);

            // Toggle eye icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    });
</script>
</body>
</html>
